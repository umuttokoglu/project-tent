<?php


namespace App\Http\Services\Admin;


use App\Constants\ErrorCodeConstants;
use App\Constants\FileTypeConstants;
use App\Http\Requests\CategoryFilesRequest;
use App\Http\Results\GlobalResult;
use App\Models\Category;
use App\Models\CategoryFile;
use Illuminate\Support\Str;

class CategoryFileService
{
    public static function getAllCategoryFiles(): GlobalResult
    {
        $result = new GlobalResult();

        $categoryFiles = CategoryFile::with('category')->orderBy('created_at', 'DESC')->paginate(20);

        if ($categoryFiles->count() === 0) {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILES_NOT_FOUND);
            $result->addError('Aradığınız dosyaları şu an bulamıyoruz. Lütfen biradan tekrar deneyin.');

            return $result;
        }

        $result->setSuccess(true);
        $result->setData($categoryFiles);

        return $result;
    }

    public static function getCategoryFile(CategoryFilesRequest $categoryFileRequest): GlobalResult
    {
        $result = new GlobalResult();

        $activeCategories = Category::statusActive()->get(['id', 'name']);

        if ($activeCategories->count() !== 0) {
            $result->setAdditionalData($activeCategories->toArray());
        }

        if (!$categoryFileRequest->getFileId()) {
            $result->setSuccess(true);

            return $result;
        }

        $categoryFile = CategoryFile::with('category')->find($categoryFileRequest->getFileId());

        if ($categoryFile === null) {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILE_NOT_FOUND);
            $result->addError('Görüntülemek istediğiniz dosya kayıtlarımızda yok.');

            return $result;
        }

        $result->setSuccess(true);
        $result->setData($categoryFile);

        return $result;
    }

    public static function storeOrUpdateCategoryFile(CategoryFilesRequest $categoryFileRequest): GlobalResult
    {
        $result = new GlobalResult();

        if ($categoryFileRequest->getFileId()) {
            $categoryFile = CategoryFile::find($categoryFileRequest->getFileId());
        } else {
            if (null === $categoryFileRequest->getFile()) {
                $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILE_FILE_REQUIRED);
                $result->addError('Dosyanızı ekleyemedik. Yeni bir kayıt eklerken dosya seçmek zorundasınız.');

                return $result;
            }

            $categoryFile = new CategoryFile();
        }

        if (null !== $categoryFileRequest->getFile()) {
            $categoryFile->file_extension = $categoryFileRequest->getFile()->extension();
            $categoryFile->type = FileTypeConstants::PDF;

            $fileName = 'F_' . time() . '_' . Str::snake($categoryFileRequest->getFileName()) . '.' . $categoryFileRequest->getFile()->extension();
            $categoryFileRequest->getFile()->move('pdf-files', $fileName);

            $categoryFile->path = asset('pdf-files/' . $fileName);
        }

        $categoryFile->category_id = $categoryFileRequest->getCategoryId();
        $categoryFile->name = $categoryFileRequest->getFileName();

        if ($categoryFile->save()) {
            $result->setSuccess(true);
        } else {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILE_COULD_NOT_STORE_OR_UPDATE);
            $result->addError('İşlem sırasında hata gerçekleşti. Tekrar deneyin.');
        }

        return $result;
    }

    public static function deleteCategoryFile(CategoryFilesRequest  $categoryFilesRequest): GlobalResult
    {
        $result = new GlobalResult();

        if (!$categoryFilesRequest->getFileId()) {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILE_NOT_FOUND);
            $result->addError('Silinecek kaydı bulamadık.');

            return $result;
        }

        $categoryFile = CategoryFile::find($categoryFilesRequest->getFileId());

        if ($categoryFile->delete()) {
            $result->setSuccess(true);

            $parsedUrl = parse_url($categoryFile->path);
            $filePath = public_path($parsedUrl['path']);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        } else {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILE_COULD_NOT_DELETE);
            $result->addError('İşlem sırasında hata gerçekleşti. Tekrar deneyin.');
        }

        return $result;
    }

    public static function downloadFile(CategoryFilesRequest $categoryFilesRequest): GlobalResult
    {
        $result = new GlobalResult();

        if (!$categoryFilesRequest->getFileId()) {
            $result->setErrorCode(ErrorCodeConstants::CATEGORY_FILE_NOT_FOUND);
            $result->addError('Silinecek kaydı bulamadık.');

            return $result;
        }

        $categoryFile = CategoryFile::find($categoryFilesRequest->getFileId());

        $parsedUrl = parse_url($categoryFile->path);
        $filePath = public_path($parsedUrl['path']);
        $headers = ['Content-Type: application/pdf'];
        $fileName = Str::snake($categoryFile->name) . '.pdf';

        $result->setSuccess(true);
        $result->setAdditionalData([
            'filePath' => $filePath,
            'headers' => $headers,
            'fileName' => $fileName
        ]);

        return $result;
    }
}
