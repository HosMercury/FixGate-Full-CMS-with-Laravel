<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class OrderMaterialController
 * @package App\Http\Controllers
 */
class OrderMaterialController extends Controller
{

    /**
     * Store a used material for particular order.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $location
     * @param  int $number
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

        $order->materials()->attach($mat);
        \Session::flash('success', 'Material(s) has been Successfully added');
        return back();
    }


    /**
     * Remove a used material for particular order.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $location
     * @param  int $number
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