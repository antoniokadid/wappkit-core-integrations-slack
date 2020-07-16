<?php

namespace AntonioKadid\WAPPKitCore\Integrations\Slack\Attachments;

use JsonSerializable;

/**
 * Class Field
 *
 * @package AntonioKadid\WAPPKitCore\Integrations\Slack\Attachments
 */
class Field implements JsonSerializable
{
    /** @var string $title The title may not contain markup and will be escaped for you. */
    public $title;

    /** @var string $value Text value of the field. May contain standard message markup and must be escaped as normal. May be multi-line. */
    public $value;

    /** @var boolean $short Optional flag indicating whether the `value` is short enough to be displayed side-by-side with other values. */
    public $short;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'value' => $this->value,
            'short' => $this->short
        ];
    }
}