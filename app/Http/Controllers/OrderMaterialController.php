<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;

class OrderMaterialController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $order)
    {
        $this->validate($request, [
            'material_id.*' => 'required|numeric',
            'quantity.*' => 'required|numeric|min:0.01'
        ]);

        for ($i = 0; $i < count($request->material_id); $i++) {
            $mat[] = ['order_id' => $order->id,
                'material_id' => $request->material_id[$i],
                'quantity' => $request->quantity[$i]];
        }
//        dd($mat);
        $order->materials()->attach($mat);
        \Session::flash('success', 'Material(s) has been Successfully added');
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$order)
    {
        $this->validate($request, [
            'material_select' => 'required|array'
        ]);
        $mat = $request->material_select;
        $order->materials()->detach($mat);
        \Session::flash('success', 'Materials has been Successfully deleted');
        return back();

    }

}
