@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create promo for the selected product</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        CREATE YOUR PROMO
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
            {{ Form::open(['route' => 'post_create_promo_product_path', 'role' => 'form']) }}

                <div class="form-group">
                    <h3>{{$product_info[0]->title}} - {{$product_info[0]->code}}</h3>
                </div>

                <img src="images/products/{{ $product_info[0]->img1}}" style="width:40%;">
                


                <div class="form-group">
                    <label for="percentage">Discount percentage</label>
                    <input step="any" min="1" max="100" class="form-control" placeholder="Percentage of the discount" name="percentage" type="number" value="{{ $product_info[0]->percentage}}" id="percentage" required>
                </div>

                <?php  
                    if($product_info[0]->promo_start_date != NULL)
                    {
                        $today = new DateTime($product_info[0]->promo_start_date);
                        $today = date_format($today, 'm/d/y');
                    }
                    else
                        $today = date("m/d/Y"); 

                    if($product_info[0]->promo_end_date != NULL)
                    {   
                        $in_one_week = new DateTime($product_info[0]->promo_end_date);
                        $in_one_week = date_format($in_one_week, 'm/d/y');
                    }
                    else
                        $in_one_week = date("m/d/Y", strtotime("+1 week"));
                ?> 


                <div class="form-group">
                   {{ Form::label('date_range', 'START DATE - END DATE:')  }}
                   <input class='form-control' type="text" name="daterange" value="{{ $today }} - {{ $in_one_week }}" required />
                </div>

                <input type="hidden" name="product_id" value="{{ $product_info[0]->product_id }}">


                <input type="submit" value="Save promo" class="btn btn-primary button">

            {{ Form::close() }}
             
             {{ Form::open(['route' => 'stop_promo_product_path', 'role' => 'form']) }}
                 <input type="hidden" name="product_id" value="{{ $product_info[0]->product_id }}">
                 <button class="btn btn-danger" style="position:relative; left:120px; top:-34px;">Stop promo</button>
             {{ Form::close() }}
        </div>



    </div>
 </div>

 <script src="js/moment.js"></script>
 <script src="js/datepicker.js"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

 <script type="text/javascript">
     $(function () {

       $('input[name="daterange"]').daterangepicker();   

     });

   



 </script>


@stop