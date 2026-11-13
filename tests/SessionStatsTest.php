<?php
declare(strict_types=1);

namespace ClimbingLog\Tests;

use ClimbingLog\Session;
use ClimbingLog\SessionStats;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class SessionStatsTest extends TestCase
{
    public function testTotalSessionsCountsEverySession(): void
    {
        $stats = new SessionStats([
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 5, true),
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 3, false),
            new Session(new DateTimeImmutable('2026-11-03'), 'blue', 2, true),
        ]);

        $this->assertSame(3, $stats->totalSessions());
    }

    public function testTotalSessionsIsZeroWhenThereAreNoSessions(): void
    {
        $stats = new SessionStats([]);

        $this->assertSame(0, $stats->totalSessions());
    }

    public function testTotalSendsCountsOnlySentSessions(): void
    {
        $stats = new SessionStats([
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 5, true),
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 3, false),
            new Session(new DateTimeImmutable('2026-11-03'), 'blue', 2, true),
        ]);

        $this->assertSame(2, $stats->totalSends());
    }

    public function testTotalSendsIsZeroWhenNothingWasSent(): void
    {
        $stats = new SessionStats([
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 4, false),
            new Session(new DateTimeImmutable('2026-11-03'), 'blue', 2, false),
        ]);

        $this->assertSame(0, $stats->totalSends());
    }

    public function testSendRateReturnsTheFractionSent(): void
    {
        $stats = new SessionStats([
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 5, true),
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 3, false),
            new Session(new DateTimeImmutable('2026-11-03'), 'blue', 2, true),
        ]);

        $this->assertEqualsWithDelta(2 / 3, $stats->sendRate(), 0.000001);
    }

    public function testSendRateIsZeroWhenThereAreNoSessions(): void
    {
        $stats = new SessionStats([]);

        $this->assertSame(0.0, $stats->sendRate());
    }

    public function testSendsByGradeCountsSendsPerGrade(): void
    {
        $stats = new SessionStats([
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 5, true),
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 3, false),
            new Session(new DateTimeImmutable('2026-11-03'), 'blue', 2, true),
        ]);

        $this->assertSame(['black' => 1, 'blue' => 1], $stats->sendsByGrade());
    }

    public function testSendsByGradeIsEmptyWhenNothingWasSent(): void
    {
        $stats = new SessionStats([
            new Session(new DateTimeImmutable('2026-11-03'), 'black', 4, false),
        ]);

        $this->assertSame([], $stats->sendsByGrade());
    }

}
