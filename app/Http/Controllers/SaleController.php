<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\Medicine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }
    
    
    
        public function index(){

          $today = Carbon::now();

          $sales = Sale::with('medicine')->whereDate('created_at', '=',$today)->get();

          $products =  Medicine::orderBy('Designation', 'ASC')->get();


        

    
            return view('Sales.index',['sales' => $sales, 'products' => $products ]);

        }

        public function store()
        {

        
         
          $product = Medicine::find(request('Name'));
          
         if( !$product)
         {
          return response()->json([
            "error"=>'Proudct not Exist'
            
          ]);


         }

        

          $stock = $product->Quantity;
        

         

          if( $stock >= request('Quan') )
          {
            $product->Quantity =  $product->Quantity - request('Quan');

            $sale = new Sale();
            $sale->Product_id = request('Name');
            $sale->Quantity = request('Quan');

            

            $sale->save();
            $product->save();

           
          $today = Carbon::now();

          $sales = Sale::with('medicine')->whereDate('created_at', '=',$today)->get();

            return $sales;



          }
          else 
          {

            return response()->json([
              "error"=>'Pas de Quantité',
              
            ]);




          }

        }


        public function store_sec(Request $request)
        {

          if($request->get('query'))
          {
           $query = $request->get('query');
          
           $data = DB::table('medicines')
             ->where('Designation', 'LIKE', "{$query}%")
             ->where('Quantity', '>', "0")
             ->orderBy('Exp_date', 'ASC')
             ->get();
            
           $output = '<ul class="dropdown-menu text-capitalize" style="display:block; position:relative">';
           foreach($data as $row)
           {
            $output .= '
            <li id='.$row->id.'><a href="#">'.$row->Designation.'</a></li>
            ';
           }
           $output .= '</ul>';
          
           return $output;
          }


        }




        public function show()
        {

          $sale = Sale::with('medicine')->find(request('id'));

          return response()->json([
            'sale'=>$sale,
          ]);

        }

        public function update()
        {
          $product = Medicine::find(request('Name'));
          $sale = Sale::find(request('id'));
         

          if($product->id == $sale->Product_id)
          {
            $product->Quantity = $product->Quantity + $sale->Quantity;
            
          }

          else{
           
            $old_product = Medicine::find($sale->Product_id);
           
            $old_product->Quantity += $sale->Quantity;
           
            
            $old_product->save();
          }
          
         
 

          $stock = $product->Quantity ;

          if( $stock >= request('Quan') )
          {
         
         
          $product->Quantity =  $product->Quantity - request('Quan');
          $sale->Product_id = request('Name');
          $sale->Quantity = request('Quan');
          $sale->save();
          $product->save();

        
          $today = Carbon::now();

          $sales = Sale::with('medicine')->whereDate('created_at', '=',$today)->get();

          return $sales;


          }
          else
          {
            return response()->json([
              "error"=>'Pas de Quantité',
              
            ]);



          }
      
          



        }

        public function destroy(){

        
          $sale = Sale::findOrfail(request('id'));

          $product = Medicine::find($sale->Product_id);
          $product->Quantity =  $product->Quantity + $sale->Quantity;
        
        
          $sale->delete();
          $product->save();

           return response()->json([
            "success"=>'Product removed',
          
          ]);
      }


      public function all()
      {

        $sales = Sale::with('medicine')->orderBy('created_at', 'DESC')->paginate(15);


        $products =  Medicine::orderBy('Designation', 'ASC')->get();
        
        return view('Sales.allSales', ['sales' => $sales ,"products" => $products]);



      }

      public function filter()
      {

        if(request('date') == "yes")
        {
          $yesterday = Carbon::yesterday();
          
          $sales = Sale::with('medicine')->whereDate('created_at',"=",$yesterday)->get();

          return $sales;
        }
        else if(request('date') == "lw")
        {

          $date = Carbon::now()->subDays(7);
          $sales = Sale::with('medicine')->whereBetween('created_at',  [$date,Carbon::now()])->get();

          return $sales;


        }

        else if(request('date') == "lm")
        {
          $date = Carbon::now()->subDays(30);
          $sales = Sale::with('medicine')->whereBetween('created_at',  [$date,Carbon::now()])->get();

          return $sales;


        }
        else{

          $sales = Sale::with('medicine')->orderBy('created_at', 'DESC')->get();
          return $sales;


        }




      }
    
    
}