<?php

namespace AntonioKadid\WAPPKitCore\Integrations\Slack\Attachments;

use JsonSerializable;

/**
 * Class Attachment
 *
 * @package AntonioKadid\WAPPKitCore\Integrations\Slack\Attachments
 */
class Attachment implements JsonSerializable
{
    const COLOR_GOOD = 'good';
    const COLOR_WARNING = 'warning';
    const COLOR_DANGER = 'danger';

    /**
     * @var array $fields
     */
    private $fields = [];

    /**
     * Required text summary of the attachment that is shown by clients that understand attachments but choose not to show them.
     *
     * @var string $fallback
     */
    public $fallback;

    /**
     * Optional text that should appear within the attachment.
     *
     * @var string $text
     */
    public $text;

    /**
     * Optional text that should appear above the formatted data.
     *
     * @var string $pretext
     */
    public $pretext;

    /**
     * Can either be one of 'good', 'warning', 'danger', or any hex color code.
     *
     * @var string $color
     */
    public $color;

    /**
     * @param Field $field
     */
    public function addField(Field $field)
    {
        array_push($this->fields, $field);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'fallback' => $this->fallback,
            'pretext' => $this->pretext,
            'color' => $this->color,
            'fields' => $this->fields
        ];
    }
}