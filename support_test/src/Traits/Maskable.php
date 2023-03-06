<?php

namespace Pandango\Traits;

trait Maskable
{
    /**
     * Attribute - $voucher->mask_code
     */
    public function getMaskCodeAttribute()
    {
        return string_mask($this->code);
    }

    /**
     * Attribute - $voucher->mask_code_last_4
     */
    public function getMaskCodeLast4Attribute()
    {
        return substr($this->code, -4);
    }

    /**
     * Attribute - $card->mask_card_no
     */
    public function getMaskCardNoAttribute()
    {
        return string_mask($this->number);
    }
}