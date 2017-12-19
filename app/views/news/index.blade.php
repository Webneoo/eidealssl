@extends('layouts.default')

@section('title', 'Eideal | News | Hair tools in Dubai and Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'Discover all the news about Eideal and our hair tools in Dubai and Lebanon')
@section('keywords', 'Hair tools, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care, keratin, hair brushes, round brush, ceramic brush, scissors')
@section('robots', 'INDEX,FOLLOW')

@section('content')

 <div id="start" class="container">
  <br/>
    <div style="text-align:center">
    <h1 class="page_h1">NEWS</h1>
     <select id="selectEl" class="news_date" name="newsdate" style="margin-top:8px;">
                  <option value="news-0">ALL NEWS</option>
                  <?php 
                    $d = date("Y");
                    for($i=$d; $i>=2011; $i--)
                    {
                  ?>
                  <option <?php if($news_date == $i) echo 'selected' ?> value="<?php echo "news-".$i; ?>">{{$i}}</option>
                  <?php 
                    }
                   ?>
        </select>          
<!--     <hr style="border-top: 2px solid #dfdfdf" style="width:80%">
 -->    </div>


     <div class="row" style="text-align:center">
      <?php $i=0; ?>
     
      <?php //in case there is no news related to the selected date, display an error msg
      if(empty($newsList)) 
        echo '<br/><br/><br/><br/><br/><div class="no_news_msg"> There is no news related to the selected date </div><br/><br/><br/><br/><br/><br/><br/>'; 
      ?>
     
      @foreach ($newsList as $n)
        @if($i%3 == 0)
          </div>
          <div class="row" style="text-align:center">
        @endif

          <a href="{{ route('display_news_path', $n->news_id) }}" class="col-lg-4 col-md-4 col-sm-4 col-sx-12 news_click">

           <hr class="gray_spliter">
            <img src="images/news/{{ $n->img }} " class="news_image" alt="{{ $n->title }}" title="{{ $n->title }}"/>
            <div class="news_title">{{ $n->title }}</div>
             <?php // change the format of the date 
                  $date=date_create($n->updated_at);  
                  $real_date = date_format($date,"Y-m-d");
              ?>
            <div class="news_date">{{ $real_date }}</div>
          </a>  
      <?php $i++; ?>
      @endforeach
    </div>

    <br/><br/>

  </div> <!-- end container -->


  <script type="text/javascript">

    // get your select element and listen for a change event on it
    $('#selectEl').change(function() {
      // set the window's location property to the value of the option the user has selected
      window.location = $(this).val();
    });

  </script>
<script type='text/javascript' src='js/header_margin.js'></script>
@stop