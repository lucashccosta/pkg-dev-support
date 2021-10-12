<?php

declare(strict_types=1);

namespace Spportz\Support\Enums;

class AppResponseCode extends BaseEnum
{
    public const SUCCESS = 200;
    public const CREATED = 201;
    public const NO_CONTENT = 204;
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 405;
    public const UNPROCESSABEL_ENTITY = 422;
    public const SERVER_ERROR = 500;
}
