<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    public function user(Request $request)
    {

        return DataTables::of(User::query())


        ->make(true);

    }

    public function user1(Request $request)
    {
        dd('hi');
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
