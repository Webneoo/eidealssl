@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of medias </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Media #</th>
                    <th>Image</th>
                    <th>Product #</th>
                    <th>Product name</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
          
                @foreach($mediaList as $m)
                 <tr>
                    <td>{{ $m->media_id }}</td>
                    <td><img style="width:100px;" src="images/medias/<?php echo $m->img; ?>"/></td>
                    <td>{{ $m->product_id }}</td>
                    <td>{{ $m->title }}</td>
                    <td>{{ $m->updated_at }}</td>
                    <td>
                        <a href="{{ route('edit_media_path', $m->media_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('delete_media_path', $m->media_id) }}"><i class="fa fa-trash-o fa-fw"></i></a>
                    </td>
                 
                </tr>
                @endforeach
          
            </tbody>
        </table>

        <a href="{{ route('create_media_path') }}" class="btn btn-primary">CREATE A MEDIA </a>

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