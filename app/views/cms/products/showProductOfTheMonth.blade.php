@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Choose the product of the month </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')


    <div class="row">
        {{ Form::open(['route' => 'product_of_the_month_management_path', 'role' => 'form']) }}
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>code</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Main image</th>
                    <th>Category</th>
                    <th>Product of the month</th>
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
                        <input id="best_seller" style="width:20px; height:20px;" name="product_of_the_month" type="radio" value="{{ $p->product_id}}" <?php if($p->product_of_the_month != NULL) echo "checked"; ?>>
                    </td>                
                </tr>
                @endforeach
          
            </tbody>
        </table>

         <input class="btn btn-primary" type="submit" name="submit_product_month" value="SUBMIT CHANGE" />    
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


    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop