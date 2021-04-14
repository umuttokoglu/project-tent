<?php


namespace App\Http\Services\Interfaces;


use App\Http\Requests\CategoryFilesRequest;

interface ICategoryFileService
{
    public static function getAllCategoryFiles(CategoryFilesRequest $categoryFilesRequest);

    public static function getFile(CategoryFilesRequest $categoryFilesRequest);
}
