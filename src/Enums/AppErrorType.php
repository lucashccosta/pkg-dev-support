<?php

declare(strict_types=1);

namespace Dev\Support\Enums;

class AppErrorType extends BaseEnum
{
    public const AUTHORIZATION_ERROR = 'AUTHORIZATION_ERROR';
    public const BAD_PAYLOAD = 'BAD_PAYLOAD';
    public const NOT_FOUND_ERROR = 'NOT_FOUND_ERROR';
    public const VALIDATION_ERROR = 'VALIDATION_ERROR';
    public const PERSISTENCE_ERROR = 'PERSISTENCE_ERROR';
    public const BUSINESS_RULE_ERROR = 'BUSINESS_RULE_ERROR';
    public const NETWORK_COMMUNICATION_ERROR = 'NETWORK_COMMUNICATION_ERROR';
    public const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
}
