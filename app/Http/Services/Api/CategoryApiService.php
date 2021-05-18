<?php


namespace App\Http\Services\Api;


use App\Constants\ErrorCodeConstants;
use App\Http\Requests\CategoryRequest;
use App\Http\Results\GlobalResult;
use App\Models\Category;

class CategoryApiService
{
    /**
     * @return GlobalResult
     */
    public static function getAllCategories(): GlobalResult
    {
        $result = new GlobalResult();

        $categories = Category::statusActive()->get();

        if ($categories->count() === 0) {
            $result->addError(__('errors.api.categories_not_found'));
            $result->setErrorCode(ErrorCodeConstants::CATEGORIES_NOT_FOUND);

            return $result;
        }

        $result->setData($categories->toArray());
        $result->setSuccess(true);

        return $result;
    }

    /**
     * @param CategoryRequest $categoryRequest
     *
     * @return GlobalResult
     */
    public static function getCategory(CategoryRequest $categoryRequest): GlobalResult
    {
        $result = new GlobalResult();

        $category = Category::where('id', $categoryRequest->getCategoryId())->statusActive()->first();

        if ($category === null) {
            $result->addError(__('errors.api.category_not_found'));
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_NOT_FOUND);

            return $result;
        }

        $result->setData($category->toArray());
        $result->setSuccess(true);

        return $result;
    }
}
