var finalizarHtml = '<p id="mensagem"></p><a class="btn modal-close waves-effect waves-light modal-trigger finalizar">Fechar</a>';
function mostrarErros(erro){$.each(erro,function(k,v){$("#"+v).addClass("invalid"); $("."+v).attr('data-error',v+' inválido');});}
function chamarView(tipoUsuario){$.ajax({url:index+tipoUsuario+"/cadastro/view",type:'GET',success:function(html){$("#modal-body").html(html);}});}
function encerrar(mensagem){$("#modal-body").html(finalizarHtml);$("#mensagem").html(mensagem);}
function verificarUsuario(tipoUsuario,dados){
    $.ajax({
        url:index+"usuario/cadastro/verificar/"+tipoUsuario, type:'POST',data:dados,dataType:'json',
        success:function(data){
            if(data.status){chamarView(tipoUsuario);}else{
                if(data.erro === 1){$("#email").addClass("invalid"); $(".email").attr('data-error',data.mensagem);                       
                }else{mostrarErros(data.erro);}
            }
        }
    });
}

var cadastroUsuarios = [
{ // CANCELAR CADASTRO OU FINALIZAR
    elemento:".finalizar",
    evento:"click",
    funcao:function(e){e.preventDefault();$.ajax({url:index+"usuario/cadastro/finalizar",type:'GET'});}
}, // ------------------------------
{ // VERIFICAÇÃO DE USUÁRIO CLIENTE
    elemento:"#usuarioCliente",
    evento:"submit",
    funcao:function(e){
        e.preventDefault();
        var dados = $("#usuarioCliente").serialize();
        verificarUsuario("cliente",dados);
    }
}, // FIM VERIFICAÇÃO DE USUÁRIO CLIENTE

{ // CADASTRO DE CLIENTE
    elemento:"#perfilCliente",
    evento:"submit",
    funcao:function(e){
        e.preventDefault();
        var dados = $("#perfilCliente").serialize();        
        $.ajax({url:index+"cliente/cadastro/verificar",type:'POST',data:dados,dataType:'json',
                success:function(data){
                if(data.status){  
                    $.ajax({url:index+"usuario/cadastro/salvar",type:'POST',dataType:'json',
                        success: function(data){
                            if(data.status){
                                $.ajax({url:index+"cliente/cadastro/salvar",type:'POST',dataType:'json',
                                    success: function(data){encerrar(data.mensagem);}
                                });
                            }else{encerrar(data.mensagem);}
                        }
                    });
                }else{mostrarErros(data.erro);}
            }
        });
    }
}, // FIM CADASTRO DE CLIENTE
//--------------------------------------------------------------------------------------------------------------
{ // INÍCIO CADASTRO DE EMPRESA
    elemento:"#usuarioEmpresa",
    evento:"submit",
    funcao:function(e){
        e.preventDefault();
        var dados = $("#usuarioEmpresa").serialize();
        verificarUsuario("empresa",dados);   
    }
}, // FIM CADASTRO DE USUÁRIO
{ // INICIO CADASTRO DE EMPRESA
    elemento:"#perfilEmpresa",
    evento:"submit",
    funcao:function(e){
        e.preventDefault();
        var dados = $("#perfilEmpresa").serialize();        
        $.ajax({url:index+"empresa/cadastro/verificar",type:'POST',data:dados,dataType:'json',
            success:function(data){
                console.log(data);
                if(data.status){alert("Aqui!");chamarView("endereco");}else{mostrarErros(data.erro);}
            }
        });
    }
}, // FIM CADASTRO DE EMPRESA
{ // INICIO CADASTRO DE ENDEREÇO
    elemento:"#endereco",
    evento:"submit",
    funcao:function(e){
        e.preventDefault();
        var dados = $("#endereco").serialize();       
        $.ajax({url:index+"endereco/cadastro/verificar",type:'POST',data:dados,dataType:'json',
            success:function(data){
                console.log(data);
                alert(data.mensagem);
                if(data.status){             
                    $.ajax({url:index+"usuario/cadastro/cadastrar",type:'POST',dataType:'json',
                        success: function(data){
                            if(data.status){              
                                $.ajax({url:index+"empresa/cadastro/cadastrar",type:'POST',dataType:'json',
                                    success: function(data){
                                        if(data.status){            
                                            $.ajax({url: index+"endereco/cadastro/cadastrar",type:'POST',dataType:'json',
                                                success: function(data){
                                                    if(data.status){encerrar(data.mensagem);}else{encerrar(data.mensagem);}
                                                }
                                            });
                                        }else{encerrar(data.mensagem);}
                                    }
                                });
                            }else{encerrar(data.mensagem);}
                        }
                    });
                }else{
                    mostrarErros(data.erro);
                }
            }
        });
    }
} // FIM CADASTRO DE ENDEREÇO
]; // FIM ARRAY!