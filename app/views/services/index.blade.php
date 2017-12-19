 @extends('layouts.default')

@section('content')

<!-- slideshow a faire -->

 <div id="start" class="container blockContainer">



 	<div class="col-lg-12" style="text-align:center;">

     <div class="page-title">
         <h1 class="page_h1"> {{ $service_details[0]->title }} </h1>    
    </div>
    <br/>
    
    @if($service_images != NULL)
    <div class="row">
  		<div class="col-lg-12" style="text-align:center;">

              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-bottom: 20px;">
                <!-- Indicators -->

                <ol class="carousel-indicators">

                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <?php $i =1; ?>
                   <?php 
                    for($i=1; $i<=sizeof($service_images)-1; $i++) 
                    {
                  ?>
                      <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                  <?php
                    }
                  ?>
               
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox" style="height:445px">
                  <div class="item active">
                    <img src="images/services/{{ $service_images[0]->image }}" alt="{{ $service_details[0]->title }}" title="{{ $service_details[0]->title }}" style="width: 100%;">
                  </div>

                <?php $c =1; ?>
                @foreach ($service_images as $s)  
                  <?php 
                    if($c > 1) 
                    { 
                  ?> 
                      <div class="item">
                        <img src="images/services/{{ $s->image }}" alt="" style="width: 100%;">
                      </div>
                  <?php
                    }
                     $c++;
                  ?>

                @endforeach  
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
  			<hr style="border-top:2px solid #dfdfdf;"> </hr>
  		</div>
    </div>
    @endif

      
    <div class="row" style="font-family: 'MontserratRegular';"> 
    		<div class="col-lg-12 col-md-12" style="text-align:center;">
    			<p style="font-size:12px;">{{ $service_details[0]->content }}</p>
    			
    		</div> 
    </div>

    @if($service_videos != NULL)
      <div class="row" style="text-align:center">
        <?php $i=0; ?>
          
        @foreach ($service_videos as $v)
          @if($i%3 == 0)
            </div>
            <div class="row" style="text-align:center">
          @endif

            <div class="col-lg-4 col-md-4 col-sm-4 col-sx-12 news_click">

             <hr style="width:100%;" class="gray_spliter">
              <iframe class="youtube_iframe" width="100%" src="https://www.youtube.com/embed/{{ $v->url }}?modestbranding=1&autohide=1&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>
              <div class="news_title">{{ $v->title }}</div>
            </div>  
        <?php $i++; ?>
        @endforeach
      </div>
      <br/><br/>
    @endif



   
  </div>

  
 </div>

<script type='text/javascript' src='js/header_margin.js'></script>
@stop