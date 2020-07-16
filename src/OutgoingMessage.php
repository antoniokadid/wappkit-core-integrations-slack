<?php

namespace AntonioKadid\WAPPKitCore\Integrations\Slack;

use AntonioKadid\WAPPKitCore\HTTP\Client\CURL;
use AntonioKadid\WAPPKitCore\HTTP\Client\CURLOptions;
use AntonioKadid\WAPPKitCore\HTTP\Client\CURLResult;
use AntonioKadid\WAPPKitCore\HTTP\Exceptions\CURLException;
use AntonioKadid\WAPPKitCore\HTTP\Headers;
use AntonioKadid\WAPPKitCore\HTTP\URL;
use AntonioKadid\WAPPKitCore\Integrations\Slack\Attachments\Attachment;
use AntonioKadid\WAPPKitCore\Integrations\Slack\Exceptions\SlackIntegrationException;
use AntonioKadid\WAPPKitCore\Text\Exceptions\EncodingException;
use AntonioKadid\WAPPKitCore\Text\JSON\JSONEncoder;

/**
 * Class OutgoingMessage
 *
 * Post message to a channel
 *
 * https://api.slack.com/methods/chat.postMessage
 *
 * @package AntonioKadid\WAPPKitCore\Integrations\Slack
 */
class OutgoingMessage
{
    /** @var array */
    private $attachments = [];

    /** @var array */
    private $blocks = [];

    /**
     * Channel, private group, or IM channel to send message to. Can be an encoded ID, or a name.
     *
     * @var string
     */
    public $channel;

    /**
     * Optional. Pass true to post the message as the authed user, instead of as a bot. Defaults to false.
     *
     * @var bool
     */
    public $asUser = FALSE;

    /**
     * Optional. Set your bot's user name. Must be used in conjunction with $asUser set to false, otherwise ignored.
     *
     * @var string
     */
    public $username;

    /** @var string */
    public $text;

    /**
     * Optional. Emoji to use as the icon for this message. Overrides $iconUrl. Must be used in conjunction with $asUser set to false, otherwise ignored.
     *
     * @var string
     */
    public $iconEmoji;

    /**
     * Optional. URL to an image to use as the icon for this message. Must be used in conjunction with $asUser set to false, otherwise ignored.
     *
     * @var string
     */
    public $iconUrl;

    /**
     * @param Attachment $attachment
     */
    public function addAttachment(Attachment $attachment)
    {
        array_push($this->attachments, $attachment);
    }

    /**
     * @param string $url
     *
     * @return CURLResult
     *
     * @throws SlackIntegrationException
     */
    public function send(string $url): CURLResult
    {
        $payload = [];

        $payload['channel'] = $this->channel;
        $payload['text'] = $this->text;

        if ($this->asUser === FALSE) {
            if (!empty($this->username))
                $payload['username'] = $this->username;

            if (!empty($this->iconEmoji))
                $payload['icon_emoji'] = $this->iconEmoji;

            if (!empty($this->iconUrl))
                $payload['icon_url'] = $this->iconUrl;
        }

        if (!empty($this->attachments))
            $payload['attachments'] = $this->attachments;

        $curlClient = new CURL();

        $options = new CURLOptions();
        $options->headers = new Headers();
        $options->headers[Headers::ContentType] = 'application/json';

        try {
            return $curlClient->post(new URL($url), $payload, $options);
        } catch (CURLException $e) {
            throw new SlackIntegrationException($e->getMessage(), $e->getCode());
        } catch (EncodingException $e) {
            throw new SlackIntegrationException($e->getMessage(), $e->getCode());
        }
    }
}