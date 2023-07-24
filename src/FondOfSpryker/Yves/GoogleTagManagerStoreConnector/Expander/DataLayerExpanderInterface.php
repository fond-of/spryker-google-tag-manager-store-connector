<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander;

interface DataLayerExpanderInterface
{
    /**
     * @param string $page
     * @param array<string, string> $twigVariableBag
     * @param array<string, string|string> $dataLayer
     *
     * @return array<string, bool|string>
     */
    public function expand(string $page, array $twigVariableBag, array $dataLayer): array;
}
