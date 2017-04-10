@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create a media</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        CREATE YOUR MEDIA
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            {{ Form::open(['route' => 'create_media_path', 'role' => 'form', 'files' => true]) }}
            

                <div class="form-group" >
                    {{ Form::label('media_image', 'MEDIA IMAGE: (Image size 900 x 649 px or a proportional size)')  }}
                    {{ Form::file('media_image', null, ['class' => 'form-control'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('media_url', 'Media URL') }}
                    {{ Form::text('media_url', null, ['class' => 'form-control', 'placeholder' => 'http://example.com'])  }}
                </div>

                {{ Form::label('media_date', 'MEDIA DATE:')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'>
                     {{ Form::text('media_date', null, ['class' => 'form-control', 'placeholder' => 'Media Date', 'required' => 'required'])  }}
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
               </div>

                {{ Form::label('product_link', 'LINK THIS MEDIA TO ONE OF THE FOLLOWING PRODUCTS:')  }}
                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>code</th>
                                <th>Title</th>
                                <th>Main image</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        @foreach($productsList as $p)
                         <tr>  
                            <td>{{ $p->product_id }}</td>
                            <td>{{ $p->code }}</td>
                            <td>{{ $p->title }}</td>
                            <td><img style="width:100px;" src="images/products/<?php echo $p->img1; ?>"/></td>
                            <td>{{ $p->sub_category_title }}</td>
                            <td>
                                <input id="product_media_link_id" style="width:20px; height:20px;" name="product_media_link_id" type="radio" value="{{ $p->product_id}}">

                            </td>
                         
                        </tr>
                        @endforeach
                        </tbody>
                </table>


                <input type="submit" value="SAVE" class="btn btn-primary button">

            {{ Form::close() }}
        </div>
    </div>
 </div>

 <script src="js/moment.js"></script>
 <script src="js/datepicker.js"></script>
 <script type="text/javascript">
     $(function () {
         $('#datetimepicker1').datetimepicker({
             pickTime: true,
             format: 'YYYY-MM-DD H:m:00'
         });

         $('.bootstrap-datetimepicker-widget').css('display', 'none'); 
     });
 </script>

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