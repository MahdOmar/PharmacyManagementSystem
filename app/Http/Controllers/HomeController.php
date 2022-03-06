<?php

namespace App\Http\Controllers;

use App\Models\Medicine;

use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $expDate = Carbon::now()->addDays(15);



       $products = Medicine::whereBetween('Exp_date',  [Carbon::now(),$expDate])->get();

       error_log('-----------'.$expDate );

        return view('home' , ['products' => $products]);
    }
}
