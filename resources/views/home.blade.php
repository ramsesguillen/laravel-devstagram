@extends('layouts.app')
@section('titulo', 'Pagina principal')

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection
