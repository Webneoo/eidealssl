@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of youtube videos</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>youtube URL</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
                @foreach($all_videos as $a)
                 <tr>
                    
                    <td>{{ $a->video_id }}</td>
                    <td>{{ $a->title }}</td>
                    <td><a target="_blank" href="https://www.youtube.com/watch?v={{ $a->url }}"> https://www.youtube.com/watch?v={{ $a->url }} </a></td>
                     <?php // change the format of the date 
                        $date=date_create($a->updated_at);  
                        $real_date = date_format($date,"Y-m-d");
                    ?>
                    <td>{{ $real_date }}</td>
                    <td>
                        <a href="{{ route('edit_video_path', $a->video_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete this video?')" href="{{ route('delete_video_path', $a->video_id) }}"><i class="fa fa-trash-o fa-fw"></i></a>
                    </td>
                 
                </tr>
                @endforeach
            
            </tbody>
        </table>

        <a href="{{ route('create_video_path') }}" class="btn btn-primary">Add a new video</a>

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