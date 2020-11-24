<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model;

interface GoogleTagManagerStoreConnectorModelInterface
{
    /**
     * @return array
     */
    public function getCurrency(): array;

    /**
     * @return array
     */
    public function getEmailHash(): array;

    /**
     * @return array
     */
    public function getStoreName(): array;

    /**
     * @param array $params
     *
     * @return array
     */
    public function getInteralTraffic(array $params): array;
}
