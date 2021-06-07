<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency;

use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Client\Store\StoreClientInterface;

class GoogleTagManagerStoreConnectorToStoreClientBridge implements GoogleTagManagerStoreConnectorToStoreClientInterface
{
    /**
     * @var \Spryker\Client\Store\StoreClientInterface
     */
    protected $storeClient;

    /**
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     */
    public function __construct(StoreClientInterface $storeClient)
    {
        $this->storeClient = $storeClient;
    }

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer
    {
        return $this->storeClient->getCurrentStore();
    }
}
