<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\DataLayerExpander;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\DataLayerExpanderInterface;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig getConfig()
 */
class GoogleTagManagerStoreConnectorFactory extends AbstractFactory
{
    /**
     * @return DataLayerExpanderInterface
     */
    public function createDataLayerExpander(): DataLayerExpanderInterface
    {
        return new DataLayerExpander(
            $this->getStoreClient(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface
     */
    public function getStoreClient(): GoogleTagManagerStoreConnectorToStoreClientInterface
    {
        return $this->getProvidedDependency(GoogleTagManagerStoreConnectorDependencyProvider::STORE_CLIENT);
    }
}
