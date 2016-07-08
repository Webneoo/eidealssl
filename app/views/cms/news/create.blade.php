@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create News</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        CREATE YOUR NEWS
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
            {{ Form::open(['route' => 'create_news_path', 'role' => 'form', 'files' => true]) }}

               {{ Form::label('news_date', 'NEWS DATE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'>
                     {{ Form::text('news_date', null, ['class' => 'form-control', 'placeholder' => 'News Date'])  }}
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
               </div>

                <div class="form-group" >
                    {{ Form::label('news_image', 'NEWS IMAGE: (Image size 341 x 264 px)')  }}
                    {{ Form::file('news_image', null, ['class' => 'form-control'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('news_title', 'Title') }}
                    {{ Form::text('news_title', null, ['class' => 'form-control', 'placeholder' => 'News title', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('news_content', 'NEWS CONTENT') }}
                    <textarea name="news_content" required></textarea>
                    <script>
                        CKEDITOR.replace( 'news_content' );
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