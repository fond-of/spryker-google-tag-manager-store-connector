<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander;

interface StoreDataLayerExpanderInterface
{
    /**
     * @param string $page
     * @param array $twigVariableBag
     * @param array $variableList
     *
     * @return array
     */
    public function expand(string $page, array $twigVariableBag, array $variableList): array;
}
