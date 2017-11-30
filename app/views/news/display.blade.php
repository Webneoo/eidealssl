@extends('layouts.default')

@section('title', 'Eideal | News | Hair tools in Dubai and Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'Discover all the news about Eideal and our hair tools in Dubai and Lebanon')

@section('content')

 <div id="start" class="container">
  <br/>
    <div style="text-align:center">
     <h3 class="news_title"><b>NEWS</b></h3>     
   </div>

   <br/>
     <div class="row" style="text-align:center">
     @foreach($newsDetails as $n)
      
      <div class="col-lg-7">
        <img src="images/news/{{ $n->img }}" style="width:100%;">
      </div>

      <div class="col-lg-5">
         <div class="news_title_display">{{ $n->title }}</div>
          <?php // change the format of the date 
                  $date=date_create($n->updated_at);  
                  $real_date = date_format($date,"Y-m-d");
              ?>
          <div class="news_date_display">{{ $real_date }}</div>
          <br/>
          <div class="news_text_display"> {{ $n->text }} </div>


         <a href="{{ route('news_path') }} "> <button type="button" class="best-seller-button back_news_bt">Back to news</button> </a>
      </div>

      @endforeach
    </div>

    <br/><br/>

  </div> <!-- end container -->
<script type='text/javascript' src='js/header_margin.js'></script>

@stop