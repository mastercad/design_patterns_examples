<?php

namespace App\Command;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\Service\Attribute\Required;

#[AsCommand(
    name: 'app:show-account-balance',
    description: 'Add a short description for your command',
)]
class ShowAccountBalanceCommand extends Command
{
    private EntityManagerInterface $entityManager;

    private float $balance = 0.00;

    protected function configure(): void
    {
        $this
            ->addOption('account', '--ac', InputOption::VALUE_REQUIRED, 'Account Number')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $account = $input->getOption('account');

        if (empty($account)) {
            $io->error('Wrong value for Account number');
        }

#        var_dump($this->entityManager->getRepository(Event::class)->findByAccountORM($account));

        foreach ($this->entityManager->getRepository(Event::class)->findByAccountDBAL($account) as $item) {
            $item['data'] = json_decode($item['data'], true);
            $this->handleEventData($item);
        }

        $io->success('Current Account Amount: '.number_format($this->balance, 2, ',', '.').'.');

        return Command::SUCCESS;
    }

    private function handleEventData(array $eventData)
    {
        switch ($eventData['data']['type']) {
            case 'App\\Events\\PaidIn':
                $this->balance += (float) $eventData['data']['amount'];
                break;
            case 'App\\Events\\PaidOut':
                $this->balance -= (float) $eventData['data']['amount'];
                break;
            case 'App\\Events\\ChargedBack':
                $this->balance += (float) $eventData['data']['amount'];
                break;
        }
    }

    #[Required]
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
