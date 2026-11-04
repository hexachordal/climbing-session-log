<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use ClimbingLog\Session;
use ClimbingLog\SessionStats;

$stats = new SessionStats([
    new Session(new DateTimeImmutable('2026-11-03'), 'black', 5, true),
    new Session(new DateTimeImmutable('2026-11-03'), 'black', 3, false),
    new Session(new DateTimeImmutable('2026-11-03'), 'blue', 2, true),
]);

echo 'Total sessions: ' . $stats->totalSessions() . PHP_EOL;
echo 'Total sends: ' . $stats->totalSends() . PHP_EOL;
echo 'Send rate: ' . round($stats->sendRate() * 100) . '%' . PHP_EOL;
print_r($stats->sendsByGrade());
