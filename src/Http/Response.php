<?php

declare(strict_types=1);

namespace Dev\Support\Http;

use Dev\Support\Contracts\IResponse;
use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Common\AppError;
use Dev\Support\Contracts\IArrayable;
use Dev\Support\Contracts\ITransform;
use JsonSerializable;

class Response implements IResponse, JsonSerializable
{
    private string $status;
    private int $statusCode = 200;
    private ?IArrayable $data = null;
    private ?AppError $error = null;
    private ?ITransform $transformer = null;

    public function __construct(
        ?IArrayable $data = null, 
        ?AppError $error = null
    ) {
        $this->data = $data;
        $this->error = $error;

        if (!is_null($error)) $this->status = IResponse::STATUS_FAILED;
        else $this->status = IResponse::STATUS_SUCCESSFUL;
    }

    /**
     * {@inheritDoc}
     */
    public function addData(IArrayable $item): self
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
        return $this->data->toArray();
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
        return (
            !is_null($this->data)
            ? count($this->data->toArray()) > 0
            : 0
        );
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
    public function setAsFailed(?AppResponseCode $code = null): self
    {
        $this->status = IResponse::STATUS_FAILED;
        $this->statusCode = (
            is_null($code) 
            ? AppResponseCode::SERVER_ERROR
            : $code->getValue()
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAsSuccess(?AppResponseCode $code = null): self
    {
        $this->status = IResponse::STATUS_SUCCESSFUL;
        $this->statusCode = (
            is_null($code) 
            ? AppResponseCode::SUCCESS
            : $code->getValue()
        );

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
    public function setTransformer(ITransform $transformer): self
    {
        $this->transformer = $transformer;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): mixed
    {   
        $json = ['status' => $this->status];

        if (!empty($this->error)) {
            $json['error'] = $this->error;
        }

        if (!empty($this->data)) {
            $json['data'] = (
                !empty($this->transformer)
                ? $this->transformer->transform($this->data)
                : $this->data
            );
        }

        return $json;
    }
}
