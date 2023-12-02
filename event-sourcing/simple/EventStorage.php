<?php

declare(strict_types=1);

use Events\EventInterface;

require_once __DIR__.'/Events/EventInterface.php';

final class EventStorage
{
    private const LOG_FILE_NAME = 'event_storage.log';

    public function log(EventInterface $event)
    {
        file_put_contents(self::LOG_FILE_NAME, $event."\n", FILE_APPEND);
    }

    public function load()
    {
        $entries = [];

        $handle = fopen(self::LOG_FILE_NAME, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $entries[] = json_decode($line, true);
            }
        }

        return $entries;
    }

    public function loadAccount(string $account)
    {
        $data = $this->load();
        $accountData = [];

        foreach ($data as $item) {
            if ($item['account'] === $account) {
                $accountData[] = $item;
            }
        }

        return $accountData;
    }
}
