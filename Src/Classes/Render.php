<?php
namespace Src\Classes;

class Render{

    public static function addView($dir,$arq,$parametros=null){
        if (file_exists(DIRREQ."App/View/{$dir}/{$arq}.phtml")){
            if($parametros && is_array($parametros)){
                $parametros;
                include_once DIRREQ."App/View/{$dir}/{$arq}.phtml";
            }else{
                include_once DIRREQ."App/View/{$dir}/{$arq}.phtml";
            }
        }
    }
        
    public static function addHeader(){
        if(file_exists(DIRREQ."App/View/Index/Header.phtml")){
            include_once DIRREQ."App/View/Index/Header.phtml";
        }
    } 

    public static function addMenu(){
        if(file_exists(DIRREQ."App/View/Index/Menu.phtml")){
            include_once DIRREQ."App/View/Index/Menu.phtml";
        }
    }

    public static function addModal(){
        if(file_exists(DIRREQ."App/View/Index/Modal.phtml")){
            include_once DIRREQ."App/View/Index/Modal.phtml";
        }
    }
}