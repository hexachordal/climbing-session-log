<?php
declare(strict_types=1);

namespace ClimbingLog;

final class SessionStats
{
    /** @param Session[] $sessions */
    public function __construct(private array $sessions) {}

    public function totalSessions(): int
    {
        return count($this->sessions);
    }

    public function totalSends(): int
    {
        $sends = 0;
        foreach ($this->sessions as $session) {
            if ($session->sent) {
                $sends++;
            }
        }
        return $sends;
    }

    public function sendRate(): float
    {
        if ($this->totalSessions() === 0) {
            return 0.0;
        }
        return $this->totalSends() / $this->totalSessions();
    }

    /** @return array<string, int> */
    public function sendsByGrade(): array
    {
        $byGrade = [];
        foreach ($this->sessions as $session) {
            if (!$session->sent) {
                continue;
            }
            $byGrade[$session->grade] = ($byGrade[$session->grade] ?? 0) + 1;
        }
        return $byGrade;
    }
}
