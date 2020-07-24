<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\DiscountCodesService;
use Psr\Log\LoggerInterface;
use App\Service\FileSaver\FileSaverInterface;

/**
 * @author Karol Gancarczyk
 */
class GenerateCodesCommand extends Command {

    private const SUCCESS_MESSAGE = 'Discount codes have been generated and saved into a file: ';
    private const ERROR_MESSAGE = 'Unexpected error occurred while running the application';

    private $discountCodesService;
    private $logger;
    private $fileSaver;
    
    protected static $defaultName = 'app:generate-codes';

    public function __construct(DiscountCodesService $discountCodesService, LoggerInterface $logger, FileSaverInterface $fileSaver) {
        $this->discountCodesService = $discountCodesService;
        $this->logger = $logger;
        $this->fileSaver = $fileSaver;
        parent::__construct();
    }

    protected function configure() {
        $this
            ->setDescription('Dicsount codes generator')
            ->addArgument('numberOfCodes', InputArgument::REQUIRED)
            ->addArgument('lengthOfCode', InputArgument::REQUIRED)
            ->addArgument('file', InputArgument::REQUIRED)            
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        try {
            $io = new SymfonyStyle($input, $output);
            $numberOfCodes = $input->getArgument('numberOfCodes');
            $lengthOfCode = $input->getArgument('lengthOfCode');
            $fileName = $input->getArgument('file');

            $discountCodes = $this->discountCodesService->generateDiscountCodes($numberOfCodes, $lengthOfCode);
            $this->fileSaver->saveDiscountCodes($discountCodes, $fileName);

            $io->success(self::SUCCESS_MESSAGE . $fileName);

            return 0;
        } catch (\InvalidArgumentException $e) {
            $io->error($e->getMessage());
            return -1;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            $this->logger->error($e->getTraceAsString());
            $io->error(SELF::ERROR_MESSAGE);
            return -1;
        }
    }
}
