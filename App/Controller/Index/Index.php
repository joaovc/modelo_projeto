<?php
namespace App\Controller\Index;

use Src\Classes\Render;

class Index{

    public function view($dir, $arq){
        return Render::addView($dir, $arq);
    }

}