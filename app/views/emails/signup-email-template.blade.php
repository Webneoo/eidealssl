@extends('layouts.email_template')

@section('content')

	<h1> Hello {{ $firstname }} and welcome to EIDEAL! </h1>

    <p> 
        You have been successfully registered with the username <b> {{ ucfirst($username) }} </b> <br/>
        Enjoy your purchase on <a href="http://eideal.com/products-1"> http://www.eideal.com </a>
    </p>

@stop