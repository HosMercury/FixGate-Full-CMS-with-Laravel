<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Type;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;


class TypeController extends Controller
{
    /**
     * TypeController constructor.
     */
    public function __construct()
    {
        $this->authorizeAll();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('types.index');
    }


    /**
     * Display a listing of types.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $cols = ['id', 'name', 'created_at'];
        $types = Type::select($cols);
        return Datatables::of($types)
            ->editColumn('name', function ($type) {
                return '<a href="/types/' . $type->id . '"class="">' . str_limit($type->name, 50) . '</a>';
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
        return view('types.create');
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
            'name' => 'required|min:2|max:220|unique:types,name',
            'description' => 'max:1000',
        ]);

        $request['creator'] = auth()->user()->employee_id;
        $inserted = (new Type)->create($request->all());

        \Session::flash('success', 'Thanks , Your Type Name (' . $inserted->name . ')
                                    has been Successfully added');

        return redirect('/types');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type::find($id);
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type::find($id);
        return view('types.edit', compact('type'));
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
        $this->validate($request, [
            'name' => 'min:2|max:220|unique:types,name',
            'description' => 'max:1000',
        ]);

        $request['creator'] = auth()->user()->employee_id;
        Type::find($id)->update($request->all());

        \Session::flash('success', 'Thanks , The Type has been Successfully updated');

        return redirect('/types/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Type::find($id)->delete();

        \Session::flash('success', 'Thanks , The Type  has been Successfully deleted');

        return redirect('/types');
    }

    private function authorizeAll($model = null)
    {
        $model = $model ?? \App\Type::class ;
         return $this->authorize('', $model);
    }
}
