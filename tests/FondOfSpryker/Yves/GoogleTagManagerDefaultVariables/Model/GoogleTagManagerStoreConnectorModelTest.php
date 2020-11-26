<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConstants;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Store;

class GoogleTagManagerStoreConnectorModelTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AddressTransfer
     */
    protected $addressTransferMock;

    /**
     * @var GoogleTagManagerStoreConnectorModelInterface
     */
    protected $googleTagManagerStoreConnectorModel;

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

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->googleTagManagerStoreConnectorModel = new GoogleTagManagerStoreConnectorModel(
            $this->storeMock,
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testGetCurrency(): void
    {
        $this->storeMock->expects($this->once())
            ->method('getCurrencyIsoCode')
            ->willReturn('EUR');

        $result = $this->googleTagManagerStoreConnectorModel->getCurrency();

        $this->assertIsArray($result);
        $this->assertArrayHasKey(GoogleTagManagerStoreConnectorConstants::FIELD_CURRENCY, $result);
    }

    /**
     * @return void
     */
    public function testGetStoreName(): void
    {
        $this->storeMock->expects($this->once())
            ->method('getStoreName')
            ->willReturn('STORE_NAME');

        $result = $this->googleTagManagerStoreConnectorModel->getStoreName();

        $this->assertIsArray($result);
        $this->assertArrayHasKey(GoogleTagManagerStoreConnectorConstants::FIELD_STORE, $result);
    }

    /**
     * @return void
     */
    public function testGetInteralTraffic()
    {
        $this->configMock->expects($this->once())
            ->method('getInternalIps')
            ->willReturn(['127.0.0.1']);

        $result = $this->googleTagManagerStoreConnectorModel->getInteralTraffic([
            GoogleTagManagerStoreConnectorConstants::PARAM_CLIENT_IP => '127.0.0.1',
        ]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey(GoogleTagManagerStoreConnectorConstants::FIELD_INTERNAL_TRAFFIC, $result);
    }
}
