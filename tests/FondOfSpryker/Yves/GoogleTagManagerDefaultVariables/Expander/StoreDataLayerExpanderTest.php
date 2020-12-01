<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig;
use Spryker\Shared\Kernel\Store;

class StoreDataLayerExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Store
     */
    protected $storeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\StoreDataLayerExpanderInterface
     */
    protected $expander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->storeMock = $this->getMockBuilder(Store::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(GoogleTagManagerStoreConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new StoreDataLayerExpander($this->storeMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->storeMock->expects($this->once())
            ->method('getCurrencyIsoCode')
            ->willReturn('EUR');

        $this->storeMock->expects($this->once())
            ->method('getStoreName')
            ->willReturn('STORE_NAME');

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
