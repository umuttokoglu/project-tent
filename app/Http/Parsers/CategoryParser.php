<?php


namespace App\Http\Parsers;


use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryParser
{
    /**
     * @param Request $request
     *
     * @return CategoryRequest
     */
    public static function parseCategoryRequest(Request $request): CategoryRequest
    {
        $categoryRequest = new CategoryRequest();

        if (null !== $request->segment(4)) {
            $categoryRequest->setCategoryId($request->segment(4));
        }

        return $categoryRequest;
    }
}
