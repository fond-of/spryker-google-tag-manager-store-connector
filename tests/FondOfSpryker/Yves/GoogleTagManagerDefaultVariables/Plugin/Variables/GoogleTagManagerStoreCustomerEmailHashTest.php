<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Plugin\Variables;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\GoogleTagManagerStoreConnectorModelInterface;

class GoogleTagManagerStoreCustomerEmailHashTest extends Unit
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
            ->method('getEmailHash')
            ->willReturn([]);

        $googleTagManagerStoreCustomerEmailHashPlugin = new GoogleTagManagerStoreCustomerEmailHash();
        $googleTagManagerStoreCustomerEmailHashPlugin->setFactory($factoryMock);

        $this->assertIsArray($googleTagManagerStoreCustomerEmailHashPlugin->addVariable('pageType', []));
    }
}
