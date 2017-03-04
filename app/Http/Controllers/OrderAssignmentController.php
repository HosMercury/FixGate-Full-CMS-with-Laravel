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
    public function store(Request $request,$order,$assignment = null, $get_workers = 'workers')
    {
        $validator = Validator::make($request->all(), [
            $get_workers => 'required|exists:users,id'
        ]);
        // redirect not go correct
        if ($validator->fails()) {
            return redirect("order/{$order}#assignment")
                ->withErrors($validator)
                ->withInput();
        }
        // check existed
        if ($assignment != null) {
            foreach ($request->$get_workers as $worker) {
                $existed = Assignment::where([
                    'order_id' => $order->id,
                    'status' => $assignment,
                    'worker' => $worker
                ])->first();

                if ($existed) {
                    \Session::flash('danger', 'Previously added worker(s) to the same assignment');
                    return back();
                }
            }
        }
        if ($this->assignWorker($request, $order, $get_workers)) {
            \Session::flash('success', 'Great , The order assignment has been ' . ($get_workers == 'workers' ? 'created' : 'edited') . ' Successfully');
        } else
            \Session::flash('danger', 'Unexpected Error occured , please contact your admin');
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
        $this->store( $request , $order, $assignment, 'addworkers' );
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
        $workers = $request->$get_workers;

        $status = $order->assignments->last() ? $order->assignments->last()->status : 0;

        $status = ($get_workers === 'workers') ? $status + 1 : $status;

        foreach ($workers as $key => $value) {
            $created = (new Assignment)->create([
                'order_id' => intval($order->id),
                'order_id' => intval($order->id),
                'status' => intval($status),
                'creator' => intval(auth()->user()->id),
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
    public function destroy( Request $request,$order, $assignment, $worker = null)
    {
        if (! intval($worker) or intval($worker) == null ) {
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
}
