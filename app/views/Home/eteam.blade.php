@extends('layouts.default')

@section('title', 'Eideal | Team | A passionate team dedicated to Hair tools in Dubai and Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'A dedicated and enthousiastic team passioned by hairstyle and hair fashion.')
@section('keywords', 'Hair tools, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care, keratin, hair brushes, round brush, ceramic brush, scissors')
@section('robots', 'INDEX,FOLLOW')

@section('content')
    
    <div id="start" class="container">
        <div class="page-title">
             <h1 class="page_h1"> E-TEAM </h1>
        </div>
    </div>
    <br/>
    @foreach ($eteam as $e)
        <img src="images/{{ $e->img }}" style="width:100%;" alt="Eideal Team | Eideal E-team" Title ="Eideal Team">
        <div class="container">
            <div class="about_us_section">
                <p class="center">{{ $e->description }}</p>
            </div>
        </div>
    @endforeach

<script type='text/javascript' src='js/header_margin.js'></script>


@stop