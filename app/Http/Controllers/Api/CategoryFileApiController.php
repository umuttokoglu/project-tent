<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\ICategoryFileController;
use App\Http\Parsers\CategoryFileParser;
use App\Http\Services\Api\CategoryFileApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryFileApiController extends Controller implements ICategoryFileController
{
    public function getCategoryFiles(Request $request): JsonResponse
    {
        $categoryFilesRequest = CategoryFileParser::parseCategoryFilesRequest($request);
        $categoryFilesResult = CategoryFileApiService::getAllCategoryFiles($categoryFilesRequest);

        return $categoryFilesResult->toJson();
    }

    public function getCategoryFile(Request $request): JsonResponse
    {
        $fileRequest = CategoryFileParser::parseCategoryFilesRequest($request);
        $fileResult = CategoryFileApiService::getFile($fileRequest);

        return $fileResult->toJson();
    }
}
