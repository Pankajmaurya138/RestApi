<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use DataTables;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
     
        return view('home',compact('users'));
    }
    // public function user(Request $request)
    // {
       
    //     return DataTables::of(User::query())
    //     ->setRowClass(function ($user) {
    //         return $user->id % 2 == 0 ? 'alert-primary' : 'alert-success';
    //       })
    //       ->setRowId('{{$id}}')
    //       ->setRowAttr([
    //         'align' => 'center',
    //     ])
    //     ->setRowData([ //set the data row with prefix row-
            
    //         'data-name' => 'row-{{$name}}',
    //     ])
    //     ->addColumn('intro', 'Hi {{$name}}!') //Adding Column
    //     ->editColumn('created_at', function(User $user) {
    //         return  $user->created_at->diffForHumans() ;
    //     })
    //     ->editColumn('updated_at', function(User $user) {
    //         return  $user->updated_at->diffForHumans() ;
    //     })

    //     ->editColumn('updated_at', 'column') //edit column by view
    //     ->rawColumns(['updated_at'])//edit column by raw to parse the html page as above 
    //     ->editColumn('created_at', 'column') //edit column by view
    //     ->rawColumns(['created_at'])//edit column by raw to parse the html page as above 

    //     ->make(true);
       
    // }

    public function user(Request $request)
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at'])->get();
        return Datatables::of($users)
        ->filter(function ($instance) use ($request) {
         
            if ($request->has('name')) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return Str::contains($row['name'], $request->get('name')) ? true : false;
                });
            }

            if ($request->has('email')) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return Str::contains($row['email'], $request->get('email')) ? true : false;
                });
            }
        })
        ->make(true);
    }
}
