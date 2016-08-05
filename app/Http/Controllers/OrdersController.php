<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Material;
use App\Order;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $from = Carbon::today()->subMonth();
        $to = Carbon::today();

        $count = Order::select(array(
            \DB::raw('DATE(`created_at`) as `date`'),
            \DB::raw('COUNT(*) as `count`')
        ))->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->lists('count', 'date');

        $orders = Order::with(['assignments' => function ($q) {
            $q->orderBy('updated_at', 'DESC')->get();
        }
           // , 'location'
        ])->whereBetween('created_at', [$from, $to])->get();


        return view('orders.admin.index', [
            'orders' => $orders,
            'count_keys' => $count->keys(),
            'count_values' => $count->values(),
            'dateTo' => $to->format('d-m'),
            'dateFrom' => $from->format('d-m')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByDate(Request $request)
    {
        $this->validate($request, [
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
        ]);
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $request->fromDate . '00:00:00');
        $to = Carbon::createFromFormat('Y-m-d H:i:s', $request->toDate . '23:59:59');

        $orders = Order::with(['assignments' => function ($q) {
            $q->orderBy('updated_at', 'DESC')->get();
        }, 'location'])->whereBetween('created_at', [$from, $to])->get();

        $count = Order::select(array(
            \DB::raw('DATE(`created_at`) as `date`'),
            \DB::raw('COUNT(*) as `count`')
        ))->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->lists('count', 'date');

        return view('orders.admin.index', [
            'orders' => $orders,
            'dateTo' => $to,
            'dateFrom' => $from,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $total = 0;
        $materials = $order->materials()->get();
        $costs = $order->costs()->get();
        $thumbs = $order->bills()->where('thumbnail', 1)->get();
        $materials_ids = Material::all();
        $workers = Worker::all();


        foreach ($materials as $mat) {
            $total += ($mat->price * $mat->pivot->quantity);
        }

        return view('orders.admin.show', [
            'order' => $order,
            'assignment' => $order->assignments->last(),
            'workers' => $order['workers'],
            'materials' => $materials,
            'costs' => $costs,
            'materials_total' => $total,
            'workers' => $workers,
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
