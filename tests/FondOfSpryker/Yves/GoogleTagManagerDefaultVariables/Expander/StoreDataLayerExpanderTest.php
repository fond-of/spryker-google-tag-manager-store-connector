<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig;
use Generated\Shared\Transfer\StoreTransfer;

class StoreDataLayerExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToStoreClientInterface
     */
    protected $storeClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\StoreDataLayerExpanderInterface
     */
    protected $expander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->storeClientMock = $this->getMockBuilder(GoogleTagManagerStoreConnectorToStoreClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(GoogleTagManagerStoreConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new StoreDataLayerExpander($this->storeClientMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->storeClientMock->expects($this->atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects($this->once())
            ->method('getName')
            ->willReturn('STORE_NAME');

        $this->storeTransferMock->expects($this->once())
            ->method('getSelectedCurrencyIsoCode')
            ->willReturn('EUR');

        $this->configMock->expects($this->once())
            ->method('getInternalIps')
            ->willReturn(['127.0.0.1']);

        $variableList = $this->expander->expand('pageType', [], []);

        $this->assertIsArray($variableList);
        $this->arrayHasKey(GoogleTagManagerStoreConnectorConstants::FIELD_CURRENCY, $variableList);
        $this->arrayHasKey(GoogleTagManagerStoreConnectorConstants::FIELD_STORE, $variableList);
        $this->arrayHasKey(GoogleTagManagerStoreConnectorConstants::FIELD_INTERNAL_TRAFFIC, $variableList);
    }
}
