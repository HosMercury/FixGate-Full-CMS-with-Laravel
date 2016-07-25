<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;

class OrderCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'costDescription.*' => 'required',
            'costSubTotal.*' => 'required|numeric|min:0.01'
        ]);

        for ($i = 0; $i < count($request->costDescription); $i++) {
            $costs[] = ['order_id' => $id,
                'description' => $request->costDescription[$i],
                'cost' => $request->costSubTotal[$i]];
            Order::find($id)->costs()->create($costs[$i]);
        }//dd($costs);

        \Session::flash('message', 'Cost(s) has been Successfully added');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->validate($request, [
            'cost_select' => 'required|array'
        ]);
        $cost = $request->cost_select;
//        dd($cost);
        for ($i = 0; $i < count($cost); $i++)
            Cost::findOrFail($cost[$i])->delete($cost[$i]);
        \Session::flash('message', 'Cost(s) has been Successfully deleted');
        return back();
    }
}
