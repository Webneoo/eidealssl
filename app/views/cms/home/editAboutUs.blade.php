@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit About us </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT THE CONTENT OF ABOUT US
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
          @foreach($aboutUs as $a)

            {{ Form::open(['route' => 'edit_about_us_path', 'role' => 'form', 'files' => true]) }}


               <div class="form-group" >
                    {{ Form::label('about_us_img', 'ABOUT US IMAGE: (Image size 1346 x 330 px)')  }}
                     <img src="images/{{ $a->img }}" style="width:100%;">  
                    {{ Form::file('about_us_img', null, ['class' => 'form-control'])  }}
              </div>
           

              {{ Form::label('title_1', 'TITLE 1:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('title_1', $a->title1, ['class' => 'form-control', 'placeholder' => 'Title 1'])  }}
    
                 </div>
               </div>

              <div class="form-group">
                    {{ Form::label('about_us_txt1', 'TEXT 1 CONTENT:') }}
                    <textarea name="about_us_txt_1" required>{{ $a->text1 }}</textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_1' );
                    </script>
                </div>

                <br/><br/>

                {{ Form::label('title_2', 'TITLE 2:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('title_2', $a->title2, ['class' => 'form-control', 'placeholder' => 'Title 2'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('about_us_txt2', 'TEXT 2 CONTENT:') }}
                   <textarea name="about_us_txt_2" required>{{ $a->text2 }}</textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_2' );
                    </script>
                </div>

                <br/><br/>

                {{ Form::label('title_3', 'TITLE 3:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('title_3', $a->title3, ['class' => 'form-control', 'placeholder' => 'Title 3'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('about_us_txt3', 'TEXT 3 CONTENT;') }}
                    <textarea name="about_us_txt_3" required> {{ $a->text3 }} </textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_3' );
                    </script>
                </div>

                <br/><br/>

                 {{ Form::label('title_4', 'TITLE 4:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('title_4', $a->title4, ['class' => 'form-control', 'placeholder' => 'Title 4'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('about_us_txt4', 'TEXT 4 CONTENT;') }}
                    <textarea name="about_us_txt_4" required> {{ $a->text4 }} </textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_4' );
                    </script>
                </div>

                <br/><br/>


                 {{ Form::label('title_5', 'TITLE 5:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('title_5', $a->title5, ['class' => 'form-control', 'placeholder' => 'Title 5'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('about_us_txt5', 'TEXT 5 CONTENT;') }}
                    <textarea name="about_us_txt_5" required> {{ $a->text5 }} </textarea>
                    <script>
                        CKEDITOR.replace( 'about_us_txt_5' );
                    </script>
                </div>

                <input type="submit" value="SAVE CHANGES" class="btn btn-primary button">

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