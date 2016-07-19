@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of products </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>code</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Main image</th>
                    <th>Liquid product</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
                @foreach($productsList as $p)
                 <tr>  
                    <td>{{ $p->product_id }}</td>
                    <td>{{ $p->code }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->price }}</td>
                    <td><img style="width:100px;" src="images/products/<?php echo $p->img1; ?>"/></td>
                    <td align="center" valign="middle">
                        @if($p->liquid_product == 1)
                             <img style="width:30px; margin-top:28px;" src="images/check.png">
                        @endif

                         @if($p->liquid_product == 0)
                             <img style="width:30px; margin-top:28px;" src="images/red_x.png">
                        @endif
                    </td>
                    <td>{{ $p->sub_category_title }}</td>
                    <td>
                        <a href="{{ route('edit_products_path', $p->product_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                      <!--   <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('delete_products_path', $p->product_id) }}"><i class="fa fa-trash-o fa-fw"></i></a> -->
                    </td>
                 
                </tr>
                @endforeach
              
                
           
            </tbody>
        </table>

        <a href="{{ route('create_products_path') }}" class="btn btn-primary">CREATE A PRODUCT </a>

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