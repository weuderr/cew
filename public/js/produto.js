$(document).ready(function(){
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
            url: 'produtos/',
            method: 'get',
            success: function (retorno) {
                $('#listar').find('.geral').html('');
                $.each(retorno, function( index, value ){
                    $('#listar').find('.geral').append('<div>'+value.id+" - "+value.nome+'</div>');
                });
            }
        });
    });

    $('#criar').find('input[type="submit"]').click(function(){
        $.ajax({
            url: 'produtos/',
            method: 'post',
            data: {nome:$('#criar').find('input[type="text"]').val()},
            success: function (retorno) {
                $('#criar').find('.geral').append('<div>'+retorno.id+" - "+retorno.nome+'</div>');
            },
            error: function () {
                $('#criar').find('.geral').append('<div>Erro, produto nao criado.</div>');
            }
        });
    });

    $('#exibir').find('input[type="submit"]').click(function(){
        $.ajax({
            url: 'produtos/'+$('#exibir').find('input[type="text"]').val(),
            method: 'get',
            success: function (retorno) {
                $('#exibir').find('.geral').append('<div>'+retorno.id+" - "+retorno.nome+'</div>');
            },
            error: function () {
                $('#exibir').find('.geral').append('<div>Erro, na busca por este valor.</div>');
            }
        });
    });

    $('#atualizar').find('input[type="submit"]').click(function(){
        $.ajax({
            url: 'produtos/'+$('#atualizar').find('input[type="text"]').val(),
            method: 'put',
            data: {
                nome: $('#atualizar').find('input[name="nome"]').val()
            },
            success: function (retorno) {
                $('#atualizar').find('.geral').append('<div>'+retorno.id+" - "+retorno.nome+'</div>');
            },
            error: function(request,msg,error) {
                $('#atualizar').find('.geral').append('<div>Erro, nao atualizado.</div>');
            }
        });
    });

    $('#deletar').find('input[type="submit"]').click(function(){
        $.ajax({
            url: 'produtos/' + $('#deletar').find('input[type="text"]').val(),
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