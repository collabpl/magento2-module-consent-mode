<?php
/**
 * @category  Collab
 * @package   Collab\ConsentMode
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\ConsentMode\ViewModel;

use Collab\ConsentMode\Model\Data\Config;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ModeHandler implements ArgumentInterface
{
    public function __construct(
        protected readonly Config $config
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->config->isEnabled();
    }

    public function isUrlPassThroughEnabled(): bool
    {
        return $this->config->isUrlPassthroughEnabled();
    }
}
