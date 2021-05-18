<?php


namespace App\Http\Services\Admin;


use App\Constants\ErrorCodeConstants;
use App\Http\Requests\CategoryRequest;
use App\Http\Results\GlobalResult;
use App\Models\Category;

class CategoryService
{
    public static function getAllCategories(): GlobalResult
    {
        $result = new GlobalResult();

        $categories = Category::orderBy('status', 'DESC')->paginate(15);

        if ($categories->count() === 0) {
            $result->addError(__('errors.api.categories_not_found'));
            $result->setErrorCode(ErrorCodeConstants::CATEGORIES_NOT_FOUND);

            return $result;
        }

        $result->setData($categories);
        $result->setSuccess(true);

        return $result;
    }

    public static function getCategory(CategoryRequest $categoryRequest): GlobalResult
    {
        $result = new GlobalResult();

        if (!$categoryRequest->getCategoryId()) {
            $result->setData(null);
            $result->setSuccess(true);

            return $result;
        }

        $category = Category::where('id', $categoryRequest->getCategoryId())->first();

        if ($category === null) {
            $result->addError(__('errors.api.category_not_found'));
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_NOT_FOUND);

            return $result;
        }

        $result->setSuccess(true);
        $result->setData($category);

        return $result;
    }

    public static function storeOrUpdateCategory(CategoryRequest $request): GlobalResult
    {
        $result = new GlobalResult();

        if ($request->getCategoryId()) {
            $category = Category::find($request->getCategoryId());
        } else {
            if (null === $request->getCategoryImg()) {
                $result->setErrorCode(ErrorCodeConstants::CATEGORY_IMG_NOT_FOUND);
                $result->addError('Kategoriye için bir görsel yüklemelisiniz!');

                return $result;
            }

            $category = new Category();
        }

        if (null !== $request->getCategoryImg()) {
            $imageName = 'C_' . time() . '.' . $request->getCategoryImg()->extension();
            $request->getCategoryImg()->move('img/category_img', $imageName);

            $category->img_url = asset('img/category_img/' . $imageName);
        }

        $category->name = $request->getCategoryNameTr();
        $category->name_en = $request->getCategoryNameEn();
        $category->description = $request->getCategoryDetailTr();
        $category->description_en = $request->getCategoryDetailEn();
        $category->status = $request->isCategoryStatus();

        if ($category->save()) {
            $result->setSuccess(true);
        } else {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_COULD_NOT_STORE_OR_UPDATE);
            $result->addError('İşlem sırasında hata gerçekleşti. Tekrar deneyin.');
        }

        return $result;
    }

    public static function deleteCategory(CategoryRequest $request): GlobalResult
    {
        $result = new GlobalResult();

        if (!$request->getCategoryId()) {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_NOT_FOUND);
            $result->addError('Silinecek kaydı bulamadık.');

            return $result;
        }

        $category = Category::find($request->getCategoryId());

        if ($category->delete()) {
            $result->setSuccess(true);

            $imgPath = parse_url($category->img_url);
            $imgPath = public_path($imgPath['path']);

            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        } else {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_COULD_NOT_DELETE);
            $result->addError('İşlem sırasında hata gerçekleşti. Tekrar deneyin.');
        }

        return $result;
    }
}
