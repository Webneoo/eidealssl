@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create a new service </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        ADD THE CONTENT OF THE NEW SERVICE
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
         

            {{ Form::open(['route' => 'create_service_path', 'role' => 'form']) }}

              {{ Form::label('service_title', 'TITLE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group' style="width:100%;">
                     {{ Form::text('service_title', null, ['class' => 'form-control', 'placeholder' => 'Enter the service title'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('service_content', 'CONTENT:') }}
                    <textarea name="service_content" required></textarea>
                    <script>
                        CKEDITOR.replace( 'service_content' );
                    </script>
                </div>


                {{ Form::label('service_date', 'DATE: (This date will be used to change the order of the services)')  }}
               <div class="form-group">
              
                <?php // change the format of the date  
                    $actual_date = date_format($actual_date,"Y-m-d");
                ?>

                 <div class='input-group date' id='datetimepicker1'> 
                        
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                     {{ Form::text('service_date', $actual_date, ['class' => 'form-control', 'placeholder' => 'service Date:'])  }}
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