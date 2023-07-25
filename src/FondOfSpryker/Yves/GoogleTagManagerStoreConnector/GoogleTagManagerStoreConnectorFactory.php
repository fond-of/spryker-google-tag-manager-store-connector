<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\DataLayerExpanderInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\StoreDataLayerExpander;
use Spryker\Yves\Kernel\AbstractFactory;

class GoogleTagManagerStoreConnectorFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\DataLayerExpanderInterface
     */
    public function createStoreDataLayerExpander(): DataLayerExpanderInterface
    {
        return new StoreDataLayerExpander($this->getStoreClient());
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface
     */
    public function getStoreClient(): GoogleTagManagerStoreConnectorToStoreClientInterface
    {
        return $this->getProvidedDependency(GoogleTagManagerStoreConnectorDependencyProvider::STORE_CLIENT);
    }
}
