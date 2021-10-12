<?php

declare(strict_types=1);

namespace Spportz\Support\Http;

use Spportz\Support\Contracts\ICollection;
use Spportz\Support\Contracts\IResponse;
use Spportz\Support\Error\AppError;

class Response implements IResponse
{
    /**
     * @var string $status
     */
    private $status;

    /**
     * Contains the error list
     * (This list contains of data to show in case of failure)
     *
     * @var ICollection $errors
     */
    private $errors;

    /**
     * Contains the data list
     * (This list contains of data to show in case of success)
     *
     * @var ICollection $data
     */
    private $data;

    /**
     * ICollectionResponse constructor.
     *
     * @param ICollection $data
     * @param ICollection $errors
     */
    public function __construct(ICollection $data, ICollection $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    /**
     * ATTENTION: If the data is an array, the content will be added to the existing array
     * {@inheritDoc}
     */
    public function addData(string $key, $value): void
    {
        $values = $this->data->get($key, []);
        is_array($values) ?: $values = [$values];
        $values[] = $value;
        $this->data = $this->data->with($key, $values);
    }

    /**
     * {@inheritDoc}
     */
    public function addError(string $key, AppError $error): void
    {
        $errors = $this->errors->get($key, []);
        is_array($errors) ?: $errors = [$errors];
        $errors[] = $error;
        $this->errors = $this->errors->with($key, $errors);
    }

    /**
     * {@inheritDoc}
     */
    public function replaceData(string $key, $value): void
    {
        $this->data = $this->data->with($key, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function replaceError(string $key, AppError $error): void
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
        $this->status = Response::STATUS_FAILED;
    }

    /**
     * {@inheritDoc}
     */
    public function setAsSuccess(): void
    {
        $this->status = Response::STATUS_SUCCESSFUL;
    }
}
