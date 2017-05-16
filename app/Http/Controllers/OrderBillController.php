<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use Image;

/**
 * Class OrderBillController
 * @package App\Http\Controllers
 */
class OrderBillController extends Controller
{
    /**
     * OrderBillController constructor.
     */
    public function __construct()
    {
        return !! auth()->user()->fromTitles();
    }


    /**
     * Store order`s bill .
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $location
     * @param int $number
     */
    public function store(Request $request,  $location, $number)
    {
        if (is_nan($location) or is_nan($number)) abort('404');

        $this->validate($request, [
            'file' => 'required|image'
        ]);
        $order = OrderController::getOrder($location, $number);

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

    /**
     * Delete the order`s bill
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
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
