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
        <div class="col-lg-10">
            
        @foreach($news_info as $n)
            {{ Form::open(['route' => ['edit_news_path', $n->news_id], 'role' => 'form', 'files' => true]) }}

               {{ Form::label('news_date', 'NEWS DATE:')  }}
               <div class="form-group">
                 <?php // change the format of the date 
                    $date=date_create($n->updated_at);  
                    $real_date = date_format($date,"Y-m-d");
                ?>
                 <div class='input-group date' id='datetimepicker1'>
                     {{ Form::text('news_date', $real_date, ['class' => 'form-control', 'placeholder' => 'News Date'])  }}
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
               </div>

               <div class="form-group" >
                    {{ Form::label('news_image', 'NEWS IMAGE: (Image size 341 x 264 px)')  }}<br/>
                    <img src="images/news/{{ $n->img }}" style="width:25%;"/>
                    {{ Form::file('news_image', null, ['class' => 'form-control'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('news_title', 'Title') }}
                    {{ Form::text('news_title', $n->title, ['class' => 'form-control', 'placeholder' => 'News title', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('news_content', 'NEWS CONTENT') }}
                    <textarea name="news_content" required> {{ $n->text }}</textarea>
                    <script>
                        CKEDITOR.replace('news_content');
                    </script>
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