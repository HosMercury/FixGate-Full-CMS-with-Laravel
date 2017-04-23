<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Order;
use App\Http\Requests;
use App\Material;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class FinancialController extends Controller
{
    /**
     * FinantialController constructor.
     */
    public function __construct()
    {
        $this->middleware('accountant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.index');
    }

    /**
     * Display a listing of costs.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $cols = ['id', 'order_id', 'creator', 'created_at', 'description', 'cost'];
        $costs = Cost::select($cols);
        return Datatables::of($costs)
            ->editColumn('description', function ($cost) {
                return '<a href="/financial/orders/'.$cost->order_id.'/costs">' . str_limit($cost->description, 30) . '</a>';
            })
            ->editColumn('order_id', function ($cost) {
                return '<a href="/orders/'.$cost->order_id.'/costs">' .$cost->order_id . '</a>';
            })
            ->editColumn('id', function ($cost) {
                return '<a href="/financial/orders/'.$cost->order_id.'/costs">' . $cost->id . '</a>';
            })
            ->make(true);
    }

    /**
     * Display a listing of materials,orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function data2(Request $request)
    {
        $mats = collect(\DB::table('material_order')
            ->orderBy('created_at', 'desc')
            ->get(['id','material_id', 'order_id', 'quantity','created_at']))
            ->map(function ($row) {
                $row->created_at = ' <a href="financial/'.$row->id.'/material/'.$row->material_id.'/order/'.$row->order_id.'"> ' . $row->created_at . '</a> ';
                $row->quantity = ' <a href="financial'.$row->id.'/material/'.$row->material_id.'/order/'.$row->order_id.'"> ' . $row->quantity . '</a> ';
                $row->material_name = '<a href="materials/'.$row->material_id.'">'.Material::find($row->material_id)->name.'</a> ';
                $row->id = ' <a href="financial/'.$row->id.'/material/'.$row->material_id.'/order/'.$row->order_id.'"> ' . $row->id . '</a> ';
                $row->material_id = ' <a href="materials/'.$row->material_id.'">'.$row->material_id.'</a> ';
                $row->order_id = ' <a href="orders/'.$row->order_id.'">'.$row->order_id.'</a> ';
                return $row;
            });

        return Datatables::of($mats)->make(true);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showCost(Order $order)
    {
        $costs = \DB::table('costs')->where('order_id',$order->id)->get();
        $thumbs = $order->bills()->where('thumbnail', 1)->get();
        return view('financial.showCost', compact('costs','order','thumbs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showMaterial($id , Material $material ,Order $order)
    {
        $material = $order->materials()->wherePivot('id',$id)->withPivot('id','quantity')->first();
        return view('financial.showMaterial', compact('material'));
    }


}
