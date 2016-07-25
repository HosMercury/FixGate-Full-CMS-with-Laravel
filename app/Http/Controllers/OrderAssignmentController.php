<?php

namespace App\Http\Controllers;

use App\Order;
use App\Assignment;
use App\Http\Requests;
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
    public function store(Request $request, $id, $status = 'Assigned', $new = true)
    {

        $this->validate($request, [
            'worker' => 'required'
        ]);

        $order = Order::find($id);

        $workers = $request->worker;
        $reason = $request->reason;

        if ($new) {
            $request['status'] = $status;
            if (Assignment::create($request->all()))
                $order->workers()->attach($workers, ['assignment' => $status]);
        } else {
            \DB::table('order_worker')->where('assignment', $status)->delete();
            $order->workers()->attach($workers, ['assignment' => $status]);
        }
        \Session::flash('message', 'Great ,The order has been ' . $status . ' Successfully');
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
