<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debtor;

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
        $debtor = Debtor::where('user_id', auth()->user()->id)->get();
        return view('debtor.index', ['debtor' => $debtor, 'invalid'=>'']);
    }
    public function login(){
        return route('login');
    }
}
