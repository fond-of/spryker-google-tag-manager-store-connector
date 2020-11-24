<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class GoogleTagManagerStoreConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getInternalIps(): array
    {
        return $this->get(GoogleTagManagerStoreConnectorConstants::INTERNAL_IPS, []);
    }
}
