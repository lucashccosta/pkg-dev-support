<?php

declare(strict_types=1);

namespace Spportz\Support\Error;

use Spportz\Support\Enums\AppErrorType;
use Spportz\Support\Enums\AppResponseCode;

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
    public function build(
        AppResponseCode $code,
        ?AppErrorType $errorType = null,
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
