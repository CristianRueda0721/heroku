@extends('adminlte::page')



@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de usuarios registrados</h1>

    @livewire ('admin.users-index')

@stop
@section('content')
