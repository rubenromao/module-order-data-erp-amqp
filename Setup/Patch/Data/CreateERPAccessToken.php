<?php
/**
 * @package Rubenromao_TestlpwOrderDataAmq
 * @author rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Integration\Api\IntegrationServiceInterface;
use Magento\Integration\Api\OauthServiceInterface;
use Magento\Integration\Model\ConfigBasedIntegrationManager;
use Magento\Integration\Model\Integration as IntegrationModel;

/**
 * Create integration token for the ERP
 */
class CreateERPAccessToken implements DataPatchInterface
{
    const ERP_INTEGRATION_NAME = 'ERPIntegration';

    /**
     * @var ConfigBasedIntegrationManager
     */
    private $integrationManager;
    /**
     * @var IntegrationServiceInterface
     */
    private $integrationService;
    /**
     * @var OauthServiceInterface
     */
    private $oauthService;

    /**
     * CreateERPAccessToken constructor
     *
     * @param ConfigBasedIntegrationManager $integrationManager
     * @param IntegrationServiceInterface $integrationService
     * @param OauthServiceInterface $oauthService
     */
    public function __construct(
        ConfigBasedIntegrationManager $integrationManager,
        IntegrationServiceInterface $integrationService,
        OauthServiceInterface $oauthService
    ) {
        $this->integrationManager = $integrationManager;
        $this->integrationService = $integrationService;
        $this->oauthService = $oauthService;
    }

    /**
     * @throws \Exception
     */
    public function apply()
    {
        $this->integrationManager->processIntegrationConfig([self::ERP_INTEGRATION_NAME]);
        $integration = $this->integrationService->findByName(self::ERP_INTEGRATION_NAME);
        $this->oauthService->createAccessToken(
            $integration->getConsumerId()
        );
        $integration->setStatus(
            IntegrationModel::STATUS_ACTIVE
        )->save();
    }

    /**
     * {@inheritDoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}
