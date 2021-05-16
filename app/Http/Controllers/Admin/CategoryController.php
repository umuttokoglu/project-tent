<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ErrorCodeConstants;
use App\Http\Controllers\Controller;
use App\Http\Parsers\CategoryParser;
use App\Http\Results\GlobalResult;
use App\Http\Services\Admin\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
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

        return view('pages.category.index', ['categories' => $result]);
    }

    public function form(Request $request)
    {
        $result = new GlobalResult();

        if (null !== $request->segment(3)) {
            $category = Category::where('id', $request->segment(3))->first();

            if ($category === null) {
                $result->addError(__('errors.api.category_not_found'));
                $result->setErrorCode(ErrorCodeConstants::CATEGORY_NOT_FOUND);

                return $result;
            }
            $result->setSuccess(true);
            $result->setData($category);

            return view('pages.category.form', ['category' => $result]);
        }

        $result->setData(null);
        $result->setSuccess(true);

        return view('pages.category.form', ['category' => $result]);
    }

    public function store(Request $request)
    {
        dd($request->category_img);
        $commentStoreRequest = CategoryParser::parseCategoryRequest($request);
        $commentStoreResult = CategoryService::storeCategory($commentStoreRequest);

        return response()->json(['result' => $commentStoreResult]);
    }
}
