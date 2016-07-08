@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create your slideshow images</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        List of the slideshow images
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            {{ Form::open(['route' => ['create_brand_slideshow_path', $brand_id], 'role' => 'form', 'files' => true]) }}

              <div class="form-group" >
                    {{ Form::label('brand_slideshow_image', 'SLIDSHOW IMAGE: (Image size 690 x 403 px)')  }}
                    {{ Form::file('brand_slideshow_image', null, ['class' => 'form-control'])  }}
              </div>

                {{ Form::label('date_slideshow', 'DATE:(used to order the images)')  }}
              <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'>
                     {{ Form::text('date_slideshow', null, ['class' => 'form-control', 'placeholder' => 'Slideshow Date'])  }}
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
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
     });
 </script>


@stop