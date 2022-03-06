<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      } 

    public function index(){

        $products = Medicine::orderBy('Designation', 'ASC')->paginate(15);
     
           
             return view('product.index',['products' => $products]);
         }

         public function store(){ 

          
          $check = Medicine::where('N_lot','=', request('Lot'))->get();

       
         

          if(count($check) > 0)
          {
            
             return response()->json([
              "error"=>'N_lot Exist',
              
            ]);

          }

          else
          {

            $product = new Medicine();

           
            $product->N_lot = request('Lot');
     
            $product->Name = request('Name');
           
            $product->Designation = request('Desg');
            $product->Type = request('Type');
            $product->Quantity = request('Quan');
            $product->Exp_date = request('Date');
            $product->Prix_A = request('Prix_a');
            $product->Prix_V = request('Prix_v');
           

            $product->save();

           
         

           
           

            $products = Medicine::orderBy('Designation', 'ASC')->get();
     

            return $products;

          }
          
         }


         public function show(){

           
            $product = Medicine::find(request('id'));
           

            return response()->json([
                'product'=>$product,
             ]);


         }

         public function update(){

            $product = Medicine::find(request('id'));
             
            if($product->N_lot != request('Lot') )
            {

              $check = Medicine::where('N_lot','=', request('Lot'))->get();

              if(count($check) > 0)
              {
                
                 return response()->json([
                  "error"=>'N_lot Exist',
                  
                ]);
    
              }

              else
              {
                $product->N_lot = request('Lot');
            
     
                $product->Name = request('Name');
                
               
                $product->Designation = request('Desg');
               
                $product->Type = request('Type');
                $product->Quantity = request('Quan');
                $product->Exp_date = request('Date');
                $product->Prix_A = request('Prix_a');
                $product->Prix_V = request('Prix_v');
    
                
               
    
                $product->save();
                $products = Medicine::orderBy('Designation', 'ASC')->get();
         
                
    
                return $products;




              }


            }
            else 
            {

            $product->N_lot = request('Lot');
            
     
            $product->Name = request('Name');
            
           
            $product->Designation = request('Desg');
           
            $product->Type = request('Type');
            $product->Quantity = request('Quan');
            $product->Exp_date = request('Date');
            $product->Prix_A = request('Prix_a');
            $product->Prix_V = request('Prix_v');

            
           

            $product->save();
            $products = Medicine::orderBy('Designation', 'ASC')->get();
     
            

            return $products;
 
          }
             


              
           
          }

          public function destroy(){

            error_log('--------------');
            $product = Medicine::findOrfail(request('id'));
          
          
            $product->delete();

             return response()->json([
              "success"=>'Product removed',
            
            ]);
        }


        public function filter()
        {
  
          if(request('filter') == "Quan")
          {

            $products = Medicine::orderBy('Quantity', 'DESC')->get();

            return $products;
           
  
            
          }
          else if(request('filter') == "Date")
          {
            $products = Medicine::orderBy('Exp_date', 'ASC')->get();

            return $products;
           
  
  
          }
  
          else if(request('filter') == "Price"){
            $products = Medicine::orderBy('Prix_V', 'DESC')->get();

            return $products;
           
  
  
          }
          else{

            $products = Medicine::orderBy('Designation', 'ASC')->get();
            return $products;


          }
  
  
  
  
        }
      






}
