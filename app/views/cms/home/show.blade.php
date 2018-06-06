@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Store Locator list </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                <div class="filter_division" style="margin:auto; width:350px;">   
                    {{ Form::open(['route' => ['where_to_buy_management_path',0], 'role' => 'form']) }}
                      
                        <select id="country" class="input-sm" name="country_post">
                            <option value="0">All countries</option>
                            @foreach($country_list as $c)
                                <option value="{{ $c->country_id }}">{{ $c->desc }}</option>
                            @endforeach
                        </select>

                        <select class="input-sm" style="margin-left:3%;;" id="region" name="region_post" >
                            <option value="0">All region</option>
                        </select>

                        
                        <input class="search_button" type="submit" value="Filter"/>
                    {{ Form::close() }}
                </div> 

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Region</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
          
                @foreach($store_info as $s)
                 <tr>
                   <td>{{ $s->name }}</td>
                    <td>{{ $s->country }}</td>
                    <td>{{ $s->region }}</td>
                    <td>{{ $s->address }}</td>
                    <td>{{ $s->phone }}</td>
                    <td>
                        <a href="{{ route('edit_store_locator_path', array($s->locator_id,$s->country_id)) }}"><i class="fa fa-edit fa-fw"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('delete_store_locator_path', array($s->locator_id,0)) }}"><i class="fa fa-trash-o fa-fw"></i></a>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

        <a href="{{ route('create_store_locator_path', 0) }}" class="btn btn-primary">CREATE A STORE </a>

    </div>

    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
                "order": [[ 0, "asc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>


    <script>
          /* Load positions into postion <selec> */
      $( "#country" ).change(function() 
      {
          $.getJSON("{{ url('where-to-buy-')}}"+$(this).val(), 
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