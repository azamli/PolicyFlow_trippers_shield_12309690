<?php

namespace App\Domain\Exceptions;

use RuntimeException;

class InvalidTransitionException extends RuntimeException
{
    /**
     * @param string $fromStatus
     * @param string $toStatus
     * @param list<string> $allowedTransitions
     */
    public function __construct(
        public readonly string $fromStatus,
        public readonly string $toStatus,
        public readonly array $allowedTransitions = []
    ) {
        $allowedList = empty($allowedTransitions)
            ? 'none (terminal state)'
            : implode(', ', $allowedTransitions);

        parent::__construct(
            "Cannot transition policy request from '{$fromStatus}' to '{$toStatus}'. Allowed transitions: {$allowedList}."
        );
    }
}
