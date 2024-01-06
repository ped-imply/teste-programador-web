@extends('layouts.app')

@section('conteudo')
    <div class="card card-body">
        <h3>Vendas</h3>
        <div class="row">
            <div class="col-sm-10">
                {{-- <input type="search" placeholder="Busque vendas por ID" class="form-control" name="busca_vendas"
                    id="busca_vendas"> --}}
            </div>
            <a class="btn col-md-2 btn-primary" href="{{ route('vendas.create') }}">Criar venda</a>
        </div>
    </div>

    <div class="card card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Produtos</th>
                    <th>Data</th>
                    <th>Valor total</th>
                    <th>Endereço de entrega</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($vendas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <ul>
                                @foreach ($item->produtos as $prod)
                                    <li>{{ $prod->nome }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($item->data)) }}</td>
                        <td>R$ {{ number_format($item->produtos->sum('pivot.valor'), 2, ',', '.') }}</td>
                        <td>{{ $item->cidade }} - {{ $item->uf }}, {{ $item->endereco }}, {{ $item->numero }}
                            {{ $item->complemento }}, cep: {{ $item->cep }}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('vendas.edit', [$item->id]) }}">Editar</a>
                            <form action="{{ route('vendas.destroy', [$item]) }}" method="post"
                                class="d-inline form-excluir-registro">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger btn-excluir-registro"
                                    aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Excluir">
                                    Excluir
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach()
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(".form-excluir-registro").submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Esta ação não pode ser desfeita!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).off('submit').submit();


                }
            });
        })
    </script>
@endpush
