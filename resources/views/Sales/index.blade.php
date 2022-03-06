
@extends('layouts.dashboard')

@section('content')

<div class="m-3">

  <h4><a class="text-info" href="/dashboard/stats">Dashborad</a> / Today Sales </h4>


</div>



<div  class="shadow  p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">

  <div class="d-flex flex-row-reverse">
    <h4 class="m-2 float-right  "  >
      <a role="button" class="btn btn-success  " href="/dashboard/allsales">All Sales</a>  </h4>
  

  </div>
  
  <div class="row">
  <div class="col-md-8">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
    
        <h5 class="mt-2">Sales</h5>
    
        <h5 class="mt-2 text-right">Today: {{ date('d-M-Y') }}</h5>
        
        
    </div>
    <div class="card-body">
        <div>
            <table id="datatable-export" class="table table-hover table-bordered text-center table-center mb-0">
                <thead class="bg-success text-white">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                     
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>

                  @php
                  $total = 0;
              @endphp
              @foreach($sales as $sale)

             
              <tr>
                <td>{{$sale->medicine->Designation}}</td>
                <td>{{$sale->Quantity}} </td>
                <td> {{ number_format($sale->medicine->Prix_V,2,".",",")  }} DA</td>
                <td>{{ number_format($sale->medicine->Prix_V * $sale->Quantity,2,".",",")}} DA</td>
                
                <td><a href=""  data-toggle="modal" data-target="#edit" class="btn btn-primary text-white" role="button" onclick="getsale({{ $sale->id }})"  ><i class="fas fa-edit"></i></a>
    
                      <button class='btn btn-danger'  onclick="deletesale({{ $sale->id }})" id="btn{{ $sale->id }}"  ><i class="fas fa-trash"></i></button>
              </td>
            

            </tr>
            @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
  </div>

  <div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mt-2">Add Sale</h5>
            
        </div>
        <div class="card-body">

         

        <div class="col-12">
          <p class="text-success success text-center"></p>
          <p class="text-danger error text-center"></p>
          <div class="form-group mb-3">
            <input type="hidden" name="edit_id" id="idp">
              <label>Product <span class="text-danger">*</span></label>
              <input type="text"  id="Name" class="form-control text-capitalize" placeholder="Enter Product name" name="product" autocomplete="off" required>
              <div id='medicineList'> </div>
          
            </div>
      </div>
       
        <div class="col-12">
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" value="1" id="Quan" class="form-control edit_quantity" name="quantity">
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-block  submit">Save Changes</button>
       
        </div>
    </div>
</div>



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
    
         <p class="text-success successe text-center"></p>
         <p class="text-danger errore text-center"></p>
         <input type="hidden" name="edit_id" id="id">
         <input type="hidden" name="edit_id" id="idpE">
         <div class="form-group mb-2">
          <label>Product </label>
          <input type="text"  id="NameE" class="form-control text-capitalize"  name="productE" autocomplete="off" required>
          <div id='medicineListE'> </div>
         
         
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
       
       $('.submit').click(function(){
           $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
           

         
          var data = {
           
            'Name': $('#idp').val(),
            'Quan': $('#Quan').val(),
          
           
          }
           
            
      
          $.ajax({
             url : '/dashboard/sales/save',
             data: data,
             type: 'post',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {

              if(result.error)
               {
                 console.log(result.error);
                $('.error').text(result.error)
                setTimeout(function() { $('.error').text('');}, 2000);
               }
            
           else 
           {
            $('.error').text('');
            $('#idp').val('');
            $('#Name').val('');
            $('#Quan').val('1');

            $

            $('.success').text('Sale Added')
            
             $('tbody').html('')
          
           //  $('.success').text(result.success)
       

            
             $.each(result, function(key, item){
              var dateString = moment(item.created_at).format('DD/MM/YYYY');
              
               
              $('tbody').append('\
              <tr>\
            <td>'+item.medicine.Designation+'</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+(item.medicine.Prix_V).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
            <td>'+(item.medicine.Prix_V * item.Quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"  role="button" onclick="getsale('+item.id+')"><i class="fas fa-edit"></i></a>\
                <button onclick="deletesale('+item.id+')" id="btn'+item.id+'" class="btn btn-danger" ><i class="fas fa-trash"></i></button>\
        \
              </tr>')


             })
           }
            
           setTimeout(function() { $('.success').text('');}, 1000);


            /*    */
             

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
                $('#idpE').val(result.sale.medicine.id)

                $('#NameE').val(result.sale.medicine.Designation);
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
           
            'Name': $('#idpE').val(),
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
              if(result.error)
               {
                 console.log(result.error);
                $('.errore').text(result.error)
                setTimeout(function() { $('.errore').text('');}, 2000);
               }
            
           else 
           {

            $('.successe').text('Sale Edited')
             $('tbody').html('')
          
           

            
             $.each(result, function(key, item){
              var dateString = moment(item.created_at).format('DD-MM-YYYY');
              
               
              $('tbody').append('\
              <tr>\
            <td>'+item.medicine.Designation+'</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+(item.medicine.Prix_V).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
            <td>'+(item.medicine.Prix_V * item.Quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"  role="button" onclick="getsale('+item.id+')"><i class="fas fa-edit"></i></a>\
                <button onclick="deletesale('+item.id+')" id="btn'+item.id+'" class="btn btn-danger" ><i class="fas fa-trash"></i></button>\
        \
              </tr>')


             })


             setTimeout(function() { $('.successe').text('');
             $('#edit').modal('toggle');}, 1000);


            }

           

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

    $(document).on('blur','#Name ,#NameE', function() {
      $('#medicineList').fadeOut(); 
      $('#medicineListE').fadeOut(); 
  
});


   $('#Name').keyup(function(){ 

    $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
        var query = $(this).val();

        if(query == '')
        {
          $('#medicineList').fadeOut();  

        }


        else(query != '')
        {
        
         $.ajax({
          url:"/dashboard/sale/save",
          method:"POST",
          data:{query:query},
          success:function(data){
            console.log(data)
           $('#medicineList').fadeIn();  
          $('#medicineList').html(data);

                    console.log( $('#medicineList').html(data));
          }
         });
        }
    });

    $(document).on('click', 'li', function(){ 
      if( $('#Name').val() != '')
      {
        $('#Name').val($(this).text());  
        $('#idp').val($(this).attr('id'));  
        $('#medicineList').fadeOut();  
      } 
       
    });  


});

$(document).ready(function(){
   $('#NameE').keyup(function(){ 

    $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
        var query = $(this).val();

        if(query == '')
        {
          $('#medicineListE').fadeOut();  

        }


        else(query != '')
        {
        
         $.ajax({
          url:"/dashboard/sale/save",
          method:"POST",
          data:{query:query},
          success:function(data){
            console.log(data)
           $('#medicineListE').fadeIn();  
          $('#medicineListE').html(data);

                    console.log( $('#medicineListE').html(data));
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
      if( $('#NameE').val() != '')
      {

        $('#NameE').val($(this).text());  
        $('#idpE').val($(this).attr('id'));  
       
        $('#medicineListE').fadeOut();  
      }
        
    });  

   
});




   
   



  </script>