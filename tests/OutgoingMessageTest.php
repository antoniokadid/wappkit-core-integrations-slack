<?php

namespace AntonioKadid\WAPPKitCore\Tests\Integrations\Slack;

use AntonioKadid\WAPPKitCore\Integrations\Slack\Attachments\Attachment;
use AntonioKadid\WAPPKitCore\Integrations\Slack\Attachments\Field;
use AntonioKadid\WAPPKitCore\Integrations\Slack\OutgoingMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class OutgoingMessageTest
 *
 * @package AntonioKadid\WAPPKitCore\Tests\Integrations\Slack
 */
class OutgoingMessageTest extends TestCase
{
    public function testSend()
    {
        $message = new OutgoingMessage();
        $message->username = "Test bot";
        $message->asUser = FALSE;
        $message->channel = "general";
        $message->text = "This message is from the test bot";

        $field = new Field();
        $field->title = "Test";
        $field->value = "Outgoing message sent successfully";

        $attachment = new Attachment();
        $attachment->addField($field);

        $message->addAttachment($attachment);

        $result = $message->send('WEBHOOK URL GOES HERE');

        $this->assertTrue(TRUE);
    }
}