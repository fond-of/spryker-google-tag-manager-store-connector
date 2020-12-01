<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Client\Store\StoreClientInterface;

class GoogleTagManagerStoreConnectorToStoreClientBridgeTest extends Unit
{
    /**
     * @return void
     */
    public function testGetCurrentStore(): void
    {
        $storeClientMock = $this->getMockBuilder(StoreClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $storeClientMock->expects($this->once())
            ->method('getCurrentStore')
            ->willReturn($storeTransferMock);

        $bridge = new GoogleTagManagerStoreConnectorToStoreClientBridge($storeClientMock);

        $this->assertInstanceOf(StoreTransfer::class, $bridge->getCurrentStore());
    }
}
