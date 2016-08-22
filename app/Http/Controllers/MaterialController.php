<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

use App\Http\Requests;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();

        return view('materials.create',compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type'=>'required|in:material,asset',
            'name'=>'required|min:3|max:200',
            'description'=>'max:1000',
            'width'=>'numeric',
            'length'=>'numeric',
            'height'=>'numeric',
            'soh'=>'required|numeric',
            'price'=>'required|numeric',
            'location'=>'required|exists:locations,id',
            'sub_location'=>'max:225',
        ]);

        $request['created_by'] = 8888;

        $inserted = (new Material)->create($request->all());

        \Session::flash('message', 'Thanks , Your Material or Asset with Name (' . $inserted->name . ')
                                               has been Successfully added');

        return redirect('/materials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
