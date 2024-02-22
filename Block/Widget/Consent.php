<?php
/**
 * @category  Collab
 * @package   Collab\ConsentMode
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\ConsentMode\Block\Widget;

use Collab\ConsentMode\ViewModel\ModeHandler as ConsentMode;
use Magento\Framework\App\ObjectManager;
use Magento\Cookie\Block\Html\Notices;
use Magento\Cookie\Helper\Cookie as CookieHelper;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Consent extends Notices implements BlockInterface
{
    protected $_template = "Collab_ConsentMode::widget/notices.phtml";

    public function __construct(
        Template\Context $context,
        array $data = [],
        ?CookieHelper $cookieHelper = null,
        ?ConsentMode $consentMode = null
    ) {
        $data['consent_mode_view_model'] = $consentMode ?? ObjectManager::getInstance()->get(ConsentMode::class);
        parent::__construct($context, $data, $cookieHelper);
    }
}
