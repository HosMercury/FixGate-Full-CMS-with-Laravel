<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Material;
use App\Order;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;

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
        $from = Carbon::today()->subMonth();

        $count = Order::select([
            \DB::raw('DATE_FORMAT(`created_at`,"%d-%m") AS `date`'), //mysql resulted date format
            \DB::raw('COUNT(*) AS `count`')
        ])->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->lists('count', 'date');

        $order = Order::with('assignments')->get();

        return view('orders.index', [
            'orders' => $order,
            'count' => $count,
            'dateTo' => $to->format('d-m'),
            'dateFrom' => $from->format('d-m')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
            'location' => 'numeric|exists:locations,id'
        ]);

        $location = $request->location;

        $from = Carbon::createFromFormat('Y-m-d H:i:s', $request->fromDate . '00:00:00');
        $to = Carbon::createFromFormat('Y-m-d H:i:s', $request->toDate . '23:59:59');

        $order = Order::with(['assignments' => function ($q) {
            $q->orderBy('updated_at', 'DESC')->get();
        }])->whereBetween('created_at', [$from, $to]);

        if ($location) $order->where('location_id', $request->location);

        $count = Order::select(array(
            \DB::raw('DATE(`created_at`) as `date`'),
            \DB::raw('COUNT(*) as `count`')
        ))->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->lists('count', 'date');

        return view('orders.index', [
            'orders' => $order->get(),
            'dateTo' => $to->toDateString(),
            'dateFrom' => $from->toDateString(),
            'count_keys' => str_replace('2016-', '', $count->keys()),
            'count_values' => $count->values(),
        ]);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:10|max:255',
            'description' => 'required|min:20',
            'type' => 'required|exists:types,name',
            'priority' => 'required|integer|min:1|max:4',
            'contact' => 'required|digits:10|regex:/^05/',
            'notes' => 'min:10',
        ]);


        $request->location_id = 2000;
//        $request->location_id = auth()->user()->location->id;
        $request->user_id = auth()->user()->id;

        $inserted = (new Order)->create($request->all());

        \Session::flash('message', 'Thanks , Your service order No (' . $inserted->id . ') has been Successfully added');

        return redirect('/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $orders)
    {
//        auth()->loginUsingId(13);
//
//        if (Gate::denies('show_order_page', $order)) {
//            abort(403, 'Unauthorized Page Request');
//        }

        $order = $orders;
        $total = 0;
        $materials = $order->materials()->get();
        $costs = $order->costs()->get();
        $thumbs = $order->bills()->where('thumbnail', 1)->get();
        $materials_ids = Material::all();

        $labors = User::whereHas('roles', function ($q) {
            $q->where('name', 'labor');
        })->lists('id', 'name');

        $techs = User::whereHas('roles', function ($q) {
            $q->where('name', 'technician');
        })->lists('id', 'name');

        $vendors = User::whereHas('roles', function ($q) {
            $q->where('name', 'vendor');
        })->lists('id', 'name');

        $workers = collect(['labors' => $labors, 'Technicians' => $techs, 'Vendors' => $vendors])->all();

        foreach ($materials as $mat) {
            $total += ($mat->price * $mat->pivot->quantity);
        }

        $assigns = $order->assignments()
            ->having('status', '>', 0)
            ->orderBy('created_at', 'des')
            ->get(['status', 'worker', 'created_at'])
            ->groupBy('status');

        $assigns = $assigns->map(function ($assign) {
            return User::whereIn('id', $assign->pluck('worker'))->get();
        });

        return view('orders.show', [
            'order' => $order,
            'materials' => $materials,
            'costs' => $costs,
            'materials_total' => $total,

            'assigns' => $assigns,

            'workers' => $workers,
            'labors' => $labors,
            'techs' => $techs,
            'vendors' => $vendors,

            'materials_ids' => $materials_ids,
            'thumbs' => $thumbs,
        ]);
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
    public function destroy($id)
    {
        //
    }


}
