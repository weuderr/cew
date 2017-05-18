$(document).ready(function(){
    var produtos = [];
    $.ajax({
        url: 'produtos/',
        method: 'get',
        success: function (retorno) {
            produtos = $.map(retorno, function(value, index) {
                return value;
            });
            $.each(retorno, function( index, value ){
                $('#criar').find('.geral select').append('<option value="'+value.id+'">'+value.nome+'</option>');
                $('#atualizar').find('.geral select').append('<option value="'+value.id+'">'+value.nome+'</option>');
            });
        }
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
            url: 'estoques/',
            method: 'get',
            success: function (retorno) {
                $('#listar').find('.geral').html('');
                $.each(retorno, function( index, value ){
                    $('#listar').find('.geral').append('<div>'+value.id+
                                                        " - "+produtos[value.produto_id - 1]['nome']+
                                                        " - "+value.quantidade+
                                                        " - "+value.custo+
                                                        '</div>');
                });
            }
        });
    });

    $('#criar').find('input[type="submit"]').click(function(){
        $.ajax({
            url: 'estoques/',
            method: 'post',
            data: {
                produto_id:parseInt($('#criar').find('.geral select').val()),
                quantidade: $('#criar').find('input[name="quantidade"]').val(),
                custo: $('#criar').find('input[name="custo"]').val(),
            },
            success: function (retorno) {
                $('#criar').find('.geral').append('<div>Criado com sucesso</div>');
            },
            error: function () {
                $('#criar').find('.geral').append('<div>Erro, produto nao criado.</div>');
            }
        });
    });

    $('#exibir').find('input[type="submit"]').click(function(){
        $.ajax({
            url: 'estoques/'+parseInt($('#exibir').find('input[name="id"]').val()),
            method: 'get',
            success: function (retorno) {
                $('#exibir').find('.geral').append('<div>'+retorno.id+
                                                        " - "+produtos[retorno.produto_id - 1]['nome']+
                                                        " - "+retorno.quantidade+
                                                        " - "+retorno.custo+
                                                        '</div>');
            },
            error: function () {
                $('#exibir').find('.geral').append('<div>Erro, na busca por este valor.</div>');
            }
        });
    });

    $('#atualizar').find('input[type="submit"]').click(function(){
        $.ajax({
            url: 'estoques/'+$('#atualizar').find('input[type="text"]').val(),
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
            url: 'estoques/' + $('#deletar').find('input[type="text"]').val(),
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
});