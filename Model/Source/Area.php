<?php

namespace Alaa\HeadFooterScripts\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Area
 * @package Alaa\HeadFooterScripts\Model\Source
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Area implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        static $options = [];
        if (!empty($options)) {
            return $options;
        }

        $options = [
            [
                'label' => 'Select Area',
                'value' => '0'
            ],
            [
                'label' => 'Head',
                'value' => 'head',
            ],
            [
                'label' => 'Footer',
                'value' => 'footer'
            ]
        ];

        return $options;
    }
}
