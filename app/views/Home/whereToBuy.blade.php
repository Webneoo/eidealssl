@extends('layouts.default')

@section('content')

    <div id="start" class="container">
        <div class="row">
            <div class="page-title">
                 <h1 class="page_h1"> WHERE TO BUY </h1>
                 <h2 class="page_h1"> SALON GUIDE </h2>
                 <h2 class="page_h2" style="margin-top:0px;"> 
                     <a style="color:#9a9a9a;" href="{{ route('products_path', 1) }}">Shop online and benefit from a free express delivery !</a> 
                 </h2>
            </div>
        </div>
        <br/>

        <div class="row">  
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                <div class="filter_division">   
                 {{ Form::open(['route' => ['where_to_buy_path',0], 'role' => 'form']) }}
                  
                    <select id="country" class="input-sm" name="country_post">
                        <option value="0">All countries</option>
                        @foreach($country_list as $c)
                            <option value="{{ $c->country_id }}">{{ $c->desc }}</option>
                        @endforeach
                    </select>

                    <select class="input-sm" style="margin-left:3%;;" id="region" name="region_post" >
                        <option value="0">All region</option>
                        @foreach($all_region_list as $a)
                            <option value="{{ $a->region_id }}">{{ $a->desc }}</option>
                        @endforeach
                    </select>

                    
                    <input class="search_button" type="submit" value="Filter"/>
                {{ Form::close() }}
                </div> 
                <br/>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Region</th>
                            <th>Address</th>
                            <th>Phone</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($store_info as $s)
                        <tr>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->region.', '.$s->country }}</td>
                            <td>{{ $s->address }}</td>
                            <td>{{ $s->phone }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>                       
           
        </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 location">
                        <h1> Lebanon </h1>
                        <p> 
                            EIDEAL S.A.L<br>
                            BEIRUT<br>
                            TEL: +961 1 366081<br>
                            EMAIL: <a class="where_to_buy_email" href="mailto:info@eidealonline.com"> info@eidealonline.com</a><br>
                            <a class="where_to_buy_email" target="_blank" href="http://eidealonline.com"> www.eidealonline.com </a>
                        </p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 location">
                    <h1> United Arab Emirates </h1>
                    <p> 
                        EIDEAL TRADING L.L.C <br>
                        DUBAI<br>
                        TEL: +971 42594665<br>
                       EMAIL: <a class="where_to_buy_email" href="mailto:info@eidealonline.com"> info@eidealonline.com</a><br>
                        <a class="where_to_buy_email" target="_blank" href="http://eidealonline.com"> www.eidealonline.com </a>
                    </p>
                </div>
   
            </div> <!-- end row -->

           
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 location">
                    <h1> Kingdom of Saudi Arabia </h1>
                    <p> BEAUTY BOX LTD<br/>
                        JEDDAH<br>
                        TEL: +966 26 634209<br>
                        EMAIL: <a class="where_to_buy_email" href="mailto:sara@beautyboxltd.com"> sara@beautyboxltd.com</a><br>
                        <a class="where_to_buy_email" target="_blank" href="http://www.beautyboxltd.com/">www.beautyboxltd.com </a>
                    </p>
                </div>



                <div class="col-lg-6 col-md-6 col-sm-6 location">
                    <h1> India </h1>
                    <p> ZEUS WORLDWIDE TRADING<br/>
                        MUMBAI<br>
                        TEL: +912 26 5340892<br>
                        EMAIL: <a class="where_to_buy_email" href="mailto:zeusworldwide@gmail.com"> zeusworldwide@gmail.com</a><br>
                        <a class="where_to_buy_email" target="_blank" href="http://www.zeusworldwide.com/"> www.zeusworldwide.com </a>   
                    </p>
                </div>
            </div><!-- end row -->


            <div class="row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 location">
                    <h1> Kuwait </h1>
                    <p> AL AWAEL AL MASIYAH <br/>
                        AL SALMIYAH<br>
                        TEL: +965 6706 1023<br>
                        EMAIL: <a class="where_to_buy_email" href="mailto:info@awael-masiya.com"> info@awael-masiya.com</a><br>
                    </p>
                </div>
    
            </div><!-- end row -->

            <br/><br/>
    </div>


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


    <script>

      $( "#country" ).change(function() 
      {
          $.getJSON("{{ url('where-to-buy-')}}"+$(this).val(), 
            { option: $(this).val() }, 
        
        function(data) {
            var model = $('#region');
            model.empty();
            model.append("<option value="+0+">All regions </option>");
            $.each(data, function(index, element) {
                model.append("<option value='"+element.region_id+"'>" + element.desc + "</option>");
            });
        });

      });

    </script>

<script type='text/javascript' src='js/header_margin.js'></script>


</script>

@stop