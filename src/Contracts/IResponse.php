<?php

declare(strict_types=1);

namespace Dev\Support\Contracts;

use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Common\AppError;

interface IResponse
{
    /**
     * Available Response status
     */
    public const STATUS_FAILED = 'FAILED';
    public const STATUS_SUCCESSFUL = 'SUCCESSFUL';

    /**
     * Add data to the data list by key.
     *
     * @param mixed $item
     *
     * @return self
     */
    public function addData(mixed $item): self;

    /**
     * Add an Error to the error list by key.
     *
     * @param AppError $error
     * 
     * @return self
     */
    public function addError(AppError $error): self;

    /**
     * Return the data list content.
     *
     * @return array
     */
    public function getData(): array;

    /**
     * Return the error list content.
     *
     * @return AppError
     */
    public function getError(): AppError;

    /**
     * Return the status code.
     */
    public function getStatusCode(): int;

    /**
     * Return true if data list is not empty, otherwise return false.
     *
     * @return bool
     */
    public function hasData(): bool;

    /**
     * Return true if error list is not empty, otherwise return false.
     *
     * @return bool
     */
    public function hasError(): bool;

    /**
     * Check if Response is failed.
     *
     * @return bool
     */
    public function isFailed(): bool;

    /**
     * Check if Response is successful.
     *
     * @return bool
     */
    public function isSuccessful(): bool;

    /**
     * Set the response as failed.
     * 
     * @param AppResponseCode $code
     *
     * @return self
     */
    public function setAsFailed(AppResponseCode $code = 500): self;

    /**
     * Set the response as success.
     * 
     * @param AppResponseCode $code
     *
     * @return self
     */
    public function setAsSuccess(AppResponseCode $code = 200): self;

    /**
     *  Set the status code.
     * 
     * @param AppResponseCode $statusCode
     * 
     * @return self
     */
    public function setStatusCode(AppResponseCode $statusCode): self;
}
