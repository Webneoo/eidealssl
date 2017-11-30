@extends('layouts.default')

@section('title', 'Eideal | About us | Hair tools in Dubai in Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'Your one stop website to everything hair related. Whether you’re a hair professional or simply a hair enthusiast and lover, eideal.com is here to take your experience and journey to the next level.')
@section('keywords', 'Hair tools, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care, keratin, hair brushes, round brush, ceramic brush, scissors')
@section('robots', 'INDEX,FOLLOW')

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