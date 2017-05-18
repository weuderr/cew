
$(document).ready(function(){
    // var venda = {
    // init: function ()
    // {
    //     new this.geral();
    // },
    // geral: function (){
            var produtos = [];
            var estoque = [];
            var valores = [];
            var selecTag = '<option value="'+0+'"></option>';
            var cont = 0;
            $.ajax({
                url: 'produtos/',
                method: 'get',
                success: function (retorno) {
                    $.map(retorno, function(value, index) {
                        produtos[value['id']] = value['nome'];
                    });
                    $.each(retorno, function( index, value ){
                    });
                }
            });
            $.ajax({
                url: 'estoques/',
                method: 'get',
                success: function (retorno) {
                    estoque = $.map(retorno, function(value, index) {
                        value.produto_nome = produtos[value.produto_id];
                        selecTag += '<option value="'+value.id+'" estoque_id="'+value.id+'" produto_id="'+value.produto_id+'">'+value.produto_nome+'</option>';
                        return value;
                    });
                    $('#atualizar').find('.geral select').append(selecTag);
                    $('#criar').find('.geral select').append(selecTag);
                }
            });
            var controles = function(){
                $('#criar .produto'+cont).change(function(value){
                    var index = parseInt($('#criar .produto'+cont).val()) - 1 ;
                    var quantidade = estoque[index].quantidade;
                    var custo = estoque[index].custo;
                    $('#criar .geral .quatnidades').text('Quantidade ('+quantidade+')');
                    $('#criar .geral .valores').text('Valor ('+custo+')');
                    $('#criar input[name="quantidade'+cont+'"]').val(1);
                });

                $('#criar .geral').change(function(value){
                    var subTotal = 0.0;
                    var quantidade = parseInt($('#criar').find('input[name="quantidade'+cont+'"]').val());
                    var valor = parseFloat($('#criar').find('input[name="valor'+cont+'"]').val().replace(/,/g,'.'));
                    var desconto = parseFloat($('#criar').find('input[name="desconto"]').val().replace(/,/g,'.'));
                    $('#criar .geral .sub_total'+cont).text((quantidade*valor).toFixed(2));
                    for(i=cont; i >= 0 ; i--)
                    {
                        subTotal = subTotal + parseFloat($('#criar .geral .sub_total'+i).text());
                    }
                    $('#criar .geral .total').text(subTotal.toFixed(2));
                    $('#criar .geral .total').text((subTotal-desconto).toFixed(2));
                });
            }

            // $('#criar .geral input[name="desconto"]').change(function(){
            //     var subTotal = 0.0;
            //     for(i=cont; i >= 0 ; i--)
            //     {
            //         subTotal = subTotal + parseFloat($('#criar .geral .sub_total'+i).text());
            //     }
            //     var desconto = parseFloat($('#criar').find('input[name="desconto"]').val().replace(/,/g,'.'));
            //     $('#criar .geral .total').text((subTotal-desconto).toFixed(2));
            // });

            $('#criar input[name="adicionar"]').click(function(){
                $('#criar #inputaveis'+cont).after("<tr class='dados' id='inputaveis"+(++cont)+"'><td><select class='produto"+cont+"'>"+selecTag+"</select></td><td><input type='text' name='quantidade"+cont+"'></td><td><input type='text' name=valor"+cont+"></td><td style='background-color: darkgreen;'><div class='sub_total"+cont+"' ></div></td></tr>");
                controles();
            });

            $('#link').find('.listar').click(function(){
                $('#listar').css('display','initial');
                $('#criar').css('display','none');
                $('#exibir').css('display','none');
                $('#atualizar').css('display','none');
                $('#deletar').css('display','none');
            });
            $('#link').find('.criar').click(function(){
                $('#listar').css('display','none');
                $('#criar').css('display','initial');
                $('#exibir').css('display','none');
                $('#atualizar').css('display','none');
                $('#deletar').css('display','none');
                controles();

            });
            $('#link').find('.exibir').click(function(){
                $('#listar').css('display','none');
                $('#criar').css('display','none');
                $('#exibir').css('display','initial');
                $('#atualizar').css('display','none');
                $('#deletar').css('display','none');
            });
            $('#link').find('.atualizar').click(function(){
                $('#listar').css('display','none');
                $('#criar').css('display','none');
                $('#exibir').css('display','none');
                $('#atualizar').css('display','initial');
                $('#deletar').css('display','none');
            });
            $('#link').find('.deletar').click(function(){
                $('#listar').css('display','none');
                $('#criar').css('display','none');
                $('#exibir').css('display','none');
                $('#atualizar').css('display','none');
                $('#deletar').css('display','initial');
            });

            $('#link').find('.listar').click(function(){
                $.ajax({
                    url: 'vendas?_sort=id',
                    method: 'get',
                    success: function (retorno) {
                        $.each(retorno,function(index,value){
                            $('#listar').find('.geral .tabela').after('<tr>'+
                                '<td>'+
                                    value.id+
                                '</td><td>'+
                                    value.nome_vendedor+
                                '</td><td>'+
                                    value.venda_item_id+
                                '</td><td>'+
                                    value.desconto+
                                '</td></tr>');

                        });
                    }
                });
            });

            var listItens= '';
            var control = 0;
            $('#criar').find('input[name="salvar"]').click(function(){
                listItens= '';
                var itens = $('#criar .geral .dados');
                var dados = [];
                for(i=0; i < itens.length; i++)
                {
                    var estoque = parseInt($('#criar .produto'+i+' option:selected').attr('estoque_id'));
                    var qtd = parseInt($('#criar').find('input[name="quantidade'+i+'"]').val());
                    var preco = parseFloat($('#criar').find('input[name="valor'+i+'"]').val().replace(/,/g,'.'));
                    var subTotal = (qtd * preco);
                    dados ={
                            estoque_id: estoque,
                            quantidade: qtd,
                            valor: preco,
                            sub_total: subTotal,
                            troca: 0,
                            cancelada: 0
                    };
                    var verf = 0;
                    $.ajax({
                        url: 'venda_items/',
                        method: 'post',
                        data: dados,
                        success: function (retorno) {
                            listItens = listItens+', '+retorno.id;
                            $('#criar').find('.geral').append('<div>Item incluso</div>');
                            decrementoEstoque(estoque,qtd);
                        },
                        complete: function()
                        {
                            if(++verf == itens.length)
                                salvaCompra();
                            else
                                console.log(i +" - "+ (itens.length));
                        },
                        error: function (msg) {
                            $('#criar').find('.geral').append('<div>Erro, produto nao criado.</div>');
                        }
                    });
                }
            });
            function decrementoEstoque(estoque_id,qtd){
                var restam = estoque[estoque_id-1].quantidade - qtd;
                $.ajax({
                    url: 'estoques/'+estoque_id,
                    method: 'put',
                    data: {
                        quantidade: restam
                    },
                    success: function (retorno) {
                        $('#criar').find('.geral').append('<div>Estoque atualizado</div>');
                    },
                    error: function(request,msg,error) {
                        $('#criar').find('.geral').append('<div>Erro, nao atualizado.</div>');
                    }
                });
            }
            function salvaCompra(){
                var nomeVendedor = "Desenvolvimento";
                listItens = listItens.replace(", ","");
                var desconto = parseFloat($('#criar').find('input[name="desconto"]').val().replace(/,/g,'.'));
                var total =  parseFloat($('#criar .geral .total').text());
                $.ajax({
                    url: 'vendas/',
                    method: 'post',
                    data: {
                        nome_vendedor: nomeVendedor,
                        venda_item_id: listItens,
                        desconto: desconto,
                        cancelada: 0,
                        total: total
                    },
                    success: function (retorno) {
                        $('#criar').find('.geral').append('<div>Venda criada com sucesso</div>');
                        alert('troco: 0,00');
                        location.reload();
                    },
                    error: function (msg) {
                        $('#criar').find('.geral').append('<div>Erro, ao finalizar compra.</div>');
                    }
                });
            }
            $('#exibir').find('input[type="submit"]').click(function(){
                $.ajax({
                    url: 'vendas/'+parseInt($('#exibir').find('input[name="id"]').val()),
                    method: 'get',
                    success: function (retorno) {
                        console.log(retorno);
                        $('#exibir').find('.geral .tabela').after('<tr>'+
                                '<td>'+
                                    retorno.id+
                                '</td><td>'+
                                    retorno.nome_vendedor+
                                '</td><td>'+
                                    retorno.venda_item_id+
                                '</td><td>'+
                                    retorno.desconto+
                                '</td></tr>');
                        $('#exibir').find('.geral table').show();
                    },
                    error: function () {
                        $('#exibir').find('.geral').append('<div>Erro, na busca por este valor.</div>');
                    }
                });
            });

            $('#atualizar').find('input[type="submit"]').click(function(){
                $.ajax({
                    url: 'vendas/'+$('#atualizar').find('input[type="text"]').val(),
                    method: 'put',
                    data: {
                        produto_id:parseInt($('#atualizar').find('.geral select').val()),
                        quantidade: $('#atualizar').find('input[name="quantidade"]').val(),
                        custo: $('#atualizar').find('input[name="custo"]').val(),
                    },
                    success: function (retorno) {
                        $('#atualizar').find('.geral').append('<div>'+retorno.id+" - "+produtos[retorno.produto_id - 1]['nome']+'</div>');
                    },
                    error: function(request,msg,error) {
                        $('#atualizar').find('.geral').append('<div>Erro, nao atualizado.</div>');
                    }
                });
            });

            $('#deletar').find('input[type="submit"]').click(function(){
                $.ajax({
                    url: 'vendas/' + $('#deletar').find('input[type="text"]').val(),
                    method: 'delete',
                    type: "delete",
                    success: function () {
                        $('#deletar').find('.geral').append('<div>Deletado com suecesso.</div>');
                    },
                    error: function(request,msg,error) {
                        $('#deletar').find('.geral').append('<div>Erro, nao deletado.</div>');
                    }
                });
            });
    // }
// }
});

// $(document).ready(function(){
//     new venda();
// });