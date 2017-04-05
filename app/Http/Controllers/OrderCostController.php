<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;

class OrderCostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  $location, $number)
    {

        if (is_nan($location) or is_nan($number)) abort('404');

        $this->validate($request, [
            'costDescription.*' => 'required',
            'costSubTotal.*' => 'required|numeric|min:0.01'
        ]);


        $order = OrderController::getOrder($location, $number);
        for ($i = 0; $i < count($request->costDescription); $i++) {
            $costs[] = ['order_id' => $order,
                'description' => $request->costDescription[$i],
                'cost' => $request->costSubTotal[$i]];
            $order->costs()->create($costs[$i]);
        }

        \Session::flash('success', 'Cost(s) has been Successfully added');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $this->validate($request, [
            'cost_select' => 'required|array'
        ]);

        $cost = $request->cost_select;
        for ($i = 0; $i < count($cost); $i++)
            Cost::findOrFail($cost[$i])->delete($cost[$i]);
        \Session::flash('success', 'Cost(s) has been Successfully deleted');
        return back();
    }
}
