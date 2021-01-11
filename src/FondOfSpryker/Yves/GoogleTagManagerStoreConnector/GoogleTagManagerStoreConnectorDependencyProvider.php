<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientBridge;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerStoreConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const STORE_CLIENT = 'STORE_CLIENT';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addStoreClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStoreClient(Container $container): Container
    {
        $container->set(static::STORE_CLIENT, function (Container $container) {
            return new GoogleTagManagerStoreConnectorToStoreClientBridge($container->getLocator()->store()->client());
        });

        return $container;
    }
}
