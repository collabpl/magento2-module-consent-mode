<?php
/**
 * @category  Collab
 * @package   Collab\ConsentMode
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\ConsentMode\Model\Config\Source;

class Behaviour implements \Magento\Framework\Option\ArrayInterface
{
    const VALUE_NATIVE = 'native';
    const VALUE_MINIMAL = 'minimal';

    public function toOptionArray(): array
    {
        return [
            ['value' => self::VALUE_NATIVE, 'label' => __('Native For Magento')],
            ['value' => self::VALUE_MINIMAL, 'label' => __('Save Minimal Set Of Preferences')],
        ];
    }
}
