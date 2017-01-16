@extends('cms.layouts.default')

@section('content')

    <div class="row">
            <div class="col-lg-12">  <h1 class="page-header">Carousel images of the service "{{ $service_details[0]->title }}" </h1>  </div>
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
                    <th>Action</th>
                </tr>
            </thead>
        
            <tbody>

             @foreach($service_images as $s)
             <tr>    
                <td>{{ $s->service_carousel_id }}</td>
                <td> <img id="img_{{$s->service_carousel_id}}" src="images/services/{{ $s->image }}" style="height:60px;"></td>
                    <?php // change the format of the date 
                        $date=date_create($s->updated_at);  
                        $real_date = date_format($date,"Y-m-d");
                    ?>
                <td> <span id="service_date_{{$s->service_carousel_id}}">{{ $real_date }}</span></td>
             
                <td>    
                    <a href="{{route('edit_image_service_path', $s->service_carousel_id)}}"><i class="fa fa-edit fa-fw"></i></a>
                    
                     <form action="delete-img-service" method="POST" style="display:inline-block;">
                        <input type="hidden" name="service_carousel_id" value="{{ $s->service_carousel_id }}">
                        <button class="blue_icons"  onclick="return confirm('Are you sure you want to delete this image?')"> <i class="fa fa-trash-o fa-fw"></i> </button>
                    </form>                
                </td>
            </tr>

            @endforeach 

            </tbody>

        </table>

        <a href="{{ route('create_images_service_path', $service_details[0]->service_id) }}" class="btn btn-primary">Add an image</a>
        <a href="{{ route('services_management_path') }}" class="btn btn-default">Back to service list</a>

    </div>

    
    <!-- JAVASCRIPT DATATABLES -->
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop