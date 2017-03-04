<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use Image;

class OrderBillController extends Controller
{
    public function store(Request $request,Order $order)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $file = $request->file('file');
        $name = $order->id . '_' . time() . '_' . rand(11, 99) . '_' . $file->getClientOriginalName();
        if ($file->move(public_path() . '/bills', $name)) {
            Bill::create([
                'order_id' => $order->id,
                'name' => $name
            ]);

            Image::make(public_path() . '/bills/' . $name)
                ->resize(200, 150)
                ->save(public_path() . '/bills/' . 'tn_' . $name);
            Bill::create([
                'order_id' => $order->id,
                'name' => ('tn_' . $name),
                'thumbnail' => 1
            ]);
        }
    }

    public function destroy($id, Request $request)
    {
        $this->validate($request, [
            'bill' => 'required'
        ]);
        foreach ($request->bill as $bill) {
            if (\DB::table('bills')->where('name', $bill)
                ->orWhere('name', 'tn_' . $bill)->delete()
            ) {
                unlink(public_path() . '/bills/' . $bill);
                unlink(public_path() . '/bills/' . 'tn_' . $bill);
            }
        }
        \Session::flash('success', ' The Bill image(s) has been Deleted Successfully');
        return back();
    }

}
