@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">About Us Content</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        ABOUT US
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
            {{ Form::open(['route' => 'create_news_path', 'role' => 'form', 'files' => true]) }}

               <div class="form-group" >
                    {{ Form::label('about_us_img', 'ABOUT US IMAGE: (Image size 1346 x 330 px)')  }}
                    {{ Form::file('about_us_img', null, ['class' => 'form-control'])  }}
              </div>

              {{ Form::label('title_1', 'TITLE 1:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_1', null, ['class' => 'form-control', 'placeholder' => 'Title 1'])  }}
    
                 </div>
               </div>

              <div class="form-group">
                    {{ Form::label('about_us_txt1', 'TEXT 1 CONTENT:') }}
                    <textarea name="about_us_txt_1" required></textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_1' );
                    </script>
                </div>

                {{ Form::label('title_2', 'TITLE 2:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_2', null, ['class' => 'form-control', 'placeholder' => 'Title 2'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('about_us_txt2', 'TEXT 2 CONTENT:') }}
                   <textarea name="about_us_txt_2" required></textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_2' );
                    </script>
                </div>

                {{ Form::label('title_3', 'TITLE 3:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_3', null, ['class' => 'form-control', 'placeholder' => 'Title 3'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('about_us_txt3', 'TEXT 3 CONTENT;') }}
                    <textarea name="about_us_txt_3" required></textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_3' );
                    </script>
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