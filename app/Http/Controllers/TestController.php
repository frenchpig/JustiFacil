<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test($param1, $param2){
        echo "El parametro 1 es: $param1 ";
        echo "El parametro 2 es: $param2";
    }
}
