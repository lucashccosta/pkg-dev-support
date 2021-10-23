<?php

declare(strict_types=1);

namespace Dev\Support\Error;

use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Enums\AppErrorType;

class AppError
{
    private AppResponseCode $code;
    private AppErrorType $type;
    private string $publicMessage;
    private string $privateMessage;
    private array $meta;

    public function __construct(
        AppResponseCode $code,
        AppErrorType $type,
        string $publicMessage = '',
        string $privateMessage = '',
        array $meta = []
    ) {
        $this->code = $code;
        $this->type = $type;
        $this->publicMessage = $publicMessage;
        $this->privateMessage = $privateMessage;
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
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPublicMessage(): string
    {
        return $this->publicMessage;
    }

    /**
     * @return string
     */
    public function getPrivateMessage(): string
    {
        return $this->privateMessage;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }
}
