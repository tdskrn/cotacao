@extends('produtos.layoutmaster')
@section('content')
    <div class="container">
        <h2>{{ $produto->name }}</h2>
        <h3>{{ $produto->unity }}</h3>

    </div>
@endsection
