<?php

declare(strict_types=1);

namespace Dev\Support\Common;

use Dev\Support\Enums\AppErrorType;
use Dev\Support\Enums\AppResponseCode;

final class AppErrorFactory
{
    public static function build(
        AppResponseCode $code,
        AppErrorType $type,
        string $publicMessage = '',
        string $privateMessage = '',
        array $meta = []
    ): AppError {
        return new AppError(
            $code,
            $type,
            $publicMessage,
            $privateMessage,
            $meta
        );
    }
}
