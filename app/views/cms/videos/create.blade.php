@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Add Videos</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        ADD A NEW YOUTUBE VIDEO
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
            {{ Form::open(['route' => 'create_video_path', 'role' => 'form']) }}

               <div class="form-group">
                    {{ Form::label('video_title', 'Title') }}
                    {{ Form::text('video_title', null, ['class' => 'form-control', 'placeholder' => 'Video title', 'required' => 'required'])  }}
                </div>


                <div class="form-group">
                    {{ Form::label('video_url_code', 'Video URL code') }}
                    {{ Form::text('video_url_code', null, ['class' => 'form-control', 'placeholder' => 'Video URL code', 'required' => 'required'])  }}
                </div>


               {{ Form::label('video_date', 'VIDEO DATE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'>
                     {{ Form::text('video_date', null, ['class' => 'form-control', 'placeholder' => 'Video Date'])  }}
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