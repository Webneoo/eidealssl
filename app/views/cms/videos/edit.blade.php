@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit Videos</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT YOUR VIDEO
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
            
             <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video_info[0]->url }}" frameborder="0" allowfullscreen></iframe>

 
            {{ Form::open(['route' => ['edit_video_path', $video_info[0]->video_id], 'role' => 'form']) }}


               <div class="form-group">
                    {{ Form::label('video_title', 'Title') }}
                    {{ Form::text('video_title', $video_info[0]->title, ['class' => 'form-control', 'placeholder' => 'Video title', 'required' => 'required'])  }}
                </div>


                <div class="form-group">
                    {{ Form::label('video_url_code', 'Youtube Video ID') }}
                    {{ Form::text('video_url_code', $video_info[0]->url, ['class' => 'form-control', 'placeholder' => 'Video URL code', 'required' => 'required'])  }}
                </div>

                <?php // change the format of the date 
                    $date=date_create($video_info[0]->updated_at);  
                    $real_date = date_format($date,"Y-m-d");
                ?>

               {{ Form::label('video_date', 'VIDEO DATE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'>
                     {{ Form::text('video_date', $real_date, ['class' => 'form-control', 'placeholder' => 'Video Date'])  }}
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
               </div>

                <input type="submit" value="EDIT" class="btn btn-primary button">

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