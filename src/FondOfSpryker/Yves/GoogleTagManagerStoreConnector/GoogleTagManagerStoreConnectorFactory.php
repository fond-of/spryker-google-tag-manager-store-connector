<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToCartClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\GoogleTagManagerStoreConnectorModel;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\GoogleTagManagerStoreConnectorModelInterface;
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
    public function createGoogleTagManagerStoreConnectorModel(): GoogleTagManagerStoreConnectorModelInterface
    {
        return new GoogleTagManagerStoreConnectorModel(
            $this->getStore(),
            $this->getCartClient(),
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

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToCartClientInterface
     */
    public function getCartClient(): GoogleTagManagerStoreConnectorToCartClientInterface
    {
        return $this->getProvidedDependency(GoogleTagManagerStoreConnectorDependencyProvider::CART_CLIENT);
    }
}
