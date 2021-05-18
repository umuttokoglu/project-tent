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

    /**
     * @param Request $request
     *
     * @return CategoryRequest
     */
    public static function parseCategoryFormRequest(Request $request): CategoryRequest
    {
        $categoryRequest = new CategoryRequest();

        if (null !== $request->get('category_id')) {
            $categoryRequest->setCategoryId($request->get('category_id'));
        } elseif (null !== $request->segment(3)) {
            $categoryRequest->setCategoryId($request->segment(3));
        }

        if (null !== $request->get('category_name_tr')) {
            $categoryRequest->setCategoryNameTr($request->get('category_name_tr'));
        }

        if (null !== $request->get('category_name_en')) {
            $categoryRequest->setCategoryNameEn($request->get('category_name_en'));
        }

        if (null !== $request->get('category_detail_tr')) {
            $categoryRequest->setCategoryDetailTr($request->get('category_detail_tr'));
        }

        if (null !== $request->get('category_detail_en')) {
            $categoryRequest->setCategoryDetailEn($request->get('category_detail_en'));
        }

        if ($request->hasFile('category_img')) {
            $categoryRequest->setCategoryImg($request->file('category_img'));
        }

        if (null !== $request->get('is_active')) {
            $categoryRequest->setCategoryStatus($request->get('is_active'));
        }

        return $categoryRequest;
    }
}
