@extends('layouts.app')

@section('conteudo')
    <div class="card card-body">
        <h3>Editar venda</h3>

        <div class="row">
            <div class="col-md-8 form-group">
                <label for="">Produto</label>
                <select type="text" class="form-control" id="busca_produto" style="width: 100%"></select>
            </div>
            <div class="col-md-4">
                <input type="button" id="add_produto" class="btn btn-success btn-sm" value="+ Adiconar produto"
                    style="margin-top: 30px;">
            </div>
        </div>

        <form id="form">
            @csrf
            @method('put')

            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Fornecedore</th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                    @foreach ($venda->produtos as $i => $item)
                        <tr>
                            <td>
                                <span onclick='remove(this)' class='text-danger btn btn-sm'
                                    style='cursor: pointer;'>(remove)</span>
                                <input type='hidden' name='itens[{{ $i }}][produto_id]'
                                    value='{{ $item->id }}'>
                                <input type='hidden' name='itens[{{ $i }}][valor]' value='{{ $item->preco }}'>
                            </td>
                            <td>{{ $item->nome }}</td>
                            <td class="preco">{{ $item->preco }}</td>
                            <td>
                                <ul>
                                    @foreach ($item->fornecedores as $fornecedor)
                                        <li>{{ $fornecedor->nome }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th id="vl_total"></th>
                        <th ></th>
                    </tr>
                </tfoot>
            </table>

            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="">Cep</label>
                    <input name="cep" id="cep" type="text" class="form-control" alt="cep"
                        onblur="buscaCep(this.value)"
                        value="{{ $venda->cep }}"    
                    >
                </div>
                <div class="col-md-3 form-group">
                    <label for="">UF</label>
                    <input name="uf" id="uf" type="text" class="form-control" value="{{ $venda->uf }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Cidade</label>
                    <input name="cidade" id="cidade" type="text" class="form-control" value="{{ $venda->cidade }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Bairro</label>
                    <input name="bairro" id="bairro" type="text" class="form-control" value="{{ $venda->bairro }}">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Endereco</label>
                    <input name="endereco" id="endereco" type="text" class="form-control" value="{{ $venda->endereco }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Número</label>
                    <input name="numero" id="numero" type="text" class="form-control" value="{{ $venda->numero }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Complemento</label>
                    <input name="complemento" id="complemento" type="text" class="form-control" value="{{ $venda->complemento }}">
                </div>
            </div>

            <div class="text-right">
                <a class="btn btn-sm" href="{{ route('vendas.index') }}">Voltar</a>
                <button tyle="submit" class="btn btn-sm btn-success">Salvar</button>
            </div>
        </form>


    </div>
@endsection

@push('scripts')
    <script>
        var valor_total = 0;
        var quantidade_itens = $(".preco").length;

        $(document).ready(() => {
            atualizaTotal();
            $('input').setMask();
        });

        $("#busca_produto").select2({
            placeholder: "Pesquise por nome ou referencia do produto",
            allowClear: true,

            language: {
                searching: function() {
                    return 'Buscando produtos (aguarde antes de selecionar)…';
                },
            },

            ajax: {
                url: "{{ route('produtos.getProdutos') }}",
                dataType: 'json',
                type: 'get',
                delay: 100,

                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page || 1
                    };
                },

                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: _.map(data.results, item => ({
                            id: Number.parseInt(item.id),
                            text: `${item.referencia} - ${item.nome}`,
                            dataProd: item
                        })),
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                },
                cache: true
            },
        });

        $("#add_produto").on('click', () => {
            var item = $("#busca_produto").select2('data')[0].dataProd;

            var tr = $("<tr>");

            tr.append($('<td>').html(
                "<span onclick='remove(this)' class='text-danger btn btn-sm' style='cursor: pointer;'>(remove)</span>" +
                "<input type='hidden' name='itens[" + quantidade_itens + "][produto_id]' value='" + item
                .id + "'>" +
                "<input type='hidden' name='itens[" + quantidade_itens + "][valor]' value='" + item.preco +
                "'>"
            ));
            tr.append($('<td>').text(item.nome));
            tr.append($("<td class='preco'>").text(item.preco));
            tr.append($('<td>').html(() => {
                fornecedores = ''
                item.fornecedores.forEach(element => {
                    fornecedores = fornecedores + "<li>" + element.nome + "</li>"
                });

                return "<ul>" + fornecedores + "</ul>";
            }));

            $("#tableBody").append(tr);

            atualizaTotal();
            quantidade_itens++

        })

        function remove(e) {
            console.log('aqui')
            $(e).parents('tr').remove()

            atualizaTotal()
        };

        function atualizaTotal() {
            valor_total = 0;

            $('.preco').each((i, e) => {
                valor_total += parseFloat($(e).text().replace(',', '.'));
            });

            $("#vl_total").text(valor_total.toFixed(2));
        }

        function buscaCep(cep) {
            cep = cep.replace(/[^a-zA-Z0-9]/g, '');

            if (cep.length > 0) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {

                        $("#uf").val(data.uf);
                        $("#bairro").val(data.bairro);
                        $("#cidade").val(data.localidade);
                        $("#endereco").val(data.logradouro);
                    })
                    .catch(error => console.error('Erro:', error));
            }
        }

        $("#form").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Enviar os dados usando AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('vendas.update', [$venda]) }}",
                data: formData,
                success: function(data) {
                    console.log(data);

                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Venda salva com sucesso!',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                    });

                    window.location.href = "{{ route('vendas.edit', [$venda]) }}";
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Falha!',
                        text: 'Erro ao salvar venda!',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                    });
                    console.error(error);
                }
            });
        });
    </script>
@endpush
