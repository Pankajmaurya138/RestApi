<?php

namespace App\Http\Controllers;

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
    public function user()
    {
        return DataTables::of(User::query())
        ->setRowClass(function ($user) {
            return $user->id % 2 == 0 ? 'alert-primary' : 'alert-success';
          })
          ->setRowId('{{$id}}')
          ->setRowAttr([
            'align' => 'center',
        ])
        ->setRowData([ //set the data row with prefix row-
            
            'data-name' => 'row-{{$name}}',
        ])
          
        ->make(true);
       
    }
}
