@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of the orders</h1> </div>
    </div>

    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>order ID</th>
                    <th>Audi order ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Country</th>
                    <th>Payement Method</th>
                    <th>Purchase date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
             @foreach( $transactions as $t)
                 <tr>
                    <td>
                        @if($t->order_status_id == 2 || $t->order_status_id == 5) 
                        <a href="{{ route('display_transaction_path', $t->order_id) }}">
                          {{ $t->order_id  }}
                        </a>
                        @else
                            {{ $t->order_id  }}
                        @endif
                    </td>
                    <td><a href="{{ route('display_transaction_path', $t->order_id) }}">{{ $t->audi_order_id }}</a></td>
                    <td><a href="{{ route('display_user_path', $t->user_id) }}">{{ $t->username }}</a></td>
                    <td> $ {{ $t->purchase_price  }}</td>
                    <td> {{ $t->country}}</td>
                    <td> {{ $t->payment_method }}</td>
                    <td>{{ $t->purchase_date }}</td>
                    <td>
                        @if($t->order_status_id == 2)
                             <b style="color:orange">
                        @elseif($t->order_status_id == 3 || $t->order_status_id == 5)
                             <b style="color:green">
                        @elseif($t->order_status_id == 4)
                             <b style="color:red">
                        @endif
                        {{ $t->payment_status }}
                        </b>
                    </td>
                    <td>
                        @if($t->order_status_id == 2) 
                        <form onsubmit="return confirm('Are you sure you want to set the order ID # {{ $t->order_id }} as paid ?');" method="POST" action="shopping-management" >
                            <input type="hidden" name="order_id" value="{{ $t->order_id }}">
                            <input type="submit" value="Mark as paid" style="display: block; margin:auto;" type="button" class="btn btn-success"/>
                        </form>
                        @endif
                    </td>
                </tr>
              @endforeach
            
            </tbody>
        </table>

    </div>

    <!-- JAVASCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable(
            {
                "order": [[ 6, "desc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop