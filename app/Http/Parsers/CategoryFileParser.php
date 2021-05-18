<?php


namespace App\Http\Parsers;


use App\Http\Requests\CategoryFilesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryFileParser
{
    public static function parseCategoryFilesRequest(Request $request): CategoryFilesRequest
    {
        $categoryFilesRequest = new CategoryFilesRequest();

        if (null !== $request->segment(4)) {
            $categoryFilesRequest->setCategoryId($request->segment(4));
        }

        if (null !== $request->segment(5)) {
            $categoryFilesRequest->setFileId($request->segment(5));
        }

        return $categoryFilesRequest;
    }

    public static function parseCategoryFileFormRequest(Request $request): CategoryFilesRequest
    {
        $categoryFileFormRequest = new CategoryFilesRequest();

        if ($request->segment(3) !== null) {
            $categoryFileFormRequest->setFileId($request->segment(3));
        } elseif ($request->get('category_file_id') !== null) {
            $categoryFileFormRequest->setFileId($request->get('category_file_id'));
        } else {
            $categoryFileFormRequest->setFileId($request->segment(2));
        }

        if ($request->get('category_file_category_id') !== null) {
            $categoryFileFormRequest->setCategoryId($request->get('category_file_category_id'));
        }

        if ($request->get('category_file_name') !== null) {
            $categoryFileFormRequest->setFileName($request->get('category_file_name'));
        }

        if ($request->hasFile('category_file')) {
            $categoryFileFormRequest->setFile($request->file('category_file'));
        }

        return $categoryFileFormRequest;
    }
}
