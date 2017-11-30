@extends('layouts.default')

@section('title', 'Eideal | Videos | Hair tools in Dubai and Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'Discover all the videos and medias about Eideal and our hair tools in Dubai and Lebanon')
@section('keywords', 'Hair tools, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care, keratin, hair brushes, round brush, ceramic brush, scissors')
@section('robots', 'INDEX,FOLLOW')

@section('content')

 <div id="start" class="container">
        <div class="page-title">
             <h1 class="page_h1"> VIDEOS </h1>
        </div>
   
     <div class="row" style="text-align:center">
      <?php $i=0; ?>
        
      @foreach ($all_videos as $a)
        @if($i%3 == 0)
          </div>
          <div class="row" style="text-align:center">
        @endif

          <div class="col-lg-4 col-md-4 col-sm-4 col-sx-12 news_click">

           <hr style="width:100%;" class="gray_spliter">
            <iframe class="youtube_iframe" width="100%" src="https://www.youtube.com/embed/{{ $a->url }}?modestbranding=1&autohide=1&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>
            <div class="news_title">{{ $a->title }}</div>
            <!--  <?php // change the format of the date 
                  $date=date_create($a->updated_at);  
                  $real_date = date_format($date,"Y-m-d");
              ?>
            <div class="news_date">{{ $real_date }}</div> -->
          </div>  
      <?php $i++; ?>
      @endforeach
    </div>

    <br/><br/>

  </div> <!-- end container -->

<script type='text/javascript' src='js/header_margin.js'></script>
@stop