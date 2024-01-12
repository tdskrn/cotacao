@extends('produtos.layoutmaster')
@section('content')
    <div class="container">
        <h2>Criar Novo Produto</h2>
        <form action="{{ route('produtos.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="unity">Unidade do Produto:</label>
                <input type="text" name="unity" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary">Salvar Produto</button>
        </form>
    </div>
@endsection
