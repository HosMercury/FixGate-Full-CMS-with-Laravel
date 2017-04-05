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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $location, $number)
    {
        $order = OrderController::getOrder($location, $number);

        $validator = Validator::make($request->all(), [
            'workers' => 'required|exists:users,id'
        ]);

        // redirect if validation error ...
        if ($validator->fails()) {
            return redirect($order->path() . '#assignments')
                ->withErrors($validator)
                ->withInput();
        }

        $status = $this->setStatus($request, $order);

        //Check pre-existence
        foreach ($request->input('workers') as $worker) {
            $existed = Assignment::where([
                'order_id' => $order->id,
                'status' => $status,
                'worker' => $worker
            ])->first();

            if ($existed) {
                \Session::flash('warning', 'Previously added worker(s) to the same assignment .Relax, no need');
                return back();
            }
        }

        if ($this->assignWorker($request, $order, $status))
            \Session::flash('success', 'Great , The order assignment has been created Successfully');
        else
            \Session::flash('danger', 'Something went wrong , please contact your admins');

        return back();
    }

    /**
     * @param Request $request
     * @param $order
     * @param $get_workers
     * @return \Illuminate\Http\RedirectResponse
     */
    private function assignWorker(Request $request, Order $order, $status)
    {

        foreach ($request->input('workers') as $key => $value) {
            $created = (new Assignment)->create([
                'order_id' => intval($order->id),
                'status' => $status,
                'creator' => auth()->user()->employee_id,
                'worker' => intval($value)
            ]);
        }

        if (!empty($created)) return true;
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $location, $number, Assignment $assignment)
    {
        $this->validate($request, [
            'all' => 'in:1',
        ]);

        if ($assignment->delete())
            \Session::flash('success', "The worker has been deleted ");
        else
            \Session::flash('danger', "The worker has not been deleted ,Please contact your admins");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $order
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(Request $request, $location, $number, Assignment $assignment)
    {
        $this->validate($request, [
            'assignment' => 'exists:assignments,status'
        ]);
        if (Assignment::whereStatus($assignment->status)->delete())
            \Session::flash('success', 'Assignment Deleted Successfully');
        else
            \Session::flash('danger', 'Something went wrong , please contact your admins');

        return back();
    }

    public function vendor(Request $request, $location, $number)
    {
        $order = OrderController::getOrder($location, $number);

        $validator = Validator::make($request->all(), [
            'vendor' => 'required|min:3|max:500',
            'last_assignment' => 'in:1',
        ]);

        // redirect if validation error ...
        if ($validator->fails()) {
            return redirect($order->path() . '#assignments')
                ->withErrors($validator)
                ->withInput();
        }

        $status = $this->setStatus($request, $order);

        if (Assignment::create([
            'order_id' => $order->id,
            'status' => $status,
            'vendor' => $request->input('vendor'),
            'creator' => intval(auth()->user()->employee_id)
        ])
        )
            \Session::flash('success', 'Great , The order assignment has been Created Successfully');
        else
            \Session::flash('danger', 'Something went wrong , please contact your admins');

        return back();
    }

    public function setStatus(Request $request, Order $order)
    {
        // if there is no assignments , null will be returned . giving error
        $status = Assignment::where(['order_id' => intval($order->id)])->max('status') ?: 0;

        if ($request->input('last_assignment') != 1 or $status == 0) {
            $status++;
        }

        return intval($status);
    }
}
