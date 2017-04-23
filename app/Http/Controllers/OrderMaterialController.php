<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class OrderMaterialController extends Controller
{
    /**
     * OrderMaterialController constructor.
     */
    public function __construct()
    {
//        $this->middleware(['supervisor','admin','superadmin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $location, $number)
    {
        if (is_nan($location) or is_nan($number)) abort('404');

        $this->validate($request, [
            'material_id.*' => 'required|numeric',
            'quantity.*' => 'required|numeric|min:0.01'
        ]);


        $order = OrderController::getOrder($location, $number);
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
    public function destroy(Request $request, $location, $number)
    {

        if (is_nan($location) or is_nan($number)) abort('404');

        $this->validate($request, [
            'material_select' => 'required|array'
        ]);

        $order = OrderController::getOrder($location, $number);
        $mat = $request->material_select;
        $order->materials()->detach($mat);
        \Session::flash('success', 'Materials has been Successfully deleted');
        return back();

    }

}
