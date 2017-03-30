<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Http\Requests;
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
    public function store(Request $request, $order, $assignment = null, $get_workers = 'workers')
    {
        $validator = Validator::make($request->all(), [
            $get_workers => 'required|exists:users,id',
        ]);

        // redirect if validation error ...
        if ($validator->fails()) {
            return redirect('orders/' . substr($order->number, 0, 4) . '/' . substr($order->number, 5) . '#assignments')
                ->withErrors($validator)
                ->withInput();
        }
        // check existed assigns for edit
        if ($assignment != null) {
            foreach ($request->$get_workers as $worker) {
                $existed = Assignment::where([
                    'order_id' => $order->id,
                    'status' => $assignment,
                    'worker' => $worker
                ])->first();

                if ($existed) {
                    \Session::flash('danger', 'Previously added worker(s) to the same assignment .Relax, so need');
                    return back();
                }
            }
        }

        if ($this->assignWorker($request, $order, $get_workers)) {
            \Session::flash('success', 'Great , The order assignment has been ' . ($get_workers == 'workers' ? 'created' : 'updated') . ' Successfully');
        } else
            \Session::flash('danger', 'Something went wrong , please contact your admins');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order, $assignment)
    {
        $this->store($request, $order, $assignment, 'addworkers');
        return back();
    }

    /**
     * @param Request $request
     * @param $order
     * @param $get_workers
     * @return \Illuminate\Http\RedirectResponse
     */
    private function assignWorker(Request $request, $order, $get_workers)
    {
        $workers = !empty($request->input($get_workers)) ? $request->input($get_workers) : null;

        $last = $order->assignments->last() ? $order->assignments->last()->status : 0;

        $last = ($get_workers === 'workers') ? $last + 1 : $last;

        if ($workers != null) {
            foreach ($workers as $key => $value) {
                $created = (new Assignment)->create([
                    'order_id' => intval($order->id),
                    'status' => intval($last),
                    'creator' => intval(auth()->user()->employee_id),
                    'worker' => intval($value)
                ]);
            }
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
    public function destroy(Request $request, $order, $assignment, $worker = null)
    {
        if (!intval($worker) or intval($worker) == null) {
            //there is no workers
            $deleted = Assignment::where([
                'status' => intval($assignment),
                'order_id' => intval($order->id),
            ])->delete();
        } else {
            // there is workers
            $deleted = Assignment::where([
                'status' => intval($assignment),
                'order_id' => intval($order->id),
                'worker' => intval($worker)
            ])->delete();
        }
        if ($deleted) {
            \Session::flash('success', "The worker(s) has been deleted ");
            return back();
        } else {
            \Session::flash('danger', "The worker has not been deleted ,Please contact your istrator ");
            return back();
        }
    }

    public function vendor(Request $request,$order)
    {
        $validator = Validator::make($request->all(), [
            'vendor'=>'required|min:3|max:500',
            'last_assignment'=>'in:1',
        ]);

        // redirect if validation error ...
        if ($validator->fails()) {
            return redirect('orders/' . substr($order->number, 0, 4) . '/' . substr($order->number, 5) . '#assignments')
                ->withErrors($validator)
                ->withInput();
        }

        return $last_recorded_assignment = Assignment::where([
            'order_id'=>$order->id
        ])->max();
        Assignment::create([
           'order_id' => $order->id,
            'vendor' => $request->input('vendor')
        ]);

        return back();
    }
}
