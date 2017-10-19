@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Edit Products</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT YOUR PRODUCT
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
           
            @foreach ($product_info as $p)

                {{ Form::open(['route' => ['edit_products_path', $p->product_id], 'role' => 'form', 'files' => true]) }}

                <div class="form-group">
                    {{ Form::label('product_category', 'Category') }}
                    <select name="product_category" class="form-control" required>
                        @foreach ($subcategoryList as $s)
                            <option <?php if($p->sub_category_id == $s->sub_category_id) echo 'selected'; ?> 
                                value="{{ $s->sub_category_id }}"> {{ $s->title }}</option>
                        @endforeach
                    </select>   
                    
                </div>

                <div class="form-group">
                    {{ Form::label('product_code', 'Code') }}
                    {{ Form::text('product_code', $p->code, ['class' => 'form-control', 'placeholder' => 'Prodcut code', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('product_title', 'Title') }}
                    {{ Form::text('product_title', $p->title, ['class' => 'form-control', 'placeholder' => 'Prodcut title', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('product_short_desc', 'Short Description: (70 character maximum)') }}
                    {{ Form::textarea('product_short_desc', $p->small_desc, ['class' => 'form-control', 'placeholder' => 'Short Description', 'required' => 'required', 'maxlength' => '70'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('product_long_desc', 'Long Description') }}
                     <textarea name="product_long_desc">{{ $p->text }}</textarea>
                    <script>
                        CKEDITOR.replace( 'product_long_desc' );
                    </script>
                </div>

                <div class="form-group">
                    {{ Form::label('product_price', 'Price in USD ($)') }}
                    {{ Form::text('product_price', $p->price, ['class' => 'form-control', 'placeholder' => 'Prodcut price', 'id' => 'product_price'])  }}
                </div>

                <div class="form-group">
                    <input id="disable_price" <?php if($p->disable_price == 1) echo 'checked'; ?> type="checkbox" name="disable_price" class="form-control" value="1" style="width:20px; height:20px; display:inline; position:relative; top:3px; cursor:pointer;"> 
                    <label class="disable_price" for="disable_price" style="cursor:pointer">Disable the price</label>    
                </div>

                <div class="form-group">
                    <input id="liquid_product" <?php if($p->liquid_product == 1) echo 'checked'; ?> type="checkbox" name="liquid_product" class="form-control" value="1" style="width:20px; height:20px; display:inline; position:relative; top:3px; cursor:pointer">  
                     <label class="liquid_product" for="liquid_product" style="cursor:pointer">Liquid product</label>       
                </div>

                <div class="form-group">
                    <input id="sold_out" <?php if($p->sold_out == 1) echo 'checked'; ?> type="checkbox" name="sold_out" class="form-control" value="1" style="width:20px; height:20px; display:inline; position:relative; top:3px; cursor:pointer">  
                     <label class="sold_out" for="sold_out" style="cursor:pointer">Sold Out</label>       
                </div>


                <div class="form-group" >
                    <label for="product_img_1"> Product Main Image: <span style="color:blue">(Image size 900 x 649 px or a proportional one) </span></label>
                    <br/> <img src="images/products/<?php echo $p->img1; ?>" style="border:1px solid #2e2e2e" width="650px"/><br/>
                    {{ Form::file('product_img_1', null, ['class' => 'form-control'])  }}<br/>
                </div>

                <div class="form-group" >
                    <label for="product_img_2"> Product Image 2: <span style="color:blue">(Image size 900 x 649 px or a proportional one) </span></label>
                    <br/> 
                    <img <?php if($p->img2 == '') echo 'src="images/no_image.png"'; else echo 'src="images/products/'.$p->img2.'"'; ?> style="border:1px solid #2e2e2e" width="650px"/><br/>
                    {{ Form::file('product_img_2', null, ['class' => 'form-control'])  }}
                    
                    @if($p->img2 != '')
                    <div style="font-weight:bold; color:red;" >
                        <input style="width:20px; height:20px; position:relative; top:5px;" name="product_img_2_checkbox" type="checkbox" value="1" >
                        Check to remove Product Image 2 
                    </div>
                    @endif
                </div>


                <div class="form-group" >
                    <label for="product_img_3"> Product Image 3: <span style="color:blue">(Image size 900 x 649 px or a proportional one) </span></label>
                    <br/> 
                    <img <?php if($p->img3 == '') echo 'src="images/no_image.png"'; else echo 'src="images/products/'.$p->img3.'"'; ?> style="border:1px solid #2e2e2e" width="650px"/><br/>
                    {{ Form::file('product_img_3', null, ['class' => 'form-control'])  }}
                    
                    @if($p->img3 != '')
                    <div style="font-weight:bold; color:red;" >
                        <input style="width:20px; height:20px; position:relative; top:5px;" name="product_img_3_checkbox" type="checkbox" value="1" >
                        Check to remove Product Image 3 
                    </div>
                    @endif
                </div>


                <div class="form-group" >
                    <label for="product_img_4"> Product Image 4: <span style="color:blue">(Image size 900 x 649 px or a proportional one) </span></label>
                    <br/>
                    <img <?php if($p->img4 == '') echo 'src="images/no_image.png"'; else echo 'src="images/products/'.$p->img4.'"'; ?> style="border:1px solid #2e2e2e" width="650px"/><br/>
                    {{ Form::file('product_img_4', null, ['class' => 'form-control'])  }}
                    
                    @if($p->img4 != '')
                    <div style="font-weight:bold; color:red;" >
                        <input style="width:20px; height:20px; position:relative; top:5px;" name="product_img_4_checkbox" type="checkbox" value="1" >
                        Check to remove Product Image 4 
                    </div>
                    @endif
                </div>

                {{ Form::label('product_date', 'PRODUCT DATE: (This date will be used to change the order of the product in its category)')  }}
                <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'> 
                    <?php // change the format of the date 
                        $date=date_create($p->updated_at);  
                        $real_date = date_format($date,"Y-m-d H:i:s");
                    ?>
                     {{ Form::text('product_date', $real_date, ['class' => 'form-control', 'placeholder' => 'Product Date'])  }}
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
               </div>

               <div class="form-group">
                    {{ Form::label('youtube_title', 'YouTube video title') }}
                    {{ Form::text('youtube_title', $p->youtube_title, ['class' => 'form-control', 'placeholder' => 'YouTube video title'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('youtube_url', 'YouTube video code') }}
                    {{ Form::text('youtube_url', $p->youtube_url, ['class' => 'form-control', 'placeholder' => 'YouTube video code'])  }}
                </div>

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


     $(document).ready(function(){
    if($('#disable_price:checked').length){
        $('#product_price').attr('readonly',true); // On Load, should it be read only?
    }

    $('#disable_price').change(function(){
        if($('#disable_price:checked').length){
            $('#product_price').attr('readonly',true); //If checked - Read only
        }else{
            $('#product_price').attr('readonly',false);//Not Checked - Normal
        }
    });
});




 </script>

@stop