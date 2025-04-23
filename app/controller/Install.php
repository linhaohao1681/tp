<?php

namespace app\controller;

use think\annotation\route\Route;

class Install
{
    #[Route('GET','ccc')]
    function ccc(){
        echo '1111';
    }

    #[Route('GET','/log')]
    function aaa(){
        echo '0000';
    }
}