@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit Products Categories </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        Edit the content of {{ $productCategoryDetails->title }} 
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
        

            {{ Form::open(['route' => ['edit_products_category_path', $productCategoryDetails->sub_category_id], 'role' => 'form', 'files' => true]) }}

                <div class="form-group">
                     <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                     <div class='input-group date'  style="width:100%;">
                         {{ Form::text('title', $productCategoryDetails->title, ['class' => 'form-control', 'placeholder' => 'Title'])  }}
                     </div>
                </div>


               <div class="form-group" >
                    {{ Form::label('product_category_img', 'Products category image:')  }}<br/>
                     <img src="images/products_category/{{ $productCategoryDetails->image }}" style="width:60%;"/>  
                    {{ Form::file('product_category_img', null, ['class' => 'form-control'])  }}
               </div>
           

                {{ Form::label('product_category_date', 'Sorting date:')  }}
                   <div class="form-group">
                     <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                     <div class='input-group date' id='datetimepicker1'> 
                        <?php // change the format of the date 
                            $date=date_create($productCategoryDetails->updated_at);
                            $real_date = date_format($date,"Y-m-d H:i:s");
                        ?>
                         {{ Form::text('product_category_date', $real_date, ['class' => 'form-control', 'placeholder' => 'Sorting Date'])  }}
                         <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                         </span>
                     </div>
                   </div>

                <input type="submit" value="SAVE CHANGES" class="btn btn-success button">
                <a href="{{ route('products_category_management_path') }}" class="btn btn-primary button"> Back to products category </a>
            {{ Form::close() }}
    
        </div>
    </div>
 </div>

 <script src="js/moment.js"></script>
 <script src="js/datepicker.js"></script>
 <script type="text/javascript">
     $(function () {
         $('#datetimepicker1').datetimepicker({
             pickTime: false,
             format: 'YYYY-MM-DD'
         });
     });

 </script>


@stop