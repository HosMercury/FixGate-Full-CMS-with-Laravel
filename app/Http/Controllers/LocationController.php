<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Location;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class LocationController
 * @package App\Http\Controllers
 */
class LocationController extends Controller
{
    /**
     * LocationController constructor.
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
        return view('locations.index');
    }

    /**
     * Display a listing of locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $cols = ['id', 'name', 'created_at'];
        $locations = Location::select($cols);

        return Datatables::of($locations)
            ->editColumn('name', function ($location) {
                return '<a href="/locations/' . $location->id . '"class="">' . str_limit($location->name, 50) . '</a>';
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
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'here';
        return $request->all();
        $this->validate($request, [
            'store_code' => 'required|unique:locations,store_code|numeric',
            'name' => 'required|unique:locations,name|max:300',
            'address' => 'max:1000',
            'longitude' => 'numeric',
            'latitude' => 'numeric',
            'city' => 'required|min:2|max:255',
        ]);

        $request['creator'] = auth()->user()->employee_id;

        $inserted = (new Location)->create($request->all());

        \Session::flash('message', 'Thanks , Your Location Name (' . $inserted->name . ')
                                               has been Successfully added');
        return redirect('locations/'.$inserted->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);
        $assets = \DB::table('materials')->where([['location',$location->id],['type','asset']])->get();
        $total = 0;
        foreach($assets as $asset)
        {
            $total += $asset->soh * $asset->price;
        }

//        return $assets;
        return view('locations.show', compact('location','assets','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        $managers = User::whereHas('roles' , function ($q) {
            $q->where('name','=','manager');
        })->get();
        return view('locations.edit',compact('location','managers'));
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
            'store_code' => 'numeric|unique:locations,store_code,'.$id,
            'name' => 'min:2|max:200|unique:locations,name',
            'address' => 'max:700',
            'longitude' => 'numeric',
            'latitude' => 'numeric',
            'city' => 'required|min:2|max:255',
        ]);

//        $request->location_id = auth()->user()->location->id;

        Location::find($id)->update($request->all());

        \Session::flash('success', 'Thanks , The location has been Successfully updated');

        return redirect('/locations/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::find($id)->delete();
        \Session::flash('success', 'Thanks , Location has been Successfully Deleted');
        return redirect('locations');
    }

    /**
     * Authorize all privilages for the auth user .
     *
     * @param null $model
     * @return \Illuminate\Auth\Access\Response
     */
    private function authorizeAll($model = null)
    {
        $model = $model ? \App\Location::class  : null ;
        return $this->authorize('', $model);
    }
}
