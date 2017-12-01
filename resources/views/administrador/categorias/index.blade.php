@extends('layouts.app')
@section('titulo','Mantenedor de Categorias')
@section('contenido')
    @foreach($categorias as $categoria)
    	<h6>{{$categoria->category}}</h6>
    @endforeach
@endsection
