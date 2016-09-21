<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;
use Validator;

class OrderAssignmentController extends Controller
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
            'workers' => 'required|exists:users,id'
        ]);

        $order = Order::find($id);
        $status = $order->assignments->last()->status;
        $workers = $request->workers;

        if (empty($status)) { // New Order
            foreach ($workers as $key => $value) {
                (new Assignment)->create([
                    'order_id' => $order->id,
                    'status' => 1,
                    'creator' => auth()->user()->id,
                    'worker' => intval($value)
                ]);
                \Session::flash('success', 'Great ,The order has been Assigned Successfully');
                return back();
            }
            \Session::flash('danger', 'Unexpected Error occured , please contact your admin');
            return back();
        } elseif ($status > 0)
        { // Assigned
            foreach ($workers as $key => $value) {
                (new Assignment)->create([
                    'order_id' => $order->id,
                    'status' => 1,
                    'creator' => auth()->user()->id,
                    'worker' => intval($value)
                ]);
            }
            \Session::flash('success', 'Great ,The order has been Assigned Successfully');
            return back();
        }
            \Session::flash('danger', 'Unexpected Error occured , please contact your administrator');
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $status_id, $status = 'Assigned')
    {
        $this->store($request, $id, $status, false);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        \DB::table('order_worker')->where('assignment', 'Assigned')->delete();
        Assignment::where('order_id', $id)->where('status', 'Assigned')->delete();
        \Session::flash('message', 'Great ,The Assignment has been Deleted Successfully');
        return back();
    }
}
