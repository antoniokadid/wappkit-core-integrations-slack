<?php

namespace AntonioKadid\WAPPKitCore\Integrations\Slack\Exceptions;

use Exception;
use Throwable;

/**
 * Class SlackIntegrationException
 *
 * @package AntonioKadid\WAPPKitCore\Integrations\Slack\Exceptions
 */
class SlackIntegrationException extends Exception
{
    /**
     * SlackIntegrationException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|NULL $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}