@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">User details</h1>   </div>
    </div>

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>PARAMETERS</th>
                <th>VALUES</th>
            </tr>
        </thead>
        <tbody>
         @foreach($user_info as $u)    
             <tr>
                <td><b>Username: </b></td>
                <td>{{ $u->username }}</td>
             </tr>
             <tr>
                 <td><b>Email: </b></td>
                <td>{{ $u->email }}</td>
             </tr>
             <tr>
                <td><b>Firstname: </b></td>
                <td>{{ $u->firstname }}</td>
             </tr>
             <tr>
                <td><b>Lastname: </b></td>
                <td>{{ $u->lastname }}</td>
             </tr>
             <tr>
                <td><b>Birth Date: </b></td>
                <td>{{ $u->birth_date }}</td>
             </tr>
             <tr>
                <td><b>Phone: </b></td>
                <td>{{ $u->phone }}</td>
             </tr>
             <tr>
                 <td><b>Country: </b></td>
                <td>{{ $u->country }}
             </tr>
              <tr>
                 <td><b>City: </b></td>
                <td>{{ $u->city }}</td>
             </tr>
              <tr>
                 <td><b>Address: </b></td>
                <td>{{ $u->address }}</td>
             </tr>
             <tr>
                <td><b>Subscribed to Newsletters: </b></td>
                <td>
                    <?php
                    if($u->newsletters == 1)  echo "YES"; 
                    if($u->newsletters == 0)  echo "NO"; 
                    ?>
                </td>
             </tr>
        @endforeach
        </tbody>
    </table>

@stop