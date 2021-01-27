<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander;

use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig;

class StoreDataLayerExpander implements DataLayerExpanderInterface
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
     * @param array $dataLayer
     *
     * @return array
     */
    public function expand(string $page, array $twigVariableBag, array $dataLayer): array
    {
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_PAGE_TYPE] = $page;
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_CURRENCY] = $this->getCurrency();
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_STORE] = $this->getStoreName();
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_INTERNAL_TRAFFIC] = $this->getInteralTraffic($twigVariableBag);
        $dataLayer[GoogleTagManagerStoreConnectorConstants::FIELD_SYSTEM] = $this->getEnviroment();

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

    /**
     * @param array $twigVariableBag
     *
     * @return bool|null
     */
    protected function getInteralTraffic(array $twigVariableBag): ?bool
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

    /**
     * @return string
     */
    protected function getEnviroment(): string
    {
        if (!defined(APPLICATION_ENV)) {
            return '';
        }

        if (APPLICATION_ENV === GoogleTagManagerStoreConnectorConstants::ENV_PRODUCTION) {
            return 'Prod';
        }

        if (APPLICATION_ENV === GoogleTagManagerStoreConnectorConstants::ENV_STAGING) {
            return 'Stage';
        }

        return 'Dev';
    }
}
