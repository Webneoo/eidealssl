@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit Image</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT YOUR IMAGE
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
         
    
     @foreach($brandImageDetails as $b)  

        {{ Form::open(['route' => ['edit_brand_slideshow_path', $b->brand_image_id,$b->brand_id], 'role' => 'form', 'files' => true]) }}

                <div class="form-group" >
                    {{ Form::label('slideshow_image', 'SLIDSHOW IMAGE: (Image size 690 x 380 px)')  }}
                    <img src="images/brands/{{ $b -> url_img }}" style="width:100%"/>
                    {{ Form::file('slideshow_image', null, ['class' => 'form-control'])  }}
                </div>

                 {{ Form::label('date_slideshow', 'DATE:(used to order the images)')  }}
                  <div class="form-group">
                     <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                     <div class='input-group date' id='datetimepicker1'>
                         <?php // change the format of the date 
                            $date=date_create($b->updated_at);  
                            $real_date = date_format($date,"Y-m-d");
                         ?>
                         {{ Form::text('date_slideshow', $real_date, ['class' => 'form-control', 'placeholder' => 'Slideshow Date'])  }}
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
     });
 </script>


@stop