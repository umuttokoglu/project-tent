<?php


namespace App\Http\Results;


use App\Helpers\GlobalHelpers;
use Illuminate\Http\JsonResponse;

class GlobalResult
{
    protected $data = [];
    protected $success = false;
    protected $errorCode;
    protected $errors = [];

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
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