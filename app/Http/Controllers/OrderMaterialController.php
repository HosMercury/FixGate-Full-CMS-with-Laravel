<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;

class OrderMaterialController extends Controller
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
        $this->validate($request, [
            'material_id.*' => 'required|numeric',
            'quantity.*' => 'required|numeric|min:0.01'
        ]);

        for ($i = 0; $i < count($request->material_id); $i++) {
            $mat[] = ['order_id' => $id,
                'material_id' => $request->material_id[$i],
                'quantity' => $request->quantity[$i]];
        }
        //dd($mat);
        Order::find($id)->materials()->attach($mat);
        \Session::flash('message', 'Material(s) has been Successfully added');
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
    public function destroy(Request $request,$id)
    {
        $this->validate($request, [
            'material_select' => 'required|array'
        ]);
        $mat = $request->material_select;
        Order::find($id)->materials()->detach($mat);
        \Session::flash('message', 'Materials has been Successfully deleted');
        return back();

    }
}
