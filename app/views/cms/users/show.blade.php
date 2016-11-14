@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of Users</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
                @foreach($usersList as $u)
                 <tr>
                    <td>{{ $u->id }}</td>
                    <td><a href="{{ route('display_user_path', $u->id) }}"> {{ $u->username }} </a></td>
                    <td>{{ $u->firstname.' '.$u->lastname }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone }}</td>
                    <td>{{ $u->country }}</td>
                    <td>
                        <a onclick="return confirm('Are you sure you want to delete?')" class="delete_post"
                           href="{{ route('delete_user_path', $u->id) }}"><i class="fa fa-trash-o fa-fw"></i></a>
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
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

@stop