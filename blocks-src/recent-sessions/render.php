<?php
/**
 * Render template for the Recent Sessions block.
 *
 * WordPress includes this file each time the block renders and
 * provides $attributes, $content, and $block.
 */

use ClimbingLog\Session;
use ClimbingLog\SessionStats;
use DateTimeImmutable;

// Sample data for now; real session storage arrives later in the plan.
$sessions = [
    new Session( new DateTimeImmutable( '2026-11-19' ), 'black', 4, true ),
    new Session( new DateTimeImmutable( '2026-11-19' ), 'blue', 3, false ),
    new Session( new DateTimeImmutable( '2026-11-17' ), 'black', 5, true ),
    new Session( new DateTimeImmutable( '2026-11-17' ), 'black', 2, true ),
    new Session( new DateTimeImmutable( '2026-11-14' ), 'blue', 4, false ),
    new Session( new DateTimeImmutable( '2026-11-14' ), 'black', 3, true ),
];

$count = isset( $attributes['sessionsToShow'] ) ? (int) $attributes['sessionsToShow'] : 5;
$shown = array_slice( $sessions, 0, $count );
$stats = new SessionStats( $shown );
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <ul>
        <?php foreach ( $shown as $session ) : ?>
            <li>
                <?php echo esc_html( $session->date->format( 'M j, Y' ) ); ?> —
                <?php echo esc_html( $session->grade ); ?>,
                <?php echo (int) $session->attempts; ?> attempts,
                <?php echo $session->sent ? 'sent' : 'not sent'; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <p>
        <?php
        printf(
            '%d of %d sessions sent (%d%%).',
            $stats->totalSends(),
            $stats->totalSessions(),
            (int) round( $stats->sendRate() * 100 )
        );
        ?>
    </p>
</div>
