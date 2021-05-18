<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ErrorCodeConstants;
use App\Http\Controllers\Controller;
use App\Http\Parsers\CategoryParser;
use App\Http\Results\GlobalResult;
use App\Http\Services\Admin\CategoryService;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $allCategoriesResult = CategoryService::getAllCategories();

        return view('pages.category.index', ['categories' => $allCategoriesResult]);
    }

    public function form(Request $request)
    {
        $categoryFormRequest = CategoryParser::parseCategoryFormRequest($request);
        $categoryFormResult = CategoryService::getCategory($categoryFormRequest);

        return view('pages.category.form', ['category' => $categoryFormResult]);
    }

    public function storeOrUpdate(Request $request): RedirectResponse
    {
        $categoryStoreOrUpdateRequest = CategoryParser::parseCategoryFormRequest($request);
        $categoryStoreOrUpdateResult = CategoryService::storeOrUpdateCategory($categoryStoreOrUpdateRequest);

        return response()->redirectToRoute('categories')->with('result', $categoryStoreOrUpdateResult);
    }

    public function delete(Request $request): JsonResponse
    {
        $categoryDeleteRequest = CategoryParser::parseCategoryFormRequest($request);
        $categoryDeleteResult = CategoryService::deleteCategory($categoryDeleteRequest);

        return $categoryDeleteResult->toJson();
    }
}
