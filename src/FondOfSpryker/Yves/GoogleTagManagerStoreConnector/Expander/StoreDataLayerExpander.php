<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander;

use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface;

class StoreDataLayerExpander implements DataLayerExpanderInterface
{
    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface
     */
    protected $storeClient;

    /**
     * @param \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface $storeClient
     */
    public function __construct(GoogleTagManagerStoreConnectorToStoreClientInterface $storeClient)
    {
        $this->storeClient = $storeClient;
    }

    /**
     * @param string $page
     * @param array<string, string> $twigVariableBag
     * @param array<string, string|string> $dataLayer
     *
     * @return array<string, bool|string>
     */
    public function expand(string $page, array $twigVariableBag, array $dataLayer): array
    {
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_PAGE_TYPE] = $page;
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_CURRENCY] = $this->getCurrency();
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_STORE] = $this->getStoreName();
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_INTERNAL_TRAFFIC] = (bool)getenv('FONDOF_INTERNAL');
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_SYSTEM] = getenv('APPLICATION_ENV');

        return $dataLayer;
    }

    /**
     * @return string
     */
    protected function getCurrency(): string
    {
        return $this->storeClient->getCurrentStore()->getSelectedCurrencyIsoCode();
    }

    /**
     * @return string
     */
    protected function getStoreName(): string
    {
        return $this->storeClient->getCurrentStore()->getName();
    }
}
