<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Cart\CartClientInterface;

class GoogleTagManagerStoreConnectorToCartClientBridgeTest extends Unit
{
    /**
     * @return void
     */
    public function testGetQuote(): void
    {
        $cartClientMock = $this->getMockBuilder(CartClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cartClientMock->expects($this->once())
            ->method('getQuote')
            ->willReturn($quoteTransferMock);

        $bridge = new GoogleTagManagerStoreConnectorToCartClientBridge($cartClientMock);
        $result = $bridge->getQuote();

        $this->assertInstanceOf(QuoteTransfer::class, $result);
    }
}
