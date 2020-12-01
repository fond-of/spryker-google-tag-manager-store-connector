<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\StoreDataLayerExpander;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\StoreDataLayerExpanderInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig getConfig()
 */
class GoogleTagManagerStoreConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\GoogleTagManagerStoreConnectorModelInterface
     */
    public function createStoreDataLayerExpander(): StoreDataLayerExpanderInterface
    {
        return new StoreDataLayerExpander(
            $this->getStore(),
            $this->getConfig()
        );
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStore(): Store
    {
        return $this->getProvidedDependency(GoogleTagManagerStoreConnectorDependencyProvider::STORE);
    }
}
