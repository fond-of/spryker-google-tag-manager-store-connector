<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency;

use Generated\Shared\Transfer\QuoteTransfer;

interface GoogleTagManagerStoreConnectorToCartClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getQuote(): QuoteTransfer;
}
