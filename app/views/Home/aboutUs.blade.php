@extends('layouts.default')

@section('content')
    
    <div id="start" class="container">
        <div class="page-title">
             <h1 class="page_h1"> ABOUT US </h1>
             <h2 class="page_h2"> A QUICK OVERVIEW </h2>
        </div>
    </div>
    @foreach ($aboutUs as $a)

        <img src="images/{{ $a->img }}" style="width:100%;">
        <div class="container">
            <div class="about_us_section">
                <h2 class="page_h2_about_us"> {{ $a->title1 }} </h2><br/>
                <p class="center">{{ $a->text1 }}</p>
            </div>

            <div class="about_us_section">
                <h2 class="page_h2_about_us"> {{ $a->title2 }} </h2><br/>
                <p class="justify">{{ $a->text2 }}  </p>
            </div>

            <div class="about_us_section">
                <h2 class="page_h2_about_us"> {{ $a->title3 }} </h2><br/>
                <p class="justify"> {{ $a->text3 }}  </p>
            </div>

            <div class="about_us_section">
                <h2 class="page_h2_about_us"> {{ $a->title4 }} </h2><br/>
                <p class="justify">{{ $a->text4 }}  </p>
            </div>

            <div class="about_us_section videos">
                <h2 class="page_h2_about_us"> {{ $a->title5 }} </h2><br/>
                <p class="justify"> {{ $a->text5 }}  </p>
            </div>
        </div>

    @endforeach

<script type='text/javascript' src='js/header_margin.js'></script>


@stop