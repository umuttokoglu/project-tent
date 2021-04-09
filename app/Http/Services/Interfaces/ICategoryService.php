<?php


namespace App\Http\Services\Interfaces;


use App\Http\Requests\CategoryRequest;

interface ICategoryService
{
    public static function getAllCategories();

    public static function getCategory(CategoryRequest $categoryRequest);
}
