<?php


namespace App\Http\Services\Api;


use App\Constants\ErrorCodeConstants;
use App\Http\Requests\CategoryFilesRequest;
use App\Http\Results\GlobalResult;
use App\Http\Services\Interfaces\ICategoryFileService;
use App\Models\CategoryFile;

class CategoryFileApiService implements ICategoryFileService
{
    public static function getAllCategoryFiles(CategoryFilesRequest $categoryFilesRequest)
    {
        $result = new GlobalResult();

        $categoryFiles = CategoryFile::where('category_id', $categoryFilesRequest->getCategoryId())->get();

        if ($categoryFiles->count() === 0) {
            $result->addError(__('errors.api.category_files_not_found'));
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILES_NOT_FOUND);

            return $result;
        }

        $result->setData($categoryFiles->toArray());
        $result->setSuccess(true);

        return $result;
    }

    public static function getFile(CategoryFilesRequest $categoryFilesRequest)
    {
        $result = new GlobalResult();

        $file = CategoryFile::where('category_id', $categoryFilesRequest->getCategoryId())
            ->where('id', $categoryFilesRequest->getFileId())
            ->first();

        if ($file === null) {
            $result->addError(__('errors.api.category_file_not_found'));
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILE_NOT_FOUND);

            return $result;
        }

        $result->setData($file->toArray());
        $result->setSuccess(true);

        return $result;
    }
}
