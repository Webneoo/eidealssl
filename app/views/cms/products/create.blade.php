@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create a product</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        CREATE A NEW PRODUCT
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
            {{ Form::open(['route' => 'create_products_path', 'role' => 'form', 'files' => true]) }}
                
                <div class="form-group">
                    {{ Form::label('product_category', 'Category') }}
                    <select name="product_category" class="form-control" required>
                        @foreach ($subcategoryList as $s)
                            <option value="{{ $s->sub_category_id }}"> {{ $s->title }}</option>
                        @endforeach
                    </select>   
                    
                </div>

                <div class="form-group">
                    {{ Form::label('product_code', 'Code') }}
                    {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' => 'Prodcut code', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('product_title', 'Title') }}
                    {{ Form::text('product_title', null, ['class' => 'form-control', 'placeholder' => 'Prodcut title', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('product_short_desc', 'Short Description: (70 character maximum)') }}
                    {{ Form::textarea('product_short_desc', null, ['class' => 'form-control', 'placeholder' => 'Short Description', 'required' => 'required', 'maxlength' => '70'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('product_long_desc', 'Long Description') }}
                     <textarea name="product_long_desc">{{Input::old('product_long_desc')}}</textarea>
                    <script>
                        CKEDITOR.replace( 'product_long_desc' );
                    </script>
                </div>

                <div class="form-group">
                    {{ Form::label('product_price', 'Price in USD ($)') }}
                    {{ Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Prodcut price'])  }}
                </div>


                <div class="form-group">
                    <input id="disable_price" type="checkbox" name="disable_price" class="form-control" value="1" style="width:20px; height:20px; display:inline; position:relative; top:3px; cursor:pointer;"> 
                    <label class="disable_price" for="disable_price" style="cursor:pointer">Disable the price</label>    
                </div>

                <div class="form-group">
                    <input id="liquid_product" type="checkbox" name="liquid_product" class="form-control" value="1" style="width:20px; height:20px; display:inline; position:relative; top:3px; cursor:pointer">  
                     <label class="liquid_product" for="liquid_product" style="cursor:pointer">Liquid product</label>       
                </div>    
            

                <div class="form-group" >
                    <label for="product_img_1"> Product Main Image: <span style="color:red">(Image size 247 x 178 px or a proportional one) </span></label>
                    {{ Form::file('product_img_1', Input::old('product_img_1'), ['class' => 'form-control'])  }}
                </div>

                <div class="form-group" >
                    <label for="product_img_2"> Product Image 2: <span style="color:red">(Image size 247 x 178 px or a proportional one) </span></label>
                    {{ Form::file('product_img_2', null, ['class' => 'form-control'])  }}
                </div>


                <div class="form-group" >
                    <label for="product_img_3"> Product Image 3: <span style="color:red">(Image size 247 x 178 px or a proportional one) </span></label>
                    {{ Form::file('product_img_3', null, ['class' => 'form-control'])  }}
                </div>


                <div class="form-group" >
                    <label for="product_img_4"> Product Image 4: <span style="color:red">(Image size 247 x 178 px or a proportional one) </span></label>
                    {{ Form::file('product_img_4', null, ['class' => 'form-control'])  }}
                </div>

                {{ Form::label('product_date', 'PRODUCT DATE: (This date will be used to change the order of the product in its category)')  }}
               <div class="form-group">
                 <!-- View website http://eonasdan.github.io/bootstrap-datetimepicker/ -->
                 <div class='input-group date' id='datetimepicker1'> 
                        {{ Form::text('product_date', null, ['class' => 'form-control', 'placeholder' => 'Product Date'])  }}
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
               </div>


               <div class="form-group">
                    {{ Form::label('youtube_title', 'YouTube video title') }}
                    {{ Form::text('youtube_title', null, ['class' => 'form-control', 'placeholder' => 'YouTube video title'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('youtube_url', 'YouTube video code') }}
                    {{ Form::text('youtube_url', null, ['class' => 'form-control', 'placeholder' => 'YouTube video code'])  }}
                </div>


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


     $('#disable_price').change(function(){
        if($('#disable_price:checked').length){
            $('#product_price').attr('readonly',true); //If checked - Read only
        }else{
            $('#product_price').attr('readonly',false);//Not Checked - Normal
        }
    });


$('#product_best_seller').on('change', function(){
   this.value = this.checked ? 1 : 0;
   // alert(this.value);
}).change();

 </script>


@stop