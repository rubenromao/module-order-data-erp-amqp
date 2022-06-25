<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Console\Command;

use Magento\Framework\Exception\InputException;
use Magento\Sales\Model\ResourceModel\Status\Collection;
use Magento\Sales\Model\Order\StatusFactory;
use Magento\Framework\App\State;
use Magento\Framework\App\Area;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class ListErpApiCalls extends Command
{
    const LOCALE = 'locale';
    const RESET = 'reset';
    /**
     * @var Collection
     */
    private $orderStatusCollection;
    /**
     * @var StatusFactory
     */
    private $statusFactory;
    /**
     * @var State
     */
    private $state;

    /**
     * Order Status constructor
     *
     * @param Collection    $orderStatusCollection
     * @param StatusFactory $statusFactory
     * @param State         $state
     * @param null          $orderStatus
     */
    public function __construct(
        Collection $orderStatusCollection,
        StatusFactory $statusFactory,
        State $state,
        $orderStatus = null
    ) {
        parent::__construct($orderStatus);
        $this->orderStatusCollection = $orderStatusCollection;
        $this->statusFactory = $statusFactory;
        $this->state = $state;
    }

    /**
     * Command example: php bin/magento rezolve:translate:orderstatus --locale="en_US"
     *
     * @api
     */
    public function configure()
    {
        $arguments = $this->getArgs();

        $this->setName('rezolve:translate:orderstatus')
            ->setDescription('Translates Order Statuses To a Given Locale When Deploy Runs (Part of Ansible Playbook)')
            ->setDefinition($arguments);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->state->setAreaCode(Area::AREA_GLOBAL);

            $locale = $this->getLocale($input);

            $status = $this->statusFactory->create();
            $status->getData();

            /**
             * By passing "reset" as locale parameter value (i.e. --locale="reset") allow us to reset the
             * sales_order_status table from a previous translation to the Magento default en_US labels
             */
            if ($locale === self::RESET) {
                $orderStatuses = '';
            } else {
                $orderStatuses = $this->orderStatusCollection->getData();
            }

            foreach ($orderStatuses as $orderStatus) {
                if ($locale !== self::RESET) {
                    $orderStatus['label'] = '';
                }
                $status->setStatus($orderStatus['status']);
                $status->setLabel($orderStatus['label']);
                $status->save();
            }
        } catch (InputException $e) {
            $output->writeln("Error Translating Order Statuses: " . $e->getMessage());

            return;
        }
        $output->writeln('Order Statuses have been translated successfully');
    }

    /**
     * @param InputInterface $input
     *
     * @return bool|mixed|string|string[]|null
     * @throws InputException
     */
    private function getLocale(InputInterface $input)
    {
        $locale = $input->getOption(self::LOCALE);
        if (null === $locale) {
            throw InputException::requiredField(self::LOCALE);
        }

        return $locale;
    }

    /**
     * @return array
     */
    private function getArgs()
    {
        $args   = [];
        $args[] = new InputOption(
            self::LOCALE,
            null,
            InputOption::VALUE_REQUIRED,
            'The locale to be used to translate the order statuses'
        );

        return $args;
    }
}
