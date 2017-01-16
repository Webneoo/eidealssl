@extends('cms.layouts.default')

@section('content')


    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit the service " {{ $service_details[0]->title }}"  </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT THE CONTENT OF YOUR SERVICE
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
         

            {{ Form::open(['route' => 'update_service_path', 'role' => 'form']) }}

               <input type="hidden" name="service_id" value="{{ $service_details[0]->service_id }}"/>

              {{ Form::label('service_title', 'TITLE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group' style="width:100%;">
                     {{ Form::text('service_title', $service_details[0]->title, ['class' => 'form-control', 'placeholder' => 'Enter the service title'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('service_content', 'CONTENT:') }}
                    <textarea name="service_content" required>{{ $service_details[0]->content }}</textarea>
                    <script>
                        CKEDITOR.replace( 'service_content' );
                    </script>
                </div>


                {{ Form::label('service_date', 'DATE: (This date will be used to change the order of the services)')  }}
               <div class="form-group">
              
                 <div class='input-group date' id='datetimepicker1'> 
                        
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                     {{ Form::text('service_date', $service_details[0]->updated_at, ['class' => 'form-control', 'placeholder' => 'service Date:'])  }}
                 </div>
               </div>

      
                <input type="submit" value="SAVE CHANGES" class="btn btn-primary button">
                <a href="{{ route('services_management_path') }}" class="btn btn-default">Back to service list</a>

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