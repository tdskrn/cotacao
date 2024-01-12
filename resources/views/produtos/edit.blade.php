<!-- resources/views/produtos/edit.blade.php -->

@extends('produtos.layoutmaster')

@section('content')
    <div class="container">
        <h2>Editar Produto</h2>
        <form action="{{ route('produtos.update', $produto->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome do Produto:</label>
                <input type="text" name="name" class="form-control" value="{{ $produto->name }}" required>
            </div>
            <div class="form-group">
                <label for="unity">Descrição:</label>
                <textarea name="unity" class="form-control" required>{{ $produto->unity }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Produto</button>
        </form>
    </div>
@endsection
