function tipoUsuarioView(tipo){$.ajax({url:index+"usuario/cadastro/view/"+tipo,type:'GET',success:function(html){$("#modal-body").html(html);}});}
var enventosGet = [
{
    elemento:"#clienteCadastro",
    evento:"click",
    funcao:function(){
        tipoUsuarioView('cliente');
    }
},
{
    elemento:"#empresaCadastro",
    evento:"click",
    funcao:function(){
        tipoUsuarioView('empresa');
    }
},
{
    elemento:"#teste2",
    evento:"click",
    funcao:function(){
        $.ajax({
            url:index+"endereco/cadastro/view",
            type:'GET',
            success: function(html){
                $("#modal-body").html(html);
            }
        });
    }
}
]; // FIM ARRAY!