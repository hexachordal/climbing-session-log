<?php
declare(strict_types=1);

namespace ClimbingLog;

use DateTimeImmutable;

final class Session
{
    public function __construct(
        public DateTimeImmutable $date,
        public string $grade,
        public int $attempts,
        public bool $sent,
    ) {}
}
