<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Assignment;
use App\Http\Controllers\OrderAssignmentController;
use App\Http\Requests;

class OrderReassignmentController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id,$status = 'Reassigned' ,$new = true)
    {

       $reAss = new OrderAssignmentController();
       return $reAss->store($request,$id,$status,$new);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$status_id)
    {
        $reAssUpdate = new OrderAssignmentController();
        $reAssUpdate->update($request,$id,$status_id,'Reassigned');
        \Session::flash('success', 'Great ,The Reassignment has been Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('order_worker')->where('assignment', 'Reassigned')->delete();
        Assignment::where('order_id', $id)->where('status', 'Reassigned')->delete();
        \Session::flash('success', 'Great ,The Reassignment has been Deleted Successfully');
        return back();
    }
}
