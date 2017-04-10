@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Add an image to the service "{{$service_details[0]->title}}"</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        Add your image
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            {{ Form::open(['route' => 'add_images_service_path', 'role' => 'form', 'files' => true]) }}

          <input type="hidden" name="service_id" value="{{ $service_details[0]->service_id }}">

              <div class="form-group" >
                    {{ Form::label('service_image', 'IMAGE: (Image size 1110 x 445 px)')  }}
                    {{ Form::file('service_image', null, ['class' => 'form-control'])  }}
              </div>


              <?php // change the format of the date  
                    $actual_date = date_format($actual_date,"Y-m-d");
                ?>

                {{ Form::label('service_image_date', 'DATE:(used to order the images)')  }}
              <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'>
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                     {{ Form::text('service_image_date', $actual_date, ['class' => 'form-control', 'placeholder' => 'Service image date'])  }}
                 </div>
              </div>

             <input type="submit" value="SAVE" class="btn btn-primary button">

            {{ Form::close() }}
        </div>
    </div>
 </div>

 <script src="js/moment.js"></script>
 <script src="js/datepicker.js"></script>
 <script type="text/javascript">
     $(function () {
         $('#datetimepicker1').datetimepicker({
             pickTime: false,
             format: 'YYYY-MM-DD'
         });

         $('.bootstrap-datetimepicker-widget').css('display', 'none'); 
     });
 </script>


@stop