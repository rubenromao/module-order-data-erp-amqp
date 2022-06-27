<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Console\Command;

use Magento\Framework\Exception\InputException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * TODO: diz is only a skeleton
 */
class ListErpApiCalls extends Command
{
    const PASS = 'pass';
    const FAIL = 'fail';

    /**
     * Order Status constructor
     *
     * @param null $order
     */
    public function __construct(
        $order = null
    ) {
        parent::__construct($order);
    }

    /**
     * @return void
     */
    public function configure()
    {
        $arguments = $this->getArgs();
        $this->setName('erp:show')
            ->setDescription('List 10 last Order Sent To ERP')
            ->setDefinition($arguments);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        try {
            $listType = $this->getType($input);
            $data = $this->erpFactory->create();
            $data->getData();
            if ($listType === self::PASS) {
                $orderStatus = $this->erpCollection->getData('code', '200');
            } else {
                $orderStatus = $this->erpCollection->getData('code', '');
            }
        } catch (InputException $e) {
            $output->writeln("Error: " . $e->getMessage());
            return;
        }
    }

    /**
     * @param InputInterface $input
     * @return void
     */
    private function getType(InputInterface $input)
    {
    }

    /**
     * @return array
     */
    private function getArgs()
    {
        $args   = [];
        $args[] = new InputOption(
            self::PASS,
            null,
            InputOption::VALUE_REQUIRED,
            'The http response code must be specified'
        );

        return $args;
    }
}
