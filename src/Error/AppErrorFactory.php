<?php

declare(strict_types=1);

namespace Dev\Support\Error;

use Dev\Support\Enums\AppErrorType;
use Dev\Support\Enums\AppResponseCode;

final class AppErrorFactory
{
    /**
     * Create an ApplicationError
     *
     * @param $code
     * @param string $errorType
     * @param string $pointer
     * @param string $title
     * @param string $detail
     * @param array $meta
     *
     * @return AppError
     */
    public static function build(
        AppResponseCode $code,
        AppErrorType $errorType,
        string $pointer = '',
        string $title = '',
        string $detail = '',
        array $meta = []
    ): AppError {
        return new AppError(
            $code,
            $errorType,
            $pointer,
            $title,
            $detail,
            $meta
        );
    }
}
