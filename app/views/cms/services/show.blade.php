@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of Services </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Carousel pictures</th>
                    <th>Videos</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
         
         @foreach($service_list as $s)   
            <tbody>    
                   <td>{{ $s->service_id }}</td>
                   <td>{{ $s->title }}</td>
                   <td><a href="{{ route('show_service_images_path', $s->service_id) }}">({{ $s->image_number }}) images</a> </td>
                   <td><a href="{{ route('show_service_videos_path', $s->service_id) }}">({{ $s->video_number }}) videos</a> </td>
                   <?php // change the format of the date 
                        $date=date_create($s->updated_at);  
                        $real_date = date_format($date,"Y-m-d");
                    ?>
                   <td> {{ $real_date }}</td>
                   <td>
                    <a href="{{ route('edit_service_path', $s->service_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                    <form action="edit-service" method="POST" style="display:inline-block;">
                        <input type="hidden" name="service_id" value="{{ $s->service_id }}">
                        <button class="blue_icons"  onclick="return confirm('Are you sure you want to delete?')"> <i class="fa fa-trash-o fa-fw"></i> </button>
                    </form>
                   </td>
            </tbody>
        @endforeach
        
        </table>

        <a href="{{ route('create_service_path') }}" class="btn btn-primary">CREATE NEW SERVICE </a>

    </div>

    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
             //   "order": [[ 4, "desc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop