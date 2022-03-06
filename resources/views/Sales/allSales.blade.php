
@extends('layouts.dashboard')
@section('content')


<div class="m-3">

  <h4><a class="text-info" href="/dashboard/stats">Dashborad</a> / All Sales </h4>


</div>



<div  class="shadow  p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">
    <div class="row">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" id="search" placeholder="search" >
      </div>

    <div class="col-md-6  d-flex " style="width:350px">
        <label class="m-2  " for="date">Date</label> 
                          <select name="date"  id="date" class="form-control form-select m-0 "      >
                                  <option value="All">All</option>
                                  <option value="yes">Yesterday</option>
                                  <option value="lw">Last Week</option>
                                  <option value="lm">last Month</option>
                                 
                          </select>
  
    </div>
</div>
    <table id="datatable-export" class="table table-bordered table-hover text-center table-center mt-3 mb-0">
        <thead class="bg-success text-white">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Date</th>
                <th >Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($sales as $sale)

             
            <tr>
              <td> {{$sale->medicine->Name}}  {{$sale->medicine->Designation}}</td>
              <td>{{$sale->Quantity}} </td>
              <td> {{ number_format($sale->medicine->Prix_V,2,".",",")  }} DA</td>
              <td>{{ number_format($sale->medicine->Prix_V * $sale->Quantity,2,".",",")}} DA</td>
              <td>{{$sale->created_at->format('d/m/Y')}} </td>
              
              <td><a href=""  data-toggle="modal" data-target="#edit" class="btn btn-primary text-white" role="button" onclick="getsale({{ $sale->id }})"  ><i class="fas fa-edit"></i></a>
  
                    <button class='btn btn-danger'  onclick="deletesale({{ $sale->id }})" id="btn{{ $sale->id }}"  ><i class="fas fa-trash"></i></button>
            </td>
          

          </tr>
          @endforeach
                  

          
        </tbody>
    </table>
    <div class="pagination d-flex justify-content-center mt-4 ">
      {{ $sales->links('pagination::bootstrap-4')}}
  
    </div>





</div>    

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit sale</h4>
           
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
      
           <p class="text-success success text-center"></p>
           <input type="hidden" name="edit_id" id="id">
           <div class="form-group">
            <label for="nameE">Nom:</label>
            <select class=" form-select form-control" name="Name" id="NameE">
              @foreach ($products as $product)
              <option value="{{ $product->id }}"    >{{ $product->Designation }}</option>
                  
              @endforeach
              
            </select>
           
           
    </div>
  
           <div class="form-group">
            <label for="QuanE">Quan:</label>
            <input type="number"   class="form-control" id="QuanE" name="QuanE" min="0"  required>
           
          </div>
  
    
  
    
        </div>
        <div class="modal-footer">
            <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
          >
            Fermer
          </button>
          <div class="form-group">
          <button  class="btn btn-dark update">Edit </button>
          </div> 
        </div>
      </form>
      </div>
  
    </div>
  </div>







 @endsection

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


 <script>

$(function(){
       
       $('#date').change(function(){

           console.log('ouiiiiiiiiii');
        
        
        $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
          
         
          var date = $(this).val();
      
         
          $.ajax({
             url : '/dashboard/sales/filter',
             data: {'date':date},
             type: 'get',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {
           
              $('tbody').html('')

              $.each(result, function(key, item){

                var dateString = moment(item.created_at).format('DD/MM/YYYY');
              
               
              $('tbody').append('\
              <tr>\
            <td>'+item.medicine.Name+' '+item.medicine.Designation+'</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+item.medicine.Prix_V.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+' DA</td>\
            <td>'+(item.medicine.Prix_V * item.Quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
            <td>'+dateString+' </td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"  role="button" onclick="getsale('+item.id+')"><i class="fas fa-edit"></i></a>\
                <button onclick="deletesale('+item.id+')" id="btn'+item.id+'" class="btn btn-danger" ><i class="fas fa-trash"></i></button>\
        \
              </tr>')


             })
               

              
                 
                
             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });
          
       });
      
   });


   function getsale(id){

$('.success').text("")

$.ajaxSetup({
 headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
});
       

     
      var data = {

        'id': id,
       
      }



      $.ajax({
         url : '/dashboard/sales/show',
         data: data,
         type: 'get',
       //  contentType: "application/json; charset=utf-8",
         dataType: 'json',
         success: function(result)
         {
          
            $('#id').val(result.sale.id)
            $('#NameE').val(result.sale.medicine.id);
            $('#QuanE').val(result.sale.Quantity);
           



          
        
          

         }
      
        ,
         error: function()
        {
            //handle errors
            alert('error...');
        }
      });

}



      $(function(){
   
   $('.update').click(function(){
       $.ajaxSetup({
 headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
});
       
      
     
      var data = {
        'id': $('#id').val(),
       
        'Name': $('#NameE').val(),
        'Quan': $('#QuanE').val(),
        
       
      }
       
        
  
      $.ajax({
         url : '/dashboard/sales/update',
         data: data,
         type: 'post',
       //  contentType: "application/json; charset=utf-8",
         dataType: 'json',
         success: function(result)
         {
        
         $('tbody').html('')
      
       

        
         $.each(result, function(key, item){
          var dateString = moment(item.created_at).format('DD/MM/YYYY');
          
           
          $('tbody').append('\
          <tr>\
        <td>'+item.medicine.Name+' '+item.medicine.Designation+'</td>\
        <td>'+item.Quantity+'</td>\
        <td>'+(item.medicine.Prix_V).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
        <td>'+(item.medicine.Prix_V * item.Quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
        <td>'+dateString+' </td>\
        <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"  role="button" onclick="getsale('+item.id+')"><i class="fas fa-edit"></i></a>\
            <button onclick="deletesale('+item.id+')" id="btn'+item.id+'" class="btn btn-danger" ><i class="fas fa-trash"></i></button>\
    \
          </tr>')


         })

       

         },
         error: function()
        {
            //handle errors
            alert('error...');
        }
      });
   });
  
});









   function deletesale(id)

{
   $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }       
    });

    swal({
     title: 'Are you sure?',
     text: 'This record and it`s details will be permanantly deleted!',
     icon: 'warning',
     dangerMode: true,
     buttons: ["Cancel", "Yes!"],
 }).then(function(value) {
     if (value) {
    
    $.ajax({
          url : '/dashboard/sales/delete',
          data:{'id':id},
          type: 'delete',
        //  contentType: "application/json; charset=utf-8",
          dataType: 'json',
          success: function(result)
          {
         
           $("#btn"+id).closest("tr").remove();
       

          },
          error: function()
         {
           
             alert('error...');
         }
       });

     }
 });


  


}

$(document).ready(function(){
 
  $("#search").on("keyup", function() {
    console.log('mmmmmmmmmmmm');
    var value = $(this).val().toLowerCase();
    $("tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


});






 </script>