<?php


namespace App\Http\Services\Admin;


use App\Http\Requests\CategoryRequest;
use App\Http\Results\GlobalResult;
use App\Models\Category;
use GuzzleHttp\Psr7\Uri;
use http\Url;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public static function getAllCategories()
    {
        // TODO: Implement getAllCategories() method.
    }

    public static function getCategory(CategoryRequest $categoryRequest)
    {
        // TODO: Implement getCategory() method.
    }

    public static function storeOrUpdateCategory(CategoryRequest $request): GlobalResult
    {
        $result = new GlobalResult();

        if ($request->getCategoryId()) {
            $category = Category::find($request->getCategoryId());
        } else {
            if (null === $request->getCategoryImg()) {
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
            $result->addError('İşlem sırasında hata gerçekleşti. Tekrar deneyin.');
        }

        return $result;
    }

    public static function deleteCategory(CategoryRequest $request): GlobalResult
    {
        $result = new GlobalResult();

        if (!$request->getCategoryId()) {
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
            $result->addError('İşlem sırasında hata gerçekleşti. Tekrar deneyin.');
        }

        return $result;
    }
}
