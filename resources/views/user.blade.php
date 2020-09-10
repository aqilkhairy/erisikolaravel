@extends('default')

@section('title', 'eRisiko')

@section('logo', 'https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png')

@section('userImg')
    {{Auth::user()->avatar}}
@stop

@section('userName')
    {{Auth::user()->name}}
@stop