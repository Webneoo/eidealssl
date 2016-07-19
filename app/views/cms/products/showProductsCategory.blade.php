@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Products Categories</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')


    <div class="row">
        
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Order date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($products_category as $p)
                 <tr>   
                    <td>{{ $p->sub_category_id }}</td> 
                    <td>{{ $p->title }}</td>
                    <td><img style="width:80px;" src="images/products_category/{{ $p->image }}"/></td>
                    <td>{{ $p->updated_at }}</td>
                    <td>
                        <a href="{{ route('edit_products_category_path', $p->sub_category_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                    </td>                
                </tr>
                @endforeach
          
            </tbody>
        </table>

    </div>

    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
                "order": [[ 2, "desc" ]]
            });
        });

    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop