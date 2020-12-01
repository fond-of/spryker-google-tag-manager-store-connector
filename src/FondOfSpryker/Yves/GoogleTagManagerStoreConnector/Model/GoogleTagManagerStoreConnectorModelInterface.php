<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model;

interface GoogleTagManagerStoreConnectorModelInterface
{
    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function getCurrency(string $page, array $twigVariableBag, array $variableList): array;

    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function getStoreName(string $page, array $twigVariableBag, array $variableList): array;

    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function getInteralTraffic(string $page, array $twigVariableBag, array $variableList): array;
}
