<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Http\Requests;
use App\Http\Requests\OrderRequest;
use App\Material;
use App\Order;
use App\Rating;
use Mail;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $to = Carbon::today();
        $from = Carbon::today()->subWeek();

        $count = Order::select([
            \DB::raw('DATE_FORMAT(`created_at`,"%d-%m") AS `date`'),
            \DB::raw('COUNT(*) AS `count`')
            ])->whereBetween('created_at', [$from, $to])
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->lists('count', 'date');

        return view('orders.index', [
            'count' => $count,
            'dateTo' => $to->format('d-m'),
            'dateFrom' => $from->format('d-m')
            ]);

        return view('orders.index');
    }

    /**
     * Display a listing of orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $cols = ['number', 'title', 'priority', 'type', 'location_id', 'created_at'];
        $orders = Order::select($cols);
        return Datatables::of($orders)
        ->editColumn('title', function ($order) {
            return '<a href="/orders/' . substr($order->number, 0, 4) . '/' . substr($order->number, 5) . '">' . str_limit($order->title, 50) . '</a>';
        })
        ->editColumn('number', function ($order) {
            return '<a href="/orders/' . substr($order->number, 0, 4) . '/' . substr($order->number, 5) . '">' . $order->number . '</a>';
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \DB::table('types')->lists('name', 'name');
        return view('orders.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $user = auth()->user();

        $last_order_number = Order::whereLocationId(auth()->user()->location_id)
        ->pluck('number')
        ->map(function ($number) {
            return substr($number, 5);
        })->max();

        if (!isset($last_order_number)) {
            $last_order_number = 1000000;
        }

        $request['location_id'] = auth()->user()->location_id;
        $request['creator'] = auth()->user()->id;
        $request['key'] = rand(0000, 9999);
        $request['number'] = auth()->user()->location_id . '-' . ($last_order_number + 1);
        $inserted = (new Order)->create($request->all());

        if (isset($inserted)) {
            \Session::flash('success', 'Thanks , Your service order No (' . $inserted->number . ') has been Successfully added');

            Mail::send('emails.confirm', ['inserted' =>$inserted,'user'=>$user], function ($m) use ($user) {
                $m->from('hello@app.com', 'Your Application');

                $m->to($user->email, $user->name)->subject('Order Created');
            });

            return redirect('/orders/' . substr($inserted->number,0,4).'/'. substr($inserted->number,5));
        } else {
            \Session::flash('success', 'Error Occurred');
            return redirect('/orders');
        }
    }

    /**
     * Display the order.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($location, $number)
    {
        if (is_nan($location) || is_nan($number)) abort(404);

        $order = Order::whereNumber($location . '-' . $number)->first();

        $total = 0;
        $materials = $order->materials()->get();
        $costs = $order->costs()->get();
        $thumbs = $order->bills()->where('thumbnail', 1)->get();
        $materials_ids = Material::all();

        // get labors trials
        $labors = User::whereHas('roles',function($q){
            $q->where('name','labor');
        })->lists('id', 'name');

        $technicians = User::whereHas('roles',function($q){
            $q->where('name','technician');
        })->lists('id', 'name');

        $workers = collect(['labors' => $labors, 'Technicians' => $technicians])->all();

        foreach ($materials as $mat) {
            $total += ($mat->price * $mat->pivot->quantity);
        }

        $assignments = Assignment::where(['order_id' => $order->id])
        ->orderBy('created_at', 'asc')->get()->groupBy('status');

        $assignments = $assignments->map(function ($assignment) {
            return $assignment->map(function ($w) {
                return $w = User::find($w->worker);
            });
        });

        $closed = Assignment::where([
            'status' => '-1',
            'order_id' => $order->id
            ])->first();

        $assigns_count = $closed ? $assignments->count() - 1 : $assignments->count();

        return view('orders.show', [
            'order' => $order,
            'materials' => $materials,
            'costs' => $costs,
            'materials_total' => $total,
            'assigns' => $assignments,
            'workers' => $workers,
            'labors' => $labors,
            'techs' => $technicians,
            'materials_ids' => $materials_ids,
            'thumbs' => $thumbs,
            'closed' => $closed,
            'assigns_count' => $assigns_count
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($location,$number)
    {
        $order = Order::whereNumber($location.'-'.$number)->first();
        $types = \DB::table('types')->lists('name', 'name');
        return view('orders.edit', compact('order', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function  update(OrderRequest $request, $order)
    {
        $request->creator = auth()->user()->id;

        $order->update($request->all());

        \Session::flash('success', 'Thanks , Your service order has been Successfully updated');

        return redirect('/orders/'.substr($order->number, 0,4).'/'.substr($order->number, 5));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        $order->delete();
        \Session::flash('success', 'Thanks , Your service order has been Successfully deleted');

        return redirect('/orders');
    }

    /**
     * close te order .
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function close(Request $request, Order $order)
    {
        $this->validate($request, [
            'rating' => 'required|min:1|max:5',
            'closekey' => 'required|min:0000|max:9999',
            'feedback' => 'max:500'
            ]);

        if ($request->closekey != $order->key) {
            \Session::flash('danger', 'You have entered wrong Close Key , try again');
            return redirect('/orders/'.substr($order->number,0,4).'/'.substr($order->number,5));
        } else {
            if ((New Rating)->create($request->all())) {

                $order->assignments()->create(['order_id' => $order->id, 'status' => '-1']);

                \Session::flash('success', 'Thanks , Your service order has been Successfully Closed');
                return redirect('/orders/'.substr($order->number,0,4).'/'.substr($order->number,5));
            } else {
                \Session::flash('danger', 'An error has been occur , please conact your admin..');
                return redirect('/orders/'.substr($order->number,0,4).'/'.substr($order->number,5));
            }
        }
    }
}
