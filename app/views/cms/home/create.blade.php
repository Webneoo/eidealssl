@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create a store</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        CREATE YOUR STORE
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            {{ Form::open(['route' => ['create_store_locator_path', 0], 'role' => 'form', 'files' => true]) }}

               {{ Form::label('name', 'NAME:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name'])  }}
    
                 </div>
               </div>

               {{ Form::label('country', 'COUNTRY:')  }}<br/>
              
                <select id="country" class="input-group input-sm col-lg-12" name="country_post">
                    <option value="0">All countries</option>
                    @foreach($country_list as $c)
                        <option value="{{ $c->country_id }}">{{ $c->desc }}</option>
                    @endforeach
                </select>
                <br/>

                
                {{ Form::label('region', 'REGION:')  }}<br/>
                <select class="input-group input-sm col-lg-12" id="region" name="region_post" >
                    <option value="0">All region</option>
                </select>
                <br/>

           

               {{ Form::label('address', 'ADDRESS:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Address'])  }}
    
                 </div>
               </div>


                 {{ Form::label('Phone', 'PHONE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'  style="width:100%;">
                     {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone'])  }}
    
                 </div>
               </div>

                <input type="submit" value="SAVE" class="btn btn-primary button">

            {{ Form::close() }}
        </div>
    </div>
 </div>


    <script>
          /* Load positions into postion <select> */
      $( "#country" ).change(function() 
      {
          $.getJSON("{{ url('create-store-locator-')}}"+$(this).val(), 
            { option: $(this).val() }, 
        
        function(data) {
            var model = $('#region');
            model.empty();
            model.append("<option value="+0+">All regions </option>");
            $.each(data, function(index, element) {
                model.append("<option value='"+element.region_id+"'>" + element.desc + "</option>");
            });
        });

      });

    </script>





@stop