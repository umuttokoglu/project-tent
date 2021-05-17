<?php

namespace App\Http\Requests;

use Illuminate\Http\UploadedFile;

class CategoryRequest
{
    protected $categoryId = 0;
    protected $categoryNameTr = '';
    protected $categoryNameEn = '';
    protected $categoryDetailTr = '';
    protected $categoryDetailEn = '';
    protected $categoryImg;
    protected $categoryStatus = false;

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return string
     */
    public function getCategoryNameTr(): string
    {
        return $this->categoryNameTr;
    }

    /**
     * @param string $categoryNameTr
     */
    public function setCategoryNameTr(string $categoryNameTr): void
    {
        $this->categoryNameTr = $categoryNameTr;
    }

    /**
     * @return string
     */
    public function getCategoryNameEn(): string
    {
        return $this->categoryNameEn;
    }

    /**
     * @param string $categoryNameEn
     */
    public function setCategoryNameEn(string $categoryNameEn): void
    {
        $this->categoryNameEn = $categoryNameEn;
    }

    /**
     * @return string
     */
    public function getCategoryDetailTr(): ?string
    {
        return $this->categoryDetailTr;
    }

    /**
     * @param string $categoryDetailTr
     */
    public function setCategoryDetailTr(string $categoryDetailTr): void
    {
        $this->categoryDetailTr = $categoryDetailTr;
    }

    /**
     * @return string
     */
    public function getCategoryDetailEn(): string
    {
        return $this->categoryDetailEn;
    }

    /**
     * @param string $categoryDetailEn
     */
    public function setCategoryDetailEn(string $categoryDetailEn): void
    {
        $this->categoryDetailEn = $categoryDetailEn;
    }

    /**
     * @return UploadedFile|null
     */
    public function getCategoryImg(): ?UploadedFile
    {
        return $this->categoryImg;
    }

    /**
     * @param UploadedFile|null $categoryImg
     */
    public function setCategoryImg(?UploadedFile $categoryImg): void
    {
        $this->categoryImg = $categoryImg;
    }

    /**
     * @return bool
     */
    public function isCategoryStatus(): bool
    {
        return $this->categoryStatus;
    }

    /**
     * @param bool $categoryStatus
     */
    public function setCategoryStatus(bool $categoryStatus): void
    {
        $this->categoryStatus = $categoryStatus;
    }
}
