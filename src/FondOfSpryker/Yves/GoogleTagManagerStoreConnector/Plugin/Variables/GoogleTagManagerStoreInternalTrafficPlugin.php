<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Plugin\Variables;

use FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @todo: not store based plugin, move to own package (i.e. General)
 *
 * @method \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory getFactory()
 */
class GoogleTagManagerStoreInternalTrafficPlugin extends AbstractPlugin implements GoogleTagManagerVariableBuilderPluginInterface
{
    /**
     * @param string $page
     * @param array $params
     *
     * @return array
     */
    public function addVariable(string $page, array $params): array
    {
        return $this->getFactory()
            ->createGoogleTagManagerStoreConnectorModel()
            ->getInteralTraffic($params);
    }
}
