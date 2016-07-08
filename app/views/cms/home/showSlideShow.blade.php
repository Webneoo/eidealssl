@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Slideshow images</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Images</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
             @foreach ($slideShowList as $s)
             <tr>    
                <td>{{ $s->image_id }}</td>
                <td> <img src="images/slideshow/{{ $s->img_url }}" style="height:60px;"></td>
                <td>{{ $s->slideshow_date }}</td>
                <td>
                    <a href="{{ route('edit_slideshow_path', $s->image_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                    <a onclick="return confirm('Are you sure you want to delete this image?')" href="{{ route('delete_slideshow_path', $s->image_id) }}"><i class="fa fa-trash-o fa-fw"></i></a>
                </td>
            </tr>
             @endforeach

            </tbody>
        </table>

        <a href="{{ route('create_slideshow_path') }}" class="btn btn-primary">Add an image</a>

    </div>

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