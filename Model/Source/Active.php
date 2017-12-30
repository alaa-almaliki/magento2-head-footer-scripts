<?php

namespace Alaa\HeadFooterScripts\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Active
 * @package Alaa\HeadFooterScripts\Model\Source
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Active implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        static $options = [];

        if (empty($options)) {
            $options = [
                [
                    'label' => __('Active'),
                    'value' => '1',
                ],
                [
                    'label' => __('In Active'),
                    'value' => '0',
                ]
            ];
        }

        return $options;
    }
}
