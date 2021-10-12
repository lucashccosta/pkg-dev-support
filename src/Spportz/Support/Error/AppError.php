<?php

declare(strict_types=1);

namespace Spportz\Support\Error;

use Spportz\Support\Enums\AppResponseCode;
use Spportz\Support\Enums\AppErrorType;

class AppError
{
    private AppResponseCode $code;
    private AppErrorType $errorType;
    private string $pointer;
    private string $title;
    private string $detail;
    private array $meta;

    /**
     * ApplicationError constructor.
     *
     * @param AppErrorCode $code
     * @param AppErrorType $errorType
     * @param string $pointer
     * @param string $title
     * @param string $detail
     * @param array $meta
     */
    public function __construct(
        AppResponseCode $code,
        AppErrorType $errorType,
        string $pointer = '',
        string $title = '',
        string $detail = '',
        array $meta = []
    ) {
        $this->code = $code;
        $this->errorType = $errorType;
        $this->pointer = $pointer;
        $this->title = $title;
        $this->detail = $detail;
        $this->meta = $meta;
    }

    /**
     * @return AppResponseCode
     */
    public function getCode(): AppResponseCode
    {
        return $this->code;
    }

    /**
     * @return AppErrorType
     */
    public function getErrorType(): AppErrorType
    {
        return $this->errorType;
    }

    /**
     * @return string
     */
    public function getPointer(): string
    {
        return $this->pointer;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }
}
