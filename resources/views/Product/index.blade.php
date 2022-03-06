
@extends('layouts.dashboard')

@section('content')

<div class="m-3">

  <h4><a class="text-info" href="/dashboard/stats">Dashborad</a> /  Stock </h4>

</div>

<div  class="row shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">

  <div class="col-md-3 ">
    <input type="text" name="search" class="form-control" id="searchP" placeholder="search" >

  </div>

  <div class="col-md-3">

    <select name="filter"  id="filter" class="form-control form-select mt-1 "  >
      <option value="" selected disabled>Filter by</option>
            <option value="Quan">Quantity</option>
            <option value="Date">Exp_Date</option>
            <option value="Price">Price</option>  
            <option value="Def">Default</option>
    </select>

  </div>

  <div class="col-md-6 " >
    <button  class="btn btn-primary  m-2  text-white" type="button" data-toggle="modal" data-target="#product" style="float:right" ><i class="fas fa-plus-square m-1"></i>Add Product</button>

  </div>
       
     
      
       

 
       <table class="table  table-bordered  table-hover text-center">
        <thead class="bg-success text-white">
          <tr>
            <th>N_lot</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Quan</th>
            <th>Exp_Date</th>
            <th>Price</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>

          @foreach($products as $product)
          <tr>
            <td>{{ $product->N_lot }} </td>
            <td>{{ $product->Name }}</td>
            <td >{{ $product->Designation }}</td>
            <td>{{ $product->Quantity }}</td>
            <td>{{ $product->Exp_date }}</td>
            <td>    {{ number_format($product->Prix_V,2,".",",")  }} DA</td>
          
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"   role="button" onclick="getProduct({{$product->id}})" ><i class="fas fa-edit"></i></a>
        
                <button onclick="deleteProduct({{ $product->id }})" id="btn{{ $product->id }}"   class='btn btn-danger' ><i class="fas fa-trash"></i></button>
      
              
          </tr>
          @endforeach
       
      
        </tbody>
       </table>
       <div class="pagination d-flex justify-content-center mt-4 ">
        {{ $products->links('pagination::bootstrap-4')}}
    
      </div>
