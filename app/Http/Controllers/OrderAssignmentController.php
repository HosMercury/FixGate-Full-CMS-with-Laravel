<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;
use Validator;

/**
 * Class OrderAssignmentController
 * @package App\Http\Controllers
 */
class OrderAssignmentController extends Controller
{
    /**
     * OrderAssignmentController constructor.
     */
    public function __construct()
    {
        return !! auth()->user()->fromTitles();
    }


    /**
     * Store a newly created assignment in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $location
     * @param  int $number
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
     * Assign worker
     *
     * @param Request $request
     * @param \App\Order $order
     * @param int $status
     * @return bool
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
     * Remove the specified assignment.
     *
     * @param Request $request
     * @param  int $location
     * @param  int $number
     * @param  \App\Assignment $assignment
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
     * Remove all whole assignment for order.
     *
     * @param Request $request
     * @param  int $location
     * @param  int $number
     * @param  \App\Assignment $assignment
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

    /**
     * @param Request $request
     * @param $location
     * @param $number
     * @return $this|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Do the work with this assignment
     * which mean close assignment after that .
     *
     * @param Request $request
     * @param $location
     * @param $number
     * @param \App\Assignment $assignment
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function done(Request $request, $location, $number, $assignment)
    {
        $order = $this->checkUrl($location, $number);

        $validator = Validator::make($request->all(), [
            'key' => 'required|numeric|max:9999',
        ]);

        // redirect if validation error ...
        if ($validator->fails()) {
            return redirect($order->path() . '#assignments')
                ->withErrors($validator)
                ->withInput();
        }

        $this->updateDoneStatus($request, $assignment, $order);

        return back();
    }

    /**
     * Undo the work with this assignment
     * which mean open assignment again .
     *
     * @param Request $request
     * @param $location
     * @param $number
     * @param $assignment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function undone(Request $request, $location, $number, $assignment)
    {
        $order = $this->checkUrl($location, $number);
        $this->updateDoneStatus($request, $assignment, $order, 1);

        return back();
    }

    /**
     * Set the status integer
     *
     * @param Request $request
     * @param Order $order
     * @return int
     */
    public function setStatus(Request $request, Order $order)
    {
        // if there is no assignments , null will be returned . giving error
        $status = Assignment::where(['order_id' => intval($order->id)])->max('status') ?
            Assignment::where(['order_id' => intval($order->id)])->max('status'): 0;

        if ($request->input('last_assignment') != 1 or $status == 0) {
            $status++;
        }

        return intval($status);
    }

    /**
     * Validate the location and number
     * to get the order
     *
     * @param $location
     * @param $number
     * @return \App\Order $order
     */
    private function checkUrl($location, $number)
    {
        if (is_nan($location) or is_nan($number)) abort('403');
        $order = OrderController::getOrder($location, $number);
        return $order;
    }

    /**
     * Update done status .
     *
     * @param Request $request
     * @param \App\Assignment $assignment
     * @param null $undone
     */
    private function updateDoneStatus(Request $request, $assignment, $order, $undone = null)
    {
        if ( // is this assignment exists for that order and is the last? // it has to be the last .
            $order->assignments()->whereStatus($assignment)->first()->status == $order->assignments()->pluck('status')->max()
        )
            // undone request so no need to check key ..
            if ($undone or $request->input('key') == $order->key) { //done ok ..
                $order->assignments()->whereStatus($assignment)->update(['done' => $undone ? 0 : 1]);
                session()->flash('success', 'Order Work done , Successfully');
            } else
                session()->flash('danger', 'Key not matching , Key provided by order`s creator');
        else
            session()->flash('danger', 'Something went wrong , invalid assignment ,Please don`t play with our code , Not cool !');
    }
}
