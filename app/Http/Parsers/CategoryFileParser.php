<?php


namespace App\Http\Parsers;


use App\Http\Requests\CategoryFilesRequest;
use Illuminate\Http\Request;

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
}
