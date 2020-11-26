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
     * @return array
     */
    public function getCurrency(): array
    {
        return [
            GoogleTagManagerStoreConnectorConstants::FIELD_CURRENCY => $this->store->getCurrencyIsoCode(),
        ];
    }

    /**
     * @return array
     */
    public function getStoreName(): array
    {
        return [
            GoogleTagManagerStoreConnectorConstants::FIELD_STORE => $this->store->getStoreName(),
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getInteralTraffic(array $params): array
    {
        $internalIps = $this->config->getInternalIps();

        if (!isset($params[GoogleTagManagerStoreConnectorConstants::PARAM_CLIENT_IP])) {
            return [];
        }

        if (!in_array($params[GoogleTagManagerStoreConnectorConstants::PARAM_CLIENT_IP], $internalIps, true)) {
            return [];
        }

        return [
            GoogleTagManagerStoreConnectorConstants::FIELD_INTERNAL_TRAFFIC => true,
        ];
    }
}
