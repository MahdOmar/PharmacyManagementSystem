@extends('layouts.dashboard')

@section('content')


<div class="m-3">

    <h4>Dashborad / <a class="text-info" href="/dashboard/stats">Stats</a> </h4>
  
  
</div>

<div  class="row shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">


    
    <div class="row">


        <div class="row col-md-8">
            <div class="d-flex flex-wrap">
                <div class=" w-50 ">
                    <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Today Sales</h5>
                            <span class="h2 font-weight-bold mb-0">{{ number_format($todaySales,2,".",",")  }} DA</span>
                          </div>
                          <div class="col-auto">
                            <div class="">
                                <img src="{{ asset('img/payment.png') }}" width="60" alt="">
                            </div>
                          </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                
                  <div class=" w-50">
                    <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Yesterday Sales</h5>
                            <span class="h2 font-weight-bold mb-0">{{ number_format($yesSales,2,".",",")  }} DA</span>
                          </div>
                          <div class="col-auto">
                            <div>
                                <img src="{{ asset('img/cash-payment.png') }}" width="60" alt="">
                            </div>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  </div>
                
                  <div class="w-50 ">
                    <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Last week Sales</h5>
                            <span class="h2 font-weight-bold mb-0">{{ number_format($lwSales,2,".",",")  }} DA</span>
                          </div>
                          <div class="col-auto">
                            <div class="">
                                <img src="{{ asset('img/cash-flow.png') }}" width="60" alt="">

                            </div>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  </div>

                  <div class="w-50 ">
                    <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Revenue</h5>
                            <span class="h2 font-weight-bold mb-0">{{ number_format($revenue,2,".",",")  }} DA</span>
                          </div>
                          <div class="col-auto">
                            <div class="">
                                <img src="{{ asset('img/revenue.png') }}" width="60" alt="">

                            </div>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  </div>
                  
                </div>

        </div>






        <div class="col-md-4 col-xl-4">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="m-0">{{ $allProducts }}</h2><br>

                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('img/medicine.png') }}" width="50" height="70" alt="">
                        </div>
                    </div>
                    <span class="text-c-blue">Total Products</span>

                    <p class="mb-3 mt-3">Total number of products in the pharmacy.</p>

                </div>
                <div id="support-chart"></div>
                <div class="card-footer bg-primary text-white">
                    <div class="row text-center">
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $allProducts }}</h4>
                            <span>Available</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $expProducts }}</h4>
                            <span>Running Out</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $outStock }}</h4>
                            <span>Out Stock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    
           
        <div class="row mt-4 mb-4">

          <div class="col-md-2">


          </div>

          <div class="col-md-8">

            <div class="card">
              <div class="card-header bg-success text-white">
                  <h5 class="mt-2">Top 5 Most Sold Product</h5>
                  
              </div>
              <div class="card-body">
                
            <table id="datatable-export" class="table table-hover table-bordered text-center table-center mb-0">
              <thead>
                  <tr>
                      <th>Product Name</th>
                      <th>Quantity</th>
                     
                  </tr>
              </thead>
              <tbody>
                @foreach($top as $sale)

             
                <tr>
                  <td>{{$sale->Name}} {{$sale->Designation}}</td>
                  <td>{{$sale->total}} </td>
                
              
  
              </tr>
              @endforeach
               
                  
              </tbody>
          </table>
      
          </div>
          
        </div>



          </div>

          <div class="col-md-2">


          </div>






        </div>
    
</div>   




@endsection