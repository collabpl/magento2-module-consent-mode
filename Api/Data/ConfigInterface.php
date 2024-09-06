<?php
/**
 * @category  Collab
 * @package   Collab\ConsentMode
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\ConsentMode\Api\Data;

interface ConfigInterface
{
    public const XML_PATH_IS_ENABLED = "collab_consent/general/enabled";
    public const XML_PATH_IS_URL_PASSTHROUGH_ENABLED = "collab_consent/general/url_passthrough";
    public const XML_PATH_IS_REJECT_ENABLED = "collab_consent/general/reject_enabled";
    public const XML_PATH_REJECT_BUTTON_BEHAVIOUR = "collab_consent/general/reject_behaviour";

    public function isEnabled(): bool;
    public function isUrlPassThroughEnabled(): bool;
    public function isRejectButtonEnabled(): bool;
    public function getRejectButtonBehaviour(): ?string;
}
