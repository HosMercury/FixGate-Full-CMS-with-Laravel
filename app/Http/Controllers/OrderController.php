<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Material;
use App\Worker;
use App\Order;
use Carbon\Carbon;
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
        $from = Carbon::today()->subWeek();
        $to = Carbon::today();

        $count = Order::select(array(
            \DB::raw('DATE(`created_at`) as `date`'),
            \DB::raw('COUNT(*) as `count`')
        ))->whereBetween('created_at',[$from,$to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->lists('count', 'date');

        $orders = Order::with(['assignments'=>function($q){
            $q->orderBy('updated_at','DESC')->get();
        }])->whereBetween('created_at',[$from,$to])->get();

        return view('orders.admin.index',[
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
        //dd($request->all());

        $this->validate($request, [
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
        ]);
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $request->fromDate.'00:00:00');
        $to = Carbon::createFromFormat('Y-m-d H:i:s', $request->toDate.'23:59:59');

        $orders = Order::with(['assignments'=>function($q){
            $q->orderBy('updated_at','DESC')->first();
        }])->whereBetween('created_at',[$from,$to])->get();

        $count = Order::select(array(
            \DB::raw('DATE(`created_at`) as `date`'),
            \DB::raw('COUNT(*) as `count`')
        ))->whereBetween('created_at',[$from,$to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->lists('count', 'date');

        return view('orders.admin.index',[
            'orders' => $orders,
            'dateTo' => $to,
            'dateFrom' => $from,
            'count_keys' => str_replace('2016-','',$count->keys()),
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
        $mats = $order->materials()->get()->toArray();
        $costs = $order->costs()->get()->toArray();
        $thumbs = $order->bills()->where('thumbnail',1)->get()->toArray();
        $all_materials_ids = Material::all()->toJson();
        $all_workers = Worker::all();

        $mat_sum = $order->materials()->get()->toArray();
        $total=0;
        for ($i = 0; $i < count($mat_sum); $i++) {
            $total +=  ($mat_sum[$i]['price'] * $mat_sum[$i]['pivot']['quantity']);
        }

        $cost_total = $order->costs()->sum('cost');

        if (!empty($order->assignments()->get()->toArray())) {
            $order = Order::with(['assignments' => function ($q) {
                $q->orderBy('created_at', 'desc')->get();
            }, 'workers' => function ($q) {
                $q->select(['assignment', 'worker_id', 'role', 'name'])->get();
            }])->where('id', $order->id)->get()->toArray()[0];

        } else {
            $order['assignments'] = null;
            $order['workers'] = null;
        }

        return view('orders.admin.show', [
            'id' => $order['id'],
            'title' => $order['title'],
            'description' => $order['title'],
            'description' => $order['description'],
            'trade' => $order['trade'],
            'contact' => $order['contact'],
            'priority' => $order['priority'],
            'notes' => $order['notes'],
            'entry' => $order['entry'],
            'close_key' => $order['close_key'],
            'deleted_at' => $order['deleted_at'],
            'created_at' => $order['created_at'],
            'assignment' => $order['assignments'],
            'status' => $order['assignments'][0]['status'],
            'reason' => $order['assignments'][0]['reason'],
            'workers' => $order['workers'],
            'materials' => $mats,
            'costs' => $costs,
            'materials_total' => $total,
            'cost_total' => $cost_total,
            'all_workers' => $all_workers,
            'all_materials_ids' => $all_materials_ids,
            'thumbs'=>$thumbs
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
