<?php


namespace App\Http\Controllers\Interfaces;


use Illuminate\Http\Request;

interface ICategoryController
{
    public function getCategories();

    public function getCategory(Request $request);
}
