@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of Promotions</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>code</th>
                    <th>Discount %</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            
                @foreach($promoList as $p)
                 <tr> 
                    <td>{{ $p->promo_id }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->promo_code }}</td>
                    <td>{{ $p->percentage }}%</td>
                    <td>{{ date("Y-m-d", strtotime($p->start_date)) }}</td>
                    <td>{{ date("Y-m-d", strtotime($p->end_date)) }}</td>
                    <td>
                        <div class="btn-group">

                            <!-- if the promo expired --> 
                            @if($p->active == 2)
                                <button type="submit" style="background:none; border:none;" disabled title="expired">
                                    <img src="images/button_dimmed.png" style="width:60px;" title="expired">
                                </button>


                             <!-- if the promo is still active  --> 
                            @elseif($p->active == 1)
                                {{ Form::open(['route' => 'promo_management_path', 'role' => 'form']) }}
                                <input name="promo_id" type="hidden" value="{{ $p->promo_id }}"/>
                                    <button type="submit" style="background:none; border:none;" title="active" value="0" name="change_status">
                                        <img src="images/button_active.png" style="width:60px;" title="active">
                                    </button>
                                {{ Form::close() }}


                             <!-- if the promo is inactive-->    
                            @elseif($p->active == 0)
                                {{ Form::open(['route' => 'promo_management_path', 'role' => 'form']) }}
                                <input name="promo_id" type="hidden" value="{{ $p->promo_id }}"/>
                                    <button type="submit" style="background:none; border:none;" title="inactive" value="1" name="change_status">
                                        <img src="images/button_inactive.png" style="width:60px;" title="inactive">
                                    </button>
                                {{ Form::close() }}
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            
            </tbody>
        </table>

        <a href="{{ route('create_promo_path') }}" class="btn btn-primary">CREATE A PROMO</a>

    </div>

    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop