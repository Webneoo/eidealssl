@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of youtube videos for the service "{{ $service_details[0]->title }}"</h1>   </div>
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
            
                @foreach($service_videos as $s)
                 <tr>
                    <td>{{ $s->service_video_id }}</td>
                    <td>{{ $s->title }}</td>
                    <td><a target="_blank" href="https://www.youtube.com/watch?v={{ $s->url }}"> https://www.youtube.com/watch?v={{ $s->url }} </a></td>
                     <?php // change the format of the date 
                        $date=date_create($s->updated_at);  
                        $real_date = date_format($date,"Y-m-d");
                    ?>
                    <td>{{ $real_date }}</td>
                    <td>
                        <a href="{{ route('video_edit_service_path', $s->service_video_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                        <form action="video-delete-service" method="POST" style="display:inline-block;">
                            <input type="hidden" name="service_video_id" value="{{ $s->service_video_id }}">
                            <button class="blue_icons"  onclick="return confirm('Are you sure you want to delete this video?')"> <i class="fa fa-trash-o fa-fw"></i> </button>
                        </form>  
                    </td>
                </tr>
                @endforeach
            
            </tbody>
        </table>

        <a href="{{ route('create_video_service_path', $service_details[0]->service_id) }}" class="btn btn-primary">Add a new video</a>
        <a href="{{ route('services_management_path') }}" class="btn btn-default">Back to service list</a>

    </div>

    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
                "order": [[ 4, "desc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop