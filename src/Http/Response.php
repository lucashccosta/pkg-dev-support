<?php

declare(strict_types=1);

namespace Dev\Support\Http;

use Dev\Support\Contracts\ICollection;
use Dev\Support\Contracts\IResponse;
use Dev\Support\Error\AppError;

class Response implements IResponse
{
    private string $status;
    private ICollection $data;
    private ?ICollection $errors;

    /**
     * ICollectionResponse constructor.
     *
     * @param ICollection $data
     * @param ICollection $errors
     */
    public function __construct(ICollection $data, ?ICollection $errors = null)
    {
        $this->data = $data;
        $this->errors = $errors;

        if (!is_null($errors)) $this->status = IResponse::STATUS_FAILED;
        else $this->status = IResponse::STATUS_SUCCESSFUL;
    }

    /**
     * {@inheritDoc}
     */
    public function addData(string $key, $value): void
    {
        $this->data = $this->data->with($key, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function addError(string $key, AppError $error): void
    {
        $this->errors = $this->errors->with($key, $error);
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): array
    {
        return $this->data->all();
    }

    /**
     * {@inheritDoc}
     */
    public function getErrors(): array
    {
        return $this->errors->all();
    }

    /**
     * {@inheritDoc}
     */
    public function hasData(): bool
    {
        return $this->data->length() !== 0;
    }

    /**
     * {@inheritDoc}
     */
    public function hasErrors(): bool
    {
        return $this->errors->length() !== 0;
    }

    /**
     * {@inheritDoc}
     */
    public function isFailed(): bool
    {
        return $this->status === Response::STATUS_FAILED;
    }

    /**
     * {@inheritDoc}
     */
    public function isSuccessful(): bool
    {
        return $this->status === Response::STATUS_SUCCESSFUL;
    }

    /**
     * {@inheritDoc}
     */
    public function removeData(string $key): void
    {
        $this->data = $this->data->without($key);
    }

    /**
     * {@inheritDoc}
     */
    public function removeError(string $key): void
    {
        $this->errors = $this->errors->without($key);
    }

    /**
     * {@inheritDoc}
     */
    public function setAsFailed(): void
    {
        $this->status = IResponse::STATUS_FAILED;
    }

    /**
     * {@inheritDoc}
     */
    public function setAsSuccess(): void
    {
        $this->status = IResponse::STATUS_SUCCESSFUL;
    }
}
