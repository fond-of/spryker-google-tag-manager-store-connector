<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Plugin\DataLayer;

use FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerDataLayerExpanderPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @todo: not store based plugin, move to own package (i.e. General)
 *
 * @method \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory getFactory()
 */
class StoreInternalTrafficDataLayerExpanderPlugin extends AbstractPlugin implements GoogleTagManagerDataLayerExpanderPluginInterface
{
    /**
     * @param string $pageType
     * @param array $twigVariableBag
     *
     * @return bool
     */
    public function isApplicable(string $pageType, array $twigVariableBag = []): bool
    {
        return true;
    }

    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function expand(string $page, array $twigVariableBag, array $variableList): array
    {
        return $this->getFactory()
            ->createGoogleTagManagerStoreConnectorModel()
            ->getInteralTraffic($page, $twigVariableBag, $variableList);
    }
}
