<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Plugin\DataLayer;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\GoogleTagManagerStoreConnectorModelInterface;

class GoogleTagManagerStoreCurrencyPluginTest extends Unit
{
    /**
     * @return void
     */
    public function testExpand(): void
    {
        $factoryMock = $this->getMockBuilder(GoogleTagManagerStoreConnectorFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $googleTagManagerStoreConnectorModel = $this->getMockBuilder(GoogleTagManagerStoreConnectorModelInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factoryMock->expects($this->once())
            ->method('createGoogleTagManagerStoreConnectorModel')
            ->willReturn($googleTagManagerStoreConnectorModel);

        $googleTagManagerStoreConnectorModel->expects($this->once())
            ->method('getCurrency')
            ->willReturn([]);

        $googleTagManagerStoreCurrencyPlugin = new StoreCurrencyDataLayerExpanderPlugin();
        $googleTagManagerStoreCurrencyPlugin->setFactory($factoryMock);

        $this->assertIsArray($googleTagManagerStoreCurrencyPlugin->expand('pageType', [], []));
    }
}
