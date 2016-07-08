@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Choose your 4 best sellers products </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')


    <div class="row">
        {{ Form::open(['route' => 'best_seller_management_path', 'role' => 'form']) }}
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>code</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Main image</th>
                    <th>Category</th>
                    <th>Best Seller</th>
                </tr>
            </thead>
            <tbody>

                @foreach($productsList as $p)
                 <tr>  
                    <td>{{ $p->product_id }}</td>
                    <td>{{ $p->code }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->price }}</td>
                    <td><img style="width:80px;" src="images/products/<?php echo $p->img1; ?>"/></td>
                    <td>{{ $p->sub_category_title }}</td>
                    <td>
                        <input id="best_seller" style="width:20px; height:20px;" name="best_seller[]" type="checkbox" value="{{ $p->product_id}}" <?php if($p->best_seller == 1) echo "checked"; ?>>
                        <?php 
                            if( $p->best_seller == 1 ) echo 'YES'; 
                            if( $p->best_seller == 0 ) echo 'NO'; 
                        ?>
                    </td>                
                </tr>
                @endforeach
          
            </tbody>
        </table>

         <input class="btn btn-primary" type="submit" name="submit_best_seller" value="SUBMIT CHANGE" />    
            {{ Form::close() }}
        

    </div>

    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
                "order": [[ 0, "asc" ]]
            });
        });


        // Unable to select more than 4 checkboxes 
        $('input[type="checkbox"]').change(function(event) {
          if ($('input[type="checkbox"]:checked').length > 4) {
               alert("You're not allowed to choose more than 4 products");
              $(this).prop('checked', false); 
          }
          else {
              $('input[type="checkbox"]').not(':checked').removeProp('disabled');
          } 
      });


        // block the form if we select less than 4 checkboxes
        $('input[type="submit"]').click(function(event) {
          if ($('input[type="checkbox"]:checked').length < 4) {
               alert("You have to choose 4 products in order to proceed");
             event.preventDefault();
          }
      });




    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop