<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use Codeception\Test\Unit;

class GoogleTagManagerStoreConnectorConfigTest extends Unit
{
    /**
     * @var GoogleTagManagerStoreConnectorConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->config = new GoogleTagManagerStoreConnectorConfig();
    }

    /**
     * @return void
     */
    public function testGetInternalIps(): void
    {
        $this->assertIsArray($this->config->getInternalIps());
    }
}
