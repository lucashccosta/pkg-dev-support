<?php

declare(strict_types=1);

namespace Dev\Support\Http;

use Dev\Support\Contracts\IResponse;
use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Common\AppError;
use JsonSerializable;

class Response implements IResponse, JsonSerializable
{
    private string $status;
    private int $statusCode = 200;
    private mixed $data = null;
    private ?AppError $error = null;

    public function __construct(mixed $data = null, ?AppError $error = null)
    {
        $this->data = $data;
        $this->error = $error;

        if (!is_null($error)) $this->status = IResponse::STATUS_FAILED;
        else $this->status = IResponse::STATUS_SUCCESSFUL;
    }

    /**
     * {@inheritDoc}
     */
    public function addData(mixed $item): self
    {
        $this->data = $item;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addError(AppError $error): self
    {
        $this->error = $error;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function getError(): AppError
    {
        return $this->error;
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * {@inheritDoc}
     */
    public function hasData(): bool
    {
        return $this->data?->length() !== 0;
    }

    /**
     * {@inheritDoc}
     */
    public function hasError(): bool
    {
        return !is_null($this->error);
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
    public function setAsFailed(): self
    {
        $this->status = IResponse::STATUS_FAILED;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAsSuccess(): self
    {
        $this->status = IResponse::STATUS_SUCCESSFUL;

        return $this;
    }


    /**
     * {@inheritDoc}
     */
    public function setStatusCode(AppResponseCode $statusCode): self
    {
        $this->statusCode = $statusCode->getValue();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): mixed
    {   
        $json = ['status' => $this->status];

        if (!empty($this->data)) $json['data'] = $this->data;
        if (!empty($this->error)) $json['error'] = $this->error;

        return $json;
    }
}
