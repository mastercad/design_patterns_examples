<?php

namespace App\Command;

use App\Events\ChargedBack;
use App\Command\EventCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:charge-back',
    description: 'Add a short description for your command',
)]
class ChargeBackCommand extends EventCommand
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

        $this->trigger(new ChargedBack($account, $amount));

        $io->success($amount.'€ were successfully paid back.');

        return Command::SUCCESS;
    }
}
