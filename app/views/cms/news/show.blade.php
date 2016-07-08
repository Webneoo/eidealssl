@extends('cms.layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">List of News</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

    <div class="row">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>image</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
                @foreach($newsList as $n)
                 <tr>
                    
                    <td>{{ $n->news_id }}</td>
                    <td><img src="images/news/{{ $n->img }}" style="width:100px;"></td>
                     <?php 
                        $desc =  $n->text;
                        if(strlen($desc)>50)
                        {    
                            $pos=strpos($desc, ' ', 50);
                            $desc = substr($desc,0,$pos );
                            $desc = $desc." ...";
                        }
                    ?>

                    <?php // change the format of the date 
                        $date=date_create($n->updated_at);  
                        $real_date = date_format($date,"Y-m-d");
                    ?>
                    <td>{{ $n->title }}</td>
                    <td>{{ $desc }}</td>
                    <td>{{ $real_date }}</td>
                    <td>
                        <a href="{{ route('edit_news_path', $n->news_id) }}"><i class="fa fa-edit fa-fw"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('delete_news_path', $n->news_id) }}"><i class="fa fa-trash-o fa-fw"></i></a>
                    </td>
                 
                </tr>
                @endforeach
            
            </tbody>
        </table>

        <a href="{{ route('create_news_path') }}" class="btn btn-primary">CREATE A NEWS</a>

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