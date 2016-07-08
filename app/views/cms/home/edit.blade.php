@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit your store</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT YOUR STORE
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
        @foreach($locator_info as $l)

            {{ Form::open(['route' => ['edit_store_locator_path', $l->locator_id, $l->country_id], 'role' => 'form', 'files' => true]) }}
               
                <div class="form-group">
                    {{ Form::label('name', 'NAME') }}
                    {{ Form::text('name', $l->name, ['class' => 'form-control', 'required' => 'required'])  }}
                </div>

                {{ Form::label('country', 'COUNTRY:')  }}<br/>
              
                <select id="country" class="input-group input-sm col-lg-12" name="country_post">
                    <option value="0">All countries</option>
                    @foreach($country_list as $c)
                        <option <?php if($c->country_id == $l->country_id) echo 'selected' ?> value="{{ $c->country_id }}" >{{ $c->desc }}</option>
                    @endforeach
                </select>
                <br/>

                {{ Form::label('region', 'REGION:')  }}<br/>
                <select class="input-group input-sm col-lg-12" id="region" name="region_post" >
                    <option value="0">All region</option>
                     @foreach($region_list as $r)
                        <option <?php if($r->region_id == $l->region_id) echo 'selected' ?> value="{{ $r->region_id }}" >{{ $r->desc }}</option>
                    @endforeach
                </select>
                <br/>

                <div class="form-group">
                    {{ Form::label('address', 'ADDRESS') }}
                    {{ Form::text('address', $l->address, ['class' => 'form-control', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('phone', 'PHONE') }}
                    {{ Form::text('phone', $l->phone, ['class' => 'form-control', 'required' => 'required'])  }}
                </div>

                <input type="submit" value="EDIT" class="btn btn-primary button">

            {{ Form::close() }}

         @endforeach    
        </div>
    </div>
 </div>

 <script src="js/moment.js"></script>

 <script>
          /* Load positions into postion <select> */
      $( "#country" ).change(function() 
      {
          $.getJSON("{{ url('edit-store-locator-82-')}}"+$(this).val(), 
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