</div>

     <div id="product" class="modal" role="dialog">
        <div class="modal-dialog modal-md">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
               
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
          
               <p class="text-success success text-center"></p>
               <p class="text-danger error text-center"></p>
        <div class="form-group row " >
                <div class="col-md-6">
                      <label for="lot">N_lot:</label>
                      <input type="text" class="form-control" name="lot" id="Lot"  required>
                  
                </div>
                <div class="col-md-6">
                      <label for="Type">Type:</label>
                      <select name="Type"  id="Type"   class="form-control"  required >
                              <option value="medicine">Medicine</option>
                              <option value="Para">Parapharm</option>
                           
                    </select>
                </div>
        </div>
        <div class="form-group">
            <label for="Name">Name:</label>
            <input type="text"   class="form-control" id="Name" name="Name" required>
           
    </div>
      
        <div class="form-group">
                <label for="Desg">Designation:</label>
                <input type="text"   class="form-control" id="Desg" name="Desg" required>
               
        </div>

        <div class="form-group row " >
            <div class="col-md-6">
                  <label for="Quan">Quan:</label>
                  <input type="number" class="form-control" id="Quan" name="Quan" step="1"   required>
              
            </div>
            <div class="col-md-6">
                  <label for="Date">Exp_Date:</label>
                  <input type="date"   class="form-control" id="Date" name="Date" required>
                 
            </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
                <label for="price_a">Price_Achat:</label>
                <input type="number"   class="form-control" id="price_a" step="0.1"  name="price_a" required>


        </div>

        <div class="col-md-6">
                <label for="price_v">Price_Vente:</label>
                <input type="number"   class="form-control" id="price_v" step="0.1"  name="price_v" required>
        </div>


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
              <button  class="btn btn-dark submit">Add </button>
              </div> 
            </div>
          </form>
          </div>
      
        </div>
      </div>
        


      <div id="edit" class="modal" role="dialog">
        <div class="modal-dialog modal-md">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Product</h4>
               
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
          
               <p class="text-success successe text-center"></p>
               <p class="text-danger errore text-center"></p>
               <input type="hidden" id="id" name="id">
        <div class="form-group row " >
                <div class="col-md-6">
                      <label for="lot">N_lot:</label>
                      <input type="text" class="form-control" name="lot" id="LotE"  required>
                  
                </div>
                <div class="col-md-6">
                      <label for="Type">Type:</label>
                      <select name="Type"  id="TypeE"   class="form-control"  required >
                              <option value="medicine">Medicine</option>
                              <option value="Para">Parapharm</option>
                           
                    </select>
                </div>
        </div>
        <div class="form-group">
            <label for="NameE">Name:</label>
            <input type="text"   class="form-control" id="NameE" name="Name" required>
           
    </div>
      
        <div class="form-group">
                <label for="DesgE">Designation:</label>
                <input type="text"   class="form-control" id="DesgE" name="Desg" required>
               
        </div>

        <div class="form-group row " >
            <div class="col-md-6">
                  <label for="Quan">Quan:</label>
                  <input type="number" class="form-control" id="QuanE" name="Quan" step="1"   required>
              
            </div>
            <div class="col-md-6">
                  <label for="Date">Exp_Date:</label>
                  <input type="date"   class="form-control" id="DateE" name="Date" required>
                 
            </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
                <label for="price_a">Price_Achat:</label>
                <input type="number"   class="form-control" id="price_aE" step="0.1"  name="price_a" required>


        </div>

        <div class="col-md-6">
                <label for="price_v">Price_Vente:</label>
                <input type="number"   class="form-control" id="price_vE" step="0.1"  name="price_v" required>
        </div>


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
           
            'Lot': $('#Lot').val(),
            'Type': $('#Type').val(),
            'Name': $('#Name').val(),
            'Desg': $('#Desg').val(),
            'Quan': $('#Quan').val(),
            'Date': $('#Date').val(),
            'Prix_a': $('#price_a').val(),
            'Prix_v': $('#price_v').val(),
           
          }
           
            
      
          $.ajax({
             url : '/dashboard/product/save',
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

               

              $('tbody').html('')
              $('.success').text('Product Added');
            
              $.each(result, function(key, item){
             
              $('tbody').append('\
              <tr>\
            <td>'+item.N_lot+'</td>\
            <td>'+item.Name+'</td>\
            <td >'+item.Designation+'</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+item.Exp_date+' </td>\
            <td>'+item.Prix_V.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+' DA</td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"  role="button" onclick="getProduct('+item.id+')" ><i class="fas fa-edit"></i></a>\
                <button  class="btn btn-danger" onclick="deleteProduct('+item.id+')" id="btn'+item.id+'"  ><i class="fas fa-trash"></i></button>\
        \
              </tr>')


             })

             $('#Lot').val(''),
             $('#Name').val(''),
             $('#Desg').val(''),
             $('#Quan').val(''),
             $('#Date').val(''),
             $('#price_a').val(''),
             $('#price_v').val(''),



             setTimeout(function() { $('.success').text('');}, 3000);


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


   function getProduct(id){



    console.log('----------------')

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
   
  var data = {

    'id': id,
   
  }

  console.log(data)

  $.ajax({
     url : '/dashboard/product/show',
     data: data,
     type: 'get',
   //  contentType: "application/json; charset=utf-8",
     dataType: 'json',
     success: function(result)
     {

      console.log(result.product.id)
    
        $('#id').val(result.product.id)

         $('#LotE').val(result.product.N_lot),
         $('#TypeE ').val(result.product.Type),
         $('#NameE').val(result.product.Name),
         $('#DesgE').val(result.product.Designation),
         $('#QuanE').val(result.product.Quantity),
         $('#DateE').val(result.product.Exp_date),
         $('#price_aE').val(result.product.Prix_A),
         $('#price_vE').val(result.product.Prix_V)



      
    
      

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
            'id':$('#id').val(),
            'Lot': $('#LotE').val(),
            'Type': $('#TypeE').val(),
            'Name': $('#NameE').val(),
            'Desg': $('#DesgE').val(),
            'Quan': $('#QuanE').val(),
            'Date': $('#DateE').val(),
            'Prix_a': $('#price_aE').val(),
            'Prix_v': $('#price_vE').val()
          }
           
            
      
          $.ajax({
             url : '/dashboard/product/update',
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

               
             
              $('tbody').html('');
              $('.successe').text('Product Edited')
               

             $.each(result, function(key, item){
          
               

              $('tbody').append('\
              <tr>\
            <td>'+item.N_lot+'</td>\
            <td>'+item.Name+'</td>\
            <td>'+item.Designation+'</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+item.Exp_date+' </td>\
            <td>'+item.Prix_V.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+' DA </td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"  role="button" onclick="getProduct('+item.id+')"><i class="fas fa-edit"></i></a>\
                <button  class="btn btn-danger" onclick="deleteProduct('+item.id+')" id="btn'+item.id+'"  ><i class="fas fa-trash"></i></button>\
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

   function deleteProduct(id)

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
             url : '/dashboard/product/delete',
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


   $(function(){

$('#filter').change(function(){

console.log('ouiiiiiiiiii');


$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


var filter = $(this).val();


$.ajax({
  url : '/dashboard/products/filter',
  data: {'filter':filter},
  type: 'get',
//  contentType: "application/json; charset=utf-8",
  dataType: 'json',
  success: function(result)
  {

   $('tbody').html('')

   $.each(result, function(key, item){

     var dateString = moment(item.created_at).format('DD-MM-YYYY');
   
    
   $('tbody').append('\
   <tr>\
            <td>'+item.N_lot+'</td>\
            <td>'+item.Name+'</td>\
            <td >'+item.Designation+'</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+item.Exp_date+' </td>\
            <td>'+item.Prix_V.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+' DA</td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#edit"  role="button" onclick="getProduct('+item.id+')" ><i class="fas fa-edit"></i></a>\
                <button  class="btn btn-danger" onclick="deleteProduct('+item.id+')" id="btn'+item.id+'"  ><i class="fas fa-trash"></i></button>\
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

   
   
$(document).ready(function(){
  $("#searchP").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});






let number = 1000;
let num = 45.25
console.log(number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));


  </script>