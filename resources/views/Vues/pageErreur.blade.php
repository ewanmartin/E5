@extends('layouts.master')
@section('content')
    <br><br>
    <div class="alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        {{ $erreur }}
    </div>
@stop
