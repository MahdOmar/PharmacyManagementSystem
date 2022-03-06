@extends('layouts.dashboard')

@section('content')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($products) > 0)
                    <h2 class="text-danger text-center">ATTENTION!!!!!!! </h2>
                    <h3 class="text-danger m-3 text-center">Des Produits Presque Périmés</h3>
                   
                    <table class="table  table-bordered  table-hover text-center">
                     <thead>
                       <tr>
                         <th>N_lot</th>
                         <th>Nom</th>
                         <th>Designation</th>
                         <th>Date_Permp</th>
                         
                        
                       </tr>
                     </thead>
                     <tbody>
             
                       @foreach($products as $product)
                       <tr>
                         <td>{{ $product->N_lot }} </td>
                         <td>{{ $product->Name }}</td>
                         <td>{{ $product->Designation }}</td>
                         <td>{{ $product->Exp_date }}</td>
                         
                       
                        
                       </tr>
                       @endforeach
                    
                   
                     </tbody>
                    </table>
                    @else
                   <h3 class="text-center">Bienvenu sur Pharmacy</h3>
                        
                    @endif
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
