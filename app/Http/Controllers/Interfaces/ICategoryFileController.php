<?php


namespace App\Http\Controllers\Interfaces;


use Illuminate\Http\Request;

interface ICategoryFileController
{
    public function getCategoryFiles(Request $request);

    public function getCategoryFile(Request $request);
}
