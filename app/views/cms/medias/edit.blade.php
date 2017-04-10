@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit Medias</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT YOUR MEDIA
    </div>
    <div class="panel-body">
        <div class="col-lg-12">

            @foreach ($media_info as $m)

                {{ Form::open(['route' => ['edit_media_path', $m->media_id], 'role' => 'form', 'files' => true]) }}

                    <div class="form-group" >
                        {{ Form::label('media_image', 'MEDIA IMAGE: (Image size 900 x 649 px or a proportional size)')  }}
                        <img width="550px;" src="images/medias/<?php echo $m->img; ?>"/><br/><br/>
                        {{ Form::file('media_image', NULL, ['class' => 'form-control'])  }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('media_url', 'Media URL') }}
                        {{ Form::text('media_url', $m->url, ['class' => 'form-control'])  }}
                    </div>

                    {{ Form::label('media_date', 'MEDIA DATE:')  }}
                   <div class="form-group">
                     <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                     <div class='input-group date' id='datetimepicker1'> 
                        <?php // change the format of the date 
                            $date=date_create($m->updated_at);  
                            $real_date = date_format($date,"Y-m-d H:i:s");
                        ?>
                         {{ Form::text('media_date', $real_date, ['class' => 'form-control', 'placeholder' => 'Media Date'])  }}
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
                                <input id="product_media_link_id" style="width:20px; height:20px;" name="product_media_link_id" type="radio" value="{{ $p->product_id}}" <?php if($p->product_id == $m->product_id) echo "checked"; ?>>

                            </td>
                         
                        </tr>
                        @endforeach
                        </tbody>
                </table>


                    <input type="submit" value="EDIT" class="btn btn-primary button">

                {{ Form::close() }}

            @endforeach
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