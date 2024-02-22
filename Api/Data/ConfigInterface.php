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

    public function isEnabled(): bool;
    public function isUrlPassThroughEnabled(): bool;
}
