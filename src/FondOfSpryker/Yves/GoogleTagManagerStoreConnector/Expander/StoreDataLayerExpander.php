<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander;

use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig;

class StoreDataLayerExpander implements StoreDataLayerExpanderInterface
{
    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface
     */
    protected $storeClient;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface $storeClient
     * @param \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig $config
     */
    public function __construct(
        GoogleTagManagerStoreConnectorToStoreClientInterface $storeClient,
        GoogleTagManagerStoreConnectorConfig $config
    ) {
        $this->storeClient = $storeClient;
        $this->config = $config;
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
        $variableList[GoogleTagManagerStoreConnectorConstants::FIELD_CURRENCY] = $this->getCurrency();
        $variableList[GoogleTagManagerStoreConnectorConstants::FIELD_STORE] = $this->getStoreName();
        $variableList[GoogleTagManagerStoreConnectorConstants::FIELD_INTERNAL_TRAFFIC] = $this->getInteralTraffic($twigVariableBag);

        return $variableList;
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
    public function getStoreName(): string
    {
        return $this->storeClient->getCurrentStore()->getName();
    }

    /**
     * @param array $twigVariableBag
     *
     * @return bool|null
     */
    public function getInteralTraffic(array $twigVariableBag): ?bool
    {
        $internalIps = $this->config->getInternalIps();

        if (!isset($twigVariableBag[GoogleTagManagerStoreConnectorConstants::PARAM_CLIENT_IP])) {
            return false;
        }

        if (!in_array($twigVariableBag[GoogleTagManagerStoreConnectorConstants::PARAM_CLIENT_IP], $internalIps, true)) {
            return false;
        }

        return true;
    }
}
