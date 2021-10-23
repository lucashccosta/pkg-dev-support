<?php

declare(strict_types=1);

namespace Dev\Support\Common;

use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Enums\AppErrorType;
use JsonSerializable;

class AppError implements JsonSerializable
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

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): mixed
    {
        return [
            'code' => $this->code->getValue(),
            'type' => $this->type->getValue(),
            'public_message' => $this->publicMessage,
            'private_message' => $this->privateMessage,
            'metadata' => $this->meta
        ];
    }
}
