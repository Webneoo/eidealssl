@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of brands </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Brand title</th>
                    <th>Display & edit slideshow image</th>
                    <th>Edit details</th>
                    <th>Delete</th>
                </tr>
            </thead>
         
         @foreach($brandList as $b)   
            <tbody>    
                   <td>{{ $b->brand_id }}</td>
                   <td><img src="images/brands_logo/{{ $b->brand_logo }}"></td>
                   <td>{{ $b->brand_title }}</td>
                   <td><a href="{{ route('show_brand_slideshow_path', $b->brand_id) }}"><i class="fa fa-edit fa-fw"></i></a></td>
                   <td><a href="{{ route('edit_brand_details_path', $b->brand_id) }}"><i class="fa fa-edit fa-fw"></i></a></td>
                   <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('delete_brand_path', $b->brand_id) }}"><i class="fa fa-trash-o fa-fw"></i></a></td>
            </tbody>
        @endforeach
        
        </table>

        <a href="{{ route('create_brand_path') }}" class="btn btn-primary">CREATE A BRAND </a>

    </div>
{{dd('nouristas2')}}
    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop