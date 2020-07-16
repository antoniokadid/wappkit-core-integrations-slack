<?php

namespace AntonioKadid\WAPPKitCore\Integrations\Slack;

use AntonioKadid\WAPPKitCore\HTTP\Request\PostRequest;

/**
 * Class Command
 *
 * Receive slash command
 *
 * https://api.slack.com/interactivity/slash-commands
 *
 * @package AntonioKadid\WAPPKitCore\Integrations\Slack
 */
class Command
{
    const ORIGIN_TYPE_UNKNOWN = 0;
    const ORIGIN_TYPE_CHANNEL = 1;
    const ORIGIN_TYPE_ENTERPRISE_GRID = 2;
    const ORIGIN_TYPE_TEAM = 3;

    /** @var string|null */
    private $_command;

    /** @var string|null */
    private $_text;

    /** @var string|null */
    private $_responseUrl;

    /** @var string|null */
    private $_triggerId;

    /** @var string|null */
    private $_userId;

    /** @var int */
    private $_originType;

    /** @var string|null */
    private $_originId;

    /** @var string|null */
    private $_originName;

    /**
     * Command constructor.
     */
    public function __construct()
    {
        $request = new PostRequest();

        $this->_command = $request->getString('_command');
        $this->_text = $request->getString('text');
        $this->_responseUrl = $request->getString('response_url');
        $this->_triggerId = $request->getString('trigger_id');
        $this->_userId = $request->getString('user_id');

        if ($request->offsetExists('channel_id')) {
            $this->_originType = self::ORIGIN_TYPE_CHANNEL;
            $this->_originId = $request->getString('channel_id');
            $this->_originName = $request->getString('channel_name');
        } else if ($request->offsetExists('enterprise_id')) {
            $this->_originType = self::ORIGIN_TYPE_ENTERPRISE_GRID;
            $this->_originId = $request->getString('enterprise_id');
            $this->_originName = $request->getString('enterprise_name');
        } else if ($request->offsetExists('enterprise_id')) {
            $this->_originType = self::ORIGIN_TYPE_TEAM;
            $this->_originId = $request->getString('team_id');
            $this->_originName = $request->getString('team_name');
        } else {
            $this->_originType = self::ORIGIN_TYPE_UNKNOWN;
            $this->_originId = NULL;
            $this->_originName = NULL;
        }
    }

    /**
     * The _command that was typed in to trigger this request.
     * This value can be useful if you want to use a single Request URL to service multiple Slash Commands, as it lets you tell them apart.
     *
     * @return string|null
     */
    public function getCommand(): ?string
    {
        return $this->_command;
    }

    /**
     * This is the part of the Slash Command after the _command itself, and it can contain absolutely anything that the user might decide to type.
     * It is common to use this text parameter to provide extra context for the _command.
     *
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->_text;
    }

    /**
     * A temporary webhook URL that you can use to generate messages responses.
     *
     * @return string|null
     */
    public function getResponseUrl(): ?string
    {
        return $this->_responseUrl;
    }

    /**
     * A short-lived ID that will let your app open a modal.
     *
     * @return string|null
     */
    public function getTriggerId(): ?string
    {
        return $this->_triggerId;
    }

    /**
     * The ID of the user who triggered the _command.
     *
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->_userId;
    }

    /**
     * The type of origin.
     *
     * @return int
     */
    public function getOriginType(): int
    {
        return $this->_originType;
    }

    /**
     * The origin ID. Can be channel ID, enterprise grid ID or team ID.
     *
     * @return string|null
     */
    public function getOriginId(): ?string
    {
        return $this->_originId;
    }

    /**
     * The origin name. Can be channel name, enterprise grid name or team name.
     *
     * @return string|null
     */
    public function getOriginName(): ?string
    {
        return $this->_originName;
    }
}