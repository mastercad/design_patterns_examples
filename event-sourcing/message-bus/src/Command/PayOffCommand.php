<?php

namespace App\Command;

use App\Events\PaidOut;
use App\Command\EventCommand;
use App\Services\NumberFormatter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:pay-off',
    description: 'Pays an amount from an account',
)]
class PayOffCommand extends EventCommand
{
    protected function configure(): void
    {
        $this
            ->addOption('account', '-ac', InputOption::VALUE_REQUIRED, 'Account Number ')
            ->addOption('amount', '-am', InputOption::VALUE_REQUIRED, 'Amount of the process')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $account = $input->getOption('account');
        $amount = (float) $input->getOption('amount');

        if (empty($account)) {
            $io->error('Wrong value for Account number');
        }

        $this->trigger(new PaidOut($account, $amount));

        $io->success(NumberFormatter::format($amount).'€ were successfully paid out.');

        return Command::SUCCESS;
    }
}
