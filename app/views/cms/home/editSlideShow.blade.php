@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit News</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT YOUR NEWS
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
          
        @foreach ($slide_show_info as $s)

            {{ Form::open(['route' => ['edit_slideshow_path', $s->image_id], 'role' => 'form', 'files' => true]) }}
               <div class="form-group" >
                {{ Form::label('slideshow_image', 'SLIDSHOW IMAGE: (Image size 1920 x 600 px)')  }}
                <img src="images/slideshow/{{ $s->img_url }}" style="width:100%"/>
                {{ Form::file('slideshow_image', null, ['class' => 'form-control'])  }}
               </div>


               {{ Form::label('title', 'TITLE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group' style="width:100%;">
                     {{ Form::text('title', $s->title, ['class' => 'form-control', 'placeholder' => 'Title'])  }}
    
                 </div>
               </div>


               {{ Form::label('subtitle', 'SUBTITLE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group' style="width:100%;">
                     {{ Form::text('subtitle', $s->subtitle, ['class' => 'form-control', 'placeholder' => 'Subtitle'])  }}
    
                 </div>
               </div>


               {{ Form::label('link', 'LINK:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group' style="width:100%;">
                     {{ Form::url('link', $s->link, ['class' => 'form-control', 'placeholder' => 'Link'])  }}
    
                 </div>
               </div>



               {{ Form::label('date_slideshow', 'DATE:(used to order the images)')  }}
                  <div class="form-group">
                     <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                     <div class='input-group date' id='datetimepicker1'>
                         {{ Form::text('date_slideshow', $s->slideshow_date, ['class' => 'form-control', 'placeholder' => 'Slideshow Date'])  }}
                         <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                         </span>
                     </div>
                  </div>
               
                <input type="submit" value="EDIT" class="btn btn-primary button">

            {{ Form::close() }}

            @endforeach
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