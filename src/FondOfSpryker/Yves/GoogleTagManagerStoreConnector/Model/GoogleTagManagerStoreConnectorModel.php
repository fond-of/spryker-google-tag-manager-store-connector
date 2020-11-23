<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model;

use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToCartClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Store;

class GoogleTagManagerStoreConnectorModel implements GoogleTagManagerStoreConnectorModelInterface
{
    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $store;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToCartClientInterface
     */
    protected $cartClient;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig
     */
    protected $config;

    /**
     * @param \Spryker\Shared\Kernel\Store $store
     * @param \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToCartClientInterface $cartClient
     * @param \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig $config
     */
    public function __construct(
        Store $store,
        GoogleTagManagerStoreConnectorToCartClientInterface $cartClient,
        GoogleTagManagerStoreConnectorConfig $config
    ) {
        $this->store = $store;
        $this->cartClient = $cartClient;
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
    public function getEmailHash(): array
    {
        $quoteTransfer = $this->cartClient->getQuote();

        if (!$quoteTransfer instanceof QuoteTransfer) {
            return [];
        }

        if (!$quoteTransfer->getBillingAddress() instanceof AddressTransfer) {
            return [];
        }

        if (!$quoteTransfer->getBillingAddress()->getEmail()) {
            return [];
        }

        return [
            GoogleTagManagerStoreConnectorConstants::FIELD_EXTERNAL_ID_HASH => sha1($quoteTransfer->getBillingAddress()->getEmail()),
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
