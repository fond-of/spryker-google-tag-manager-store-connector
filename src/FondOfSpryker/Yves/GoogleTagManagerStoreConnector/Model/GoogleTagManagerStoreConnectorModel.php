<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model;

use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig;
use Spryker\Shared\Kernel\Store;

class GoogleTagManagerStoreConnectorModel implements GoogleTagManagerStoreConnectorModelInterface
{
    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $store;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig
     */
    protected $config;

    /**
     * @param \Spryker\Shared\Kernel\Store $store
     * @param \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig $config
     */
    public function __construct(
        Store $store,
        GoogleTagManagerStoreConnectorConfig $config
    ) {
        $this->store = $store;
        $this->config = $config;
    }

    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function getCurrency(string $page, array $twigVariableBag, array $variableList): array
    {
        $variableList[GoogleTagManagerStoreConnectorConstants::FIELD_CURRENCY] = $this->store->getCurrencyIsoCode();

        return $variableList;
    }

    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function getStoreName(string $page, array $twigVariableBag, array $variableList): array
    {
        $variableList[GoogleTagManagerStoreConnectorConstants::FIELD_STORE] = $this->store->getStoreName();

        return $variableList;
    }

    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function getInteralTraffic(string $page, array $twigVariableBag, array $variableList): array
    {
        $internalIps = $this->config->getInternalIps();

        if (!isset($twigVariableBag[GoogleTagManagerStoreConnectorConstants::PARAM_CLIENT_IP])) {
            return $variableList;
        }

        if (!in_array($twigVariableBag[GoogleTagManagerStoreConnectorConstants::PARAM_CLIENT_IP], $internalIps, true)) {
            return $variableList;
        }

        $variableList[GoogleTagManagerStoreConnectorConstants::FIELD_INTERNAL_TRAFFIC] = true;

        return $variableList;
    }
}
