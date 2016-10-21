@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Choose the product that you which to promote </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>code</th>
                    <th>Title</th>
                    <th>Main image</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Promo %</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
          
                @foreach($productsList as $p)
                 <tr style="text-align:center;"> 
                    <td style="vertical-align: middle; display:table-cell;">{{ $p->product_id }}</td>
                    <td style="vertical-align: middle; display:table-cell;">{{ $p->code }}</td>
                    <td style="vertical-align: middle; display:table-cell;">{{ $p->title }}</td>
                    <td style="vertical-align: middle; display:table-cell;"><img style="width:100px;" src="images/products/<?php echo $p->img1; ?>"/></td>
                    <td style="vertical-align: middle; display:table-cell;">
                       @if($p->promo_start_date != NULL) 
                            <?php //reformat the date
                                $start_date = new DateTime($p->promo_start_date);
                                $start_date = date_format($start_date, 'Y-m-d');
                             ?>
                            {{ $start_date }}
                        @endif
                    </td>
                    <td style="vertical-align: middle; display:table-cell;">
                    @if($p->promo_end_date != NULL) 
                        <?php //reformat the date
                            $end_date = new DateTime($p->promo_end_date);
                            $end_date = date_format($end_date, 'Y-m-d');
                         ?>
                        {{ $end_date }}
                    @endif
                    </td>
                    <td style="vertical-align: middle; display:table-cell;">
                        @if($p->percentage != NULL)
                             <b>{{ $p->percentage }}%</b>
                        @endif
                    </td>
                    <td style="vertical-align: middle; display:table-cell;"> 
                            
                            <?php $actual_date = Carbon::now('Asia/Beirut'); ?>

                        <!-- if the promo is active --> 
                            @if( ($p->promo_start_date != NULL && $p->promo_end_date != NULL) && ($actual_date >= $p->promo_start_date && $actual_date <= $p->promo_end_date) )
                            <span style="color:green"><b> Active </b></span>

                        <!-- if the promo is inactive --> 
                            @else
                            <span style="color:red"><b> Inactive </b></span>
                            @endif
                    </td>
                    <td style="vertical-align: middle; display:table-cell;">
                            <a href="{{ route('create_promo_product_path', $p->product_id) }}" title="Add promo"><i class="fa fa-edit fa-fw fa-lg"></i></a>
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
                "order": [[ 0, "asc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop