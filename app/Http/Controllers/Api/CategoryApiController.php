<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\ICategoryController;
use App\Http\Parsers\CategoryParser;
use App\Http\Services\Api\CategoryApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryApiController extends Controller implements ICategoryController
{
    /**
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        $categoriesResult = CategoryApiService::getAllCategories();

        return $categoriesResult->toJson();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getCategory(Request $request): JsonResponse
    {
        $categoryRequest = CategoryParser::parseCategoryRequest($request);
        $categoryResult = CategoryApiService::getCategory($categoryRequest);

        return $categoryResult->toJson();
    }
}
