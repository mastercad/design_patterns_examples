<?php

declare(strict_types=1);

require_once __DIR__.'/EventStorage.php';
require_once __DIR__.'/EventHandler.php';
require_once __DIR__.'/Commands/Deposit.php';
require_once __DIR__.'/Commands/Payoff.php';
require_once __DIR__.'/Commands/ShowAccountBalance.php';

use Commands\Deposit;
use Commands\Payoff;
use Commands\ShowAccountBalance;

$eventStorage = new EventStorage();
$eventHandler = new EventHandler($eventStorage);
$depositCommand = new Deposit($eventHandler);
$payOffCommand = new Payoff($eventHandler);

$depositCommand->execute('#122453123', 100.00);

$payOffCommand->execute('#122453123', 32.12);

echo "Current Balance of existing Account #122453123:\n";

$showAccountBalanceCommand = new ShowAccountBalance($eventStorage);
$balance = $showAccountBalanceCommand->execute('#122453123');

echo $balance."\n";

echo "Current Balance of not existing Account #5422123412:\n";

$balance = $showAccountBalanceCommand->execute('#5422123412');

echo $balance."\n";
