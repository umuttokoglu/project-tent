<?php


namespace App\Http\Results;


use App\Helpers\GlobalHelpers;
use Illuminate\Http\JsonResponse;

class GlobalResult
{
    protected $data;
    protected $additionalData = [];
    protected $success = false;
    protected $errorCode;
    protected $errors = [];

    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return array|null
     */
    public function getAdditionalData(): ?array
    {
        return $this->additionalData;
    }

    /**
     * @param array|null $additionalData
     */
    public function setAdditionalData(?array $additionalData): void
    {
        $this->additionalData = $additionalData;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     */
    public function setErrorCode($errorCode): void
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @param string $error
     */
    public function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'errorCode' => $this->errorCode,
            'errors' => $this->errors
        ];
    }

    /**
     * @return JsonResponse
     */
    public function toJson(): JsonResponse
    {
        return GlobalHelpers::jsonResponse($this->toArray());
    }
}
