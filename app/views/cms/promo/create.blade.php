@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create Promo</h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        CREATE YOUR PROMO
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
            {{ Form::open(['route' => 'create_promo_path', 'role' => 'form']) }}

                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Promo title', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    {{ Form::label('code', 'Code') }}
                    {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Promo code', 'required' => 'required'])  }}
                </div>

                <div class="form-group">
                    <label for="percentage">Percentage</label>
                    <input step="any" min="1" max="100" class="form-control" placeholder="Percentage of the discount" name="percentage" type="number" value="" id="percentage" required>
                </div>

                <?php  
                     $today = date("m/d/Y"); 
                     $in_one_week = date("m/d/Y", strtotime("+1 week"));
                ?> 


                <div class="form-group">
                   {{ Form::label('date_range', 'START DATE:')  }}
                   <input class='form-control' type="text" name="daterange" value="{{ $today }} - {{ $in_one_week }}" required />
                </div>


                <input type="submit" value="SAVE" class="btn btn-primary button">

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