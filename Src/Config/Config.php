<?php 
# Arquivos e Diretórios Raiz;
$PastaInterna="projeto/";
define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/{$PastaInterna}");


if(substr($_SERVER['DOCUMENT_ROOT'], -1) == '/'){
    define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$PastaInterna}");
}else{
    define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}");
}

define('DIRJS',DIRPAGE."Public/js/");
define('DIRCSS',DIRPAGE."Public/css/");

# Rotas pré definidas;
