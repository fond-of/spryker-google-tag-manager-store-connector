<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Plugin\Variables;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\GoogleTagManagerStoreConnectorModelInterface;

class GoogleTagManagerStoreNamePluginTest extends Unit
{
    /**
     * @return void
     */
    public function testAddVariable(): void
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
            ->method('getStoreName')
            ->willReturn([]);

        $googleTagManagerStoreInternalTrafficPlugin = new GoogleTagManagerStoreNamePlugin();
        $googleTagManagerStoreInternalTrafficPlugin->setFactory($factoryMock);

        $this->assertIsArray($googleTagManagerStoreInternalTrafficPlugin->addVariable('pageType', []));
    }
}
