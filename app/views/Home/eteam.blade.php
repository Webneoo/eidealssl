@extends('layouts.default')

@section('content')
    
    <div id="start" class="container">
        <div class="page-title">
             <h1 class="page_h1"> E-TEAM </h1>
        </div>
    </div>
    <br/>
    @foreach ($eteam as $e)
        <img src="images/{{ $e->img }}" style="width:100%;">
        <div class="container">
            <div class="about_us_section">
                <p class="center">{{ $e->description }}</p>
            </div>
        </div>
    @endforeach

<script type='text/javascript' src='js/header_margin.js'></script>


@stop