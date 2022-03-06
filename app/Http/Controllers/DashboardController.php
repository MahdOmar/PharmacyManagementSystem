<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Medicine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()

    {
        $today = Carbon::now();
        
        
        $today_sale = Medicine::join('sales', 'medicines.id', '=', 'Product_id')
                                ->whereDate('sales.created_at', '=',$today)
                                ->sum(DB::raw('Prix_V * sales.Quantity')) ;
          

        $yesterday = Carbon::yesterday();

        $yesterday_sale = Medicine::join('sales', 'medicines.id', '=', 'Product_id')
                                ->whereDate('sales.created_at', '=',$yesterday)
                                ->sum(DB::raw('Prix_V * sales.Quantity') ) ;


         $lw = Carbon::now()->subDays(7);  
         
         $lw_sale = Medicine::join('sales', 'medicines.id', '=', 'Product_id')
         ->whereBetween('sales.created_at',[$lw, Carbon::now()])
         ->sum(DB::raw('Prix_V * sales.Quantity')) ;


        $Price_v = Medicine::join('sales', 'medicines.id', '=', 'Product_id')
                             ->sum(DB::raw('Prix_V * sales.Quantity')) ;
        $Price_a = Medicine::join('sales', 'medicines.id', '=', 'Product_id')
                             ->sum(DB::raw('Prix_A * sales.Quantity')) ;                
        
        $revenue = $Price_v - $Price_a;

        $products = Medicine::all();
        $allProducts = count($products);

        $expired =  Medicine::whereDate('Exp_date', '<=',  $today )->get();
        $exp_products = count($expired);

        $out =  Medicine::where('Quantity', '=',  '0' )->get();
        $out_stock = count($out);

        $top = Sale::select(
            'medicines.Name',
            'medicines.Designation',
            DB::raw('SUM((sales.Quantity))  as total'))
            ->leftJoin('medicines', 'medicines.id', '=', 'sales.Product_id')
            ->groupBy('sales.Product_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

            error_log($top);
   


        return view('dashboard.index',['todaySales' => $today_sale , "yesSales" => $yesterday_sale,
                                       'lwSales' => $lw_sale , 'revenue' => $revenue, 
                                        'allProducts' => $allProducts, 'expProducts' => $exp_products,
                                        'outStock' => $out_stock, 'top' => $top] );

    }
}
