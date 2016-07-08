@extends('cms.layouts.default')

@section('content')

    <div class="row">

        @foreach($brandDetails as $br)
            <div class="col-lg-12">  <h1 class="page-header">Slideshow images of the brand "{{ $br->brand_title }}" </h1>  </div>
        @endforeach
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
          
             @foreach($brandImages as $b)
             <tr>    
                <td>{{ $b->brand_image_id }}</td>
                <td> <img src="images/brands/{{ $b->url_img }}" style="height:60px;"></td>
                    <?php // change the format of the date 
                        $date=date_create($b->updated_at);  
                        $real_date = date_format($date,"Y-m-d");
                    ?>
                <td> {{ $real_date }}</td>
             
                <td>
                    <a href="{{ route('edit_brand_slideshow_path', array($b->brand_image_id, $brand_id)) }}"><i class="fa fa-edit fa-fw"></i></a>
                    <a onclick="return confirm('Are you sure you want to delete this image?')" href="{{ route('delete_image_brand_path', array($b->brand_image_id, $brand_id)) }}"><i class="fa fa-trash-o fa-fw"></i></a>
                </td>
            </tr>

            @endforeach 

         
            </tbody>
        </table>

        <a href="{{ route('create_brand_slideshow_path',$brand_id) }}" class="btn btn-primary">Add an image</a>

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