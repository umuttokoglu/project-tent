<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Parsers\CategoryFileParser;
use App\Http\Services\Admin\CategoryFileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CategoryFileController extends Controller
{
    public function index()
    {
        $allCategoryFilesResult = CategoryFileService::getAllCategoryFiles();

        return view('pages.category-files.index', ['categoryFiles' => $allCategoryFilesResult]);
    }

    public function form(Request $request)
    {
        $categoryFileFormRequest = CategoryFileParser::parseCategoryFileFormRequest($request);
        $categoryFileFormResult = CategoryFileService::getCategoryFile($categoryFileFormRequest);

        return view('pages.category-files.form', ['categoryFile' => $categoryFileFormResult]);
    }

    public function storeOrUpdate(Request $request): RedirectResponse
    {
        $categoryFileFormRequest = CategoryFileParser::parseCategoryFileFormRequest($request);
        $categoryFileFormResult = CategoryFileService::storeOrUpdateCategoryFile($categoryFileFormRequest);

        return  response()->redirectToRoute('category-files')->with('result', $categoryFileFormResult);
    }

    public function delete(Request $request): JsonResponse
    {
        $categoryDeleteRequest = CategoryFileParser::parseCategoryFileFormRequest($request);
        $categoryDeleteResult = CategoryFileService::deleteCategoryFile($categoryDeleteRequest);

        return $categoryDeleteResult->toJson();
    }

    public function download(Request $request): BinaryFileResponse
    {
        $categoryDeleteRequest = CategoryFileParser::parseCategoryFileFormRequest($request);
        $categoryDeleteResult = CategoryFileService::downloadFile($categoryDeleteRequest);

        return response()->download(
            $categoryDeleteResult->getAdditionalData()['filePath'],
            $categoryDeleteResult->getAdditionalData()['fileName'],
            $categoryDeleteResult->getAdditionalData()['headers']
        );
    }
}
