@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">About Us Content</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title1</th>
                    <th>Text1</th>
                    <th>Title2</th>
                    <th>Text2</th>
                    <th>Title3</th>
                    <th>Text3</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>

        <a href="{{ route('create_about_us_path') }}" class="btn btn-primary">CREATE NEW CONTENT</a>

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