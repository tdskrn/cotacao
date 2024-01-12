@extends('produtos.layoutmaster')
@section('content')
    <div class="container">
        <h2>Lista de Produtos</h2>
        <a href="{{ route('produtos.create') }}" class="btn btn-success">Adicionar Produto</a>
        @if (count($produtos) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->name }}</td>
                        <td>{{ $produto->unity }}</td>
                        <td>
                            <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Nenhum produto encontrado</p>
        @endif
    </div>
@endsection
