<?php
/**
 * @category  Collab
 * @package   Collab\ConsentMode
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\ConsentMode\Model\Data;

use Collab\ConsentMode\Api\Data\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Store\Model\ScopeInterface;

class Config extends DataObject implements ConfigInterface
{

    public function __construct(
        protected ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($data);
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_IS_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    public function isUrlPassThroughEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_IS_URL_PASSTHROUGH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    public function isRejectButtonEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_IS_REJECT_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    public function getRejectButtonBehaviour(): ?string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_REJECT_BUTTON_BEHAVIOUR, ScopeInterface::SCOPE_STORE);
    }
}
