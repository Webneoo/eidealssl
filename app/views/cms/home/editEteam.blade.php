@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit E-team </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT THE CONTENT OF E-TEAM
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
         
            @foreach($eteam as $e)

                {{ Form::open(['route' => 'edit_eteam_path', 'role' => 'form', 'files' => true]) }}

                   <div class="form-group" >
                        {{ Form::label('eteam_img', 'E-TEAM IMAGE:')  }}
                         <img src="images/{{ $e->img }}" style="width:100%;">  
                        {{ Form::file('eteam_img', null, ['class' => 'form-control'])  }}
                  </div>
               
                  <div class="form-group">
                        {{ Form::label('eteam_desc', 'DESCRIPTION:') }}
                        <textarea name="eteam_desc" required>{{ $e->description }}</textarea>
                        <script>
                            CKEDITOR.replace( 'eteam_desc' );
                        </script>
                    </div>

                    <br/><br/>

                    <input type="submit" value="SAVE CHANGES" class="btn btn-primary button">

                {{ Form::close() }}

            @endforeach
        </div>
    </div>
 </div>

@stop