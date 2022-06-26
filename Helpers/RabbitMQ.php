<?php
namespace Rubenromao\ErpApiRequests\Helpers;

use Magento\Amqp\Setup\ConfigOptionsList;
use Magento\Framework\Amqp\Config;
use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\RuntimeException;

class RabbitMQ
{
    /**
     * @var DeploymentConfig
     */
    private $deploymentConfig;

    /**
     * @param DeploymentConfig $deploymentConfig
     */
    public function __construct(
        DeploymentConfig $deploymentConfig
    ) {
        $this->deploymentConfig = $deploymentConfig;
    }

    /**
     * Return boolean on whether Queue config exists
     *
     * @return bool
     * @throws FileSystemException
     * @throws RuntimeException
     */
    public function isAmqpConfigured(): bool
    {
        $config = $this->deploymentConfig
            ->getConfigData(Config::AMQP_CONFIG);
        return $config != null;
    }
}
