<?php

declare(strict_types=1);

namespace Ezyt\Yii2Atatus;

class ConsoleHandler extends Handler
{
    const CLI_HELP = 'help/index';

    public function handleBeforeRequest()
    {
        $this->atatus->setTransactionName($_SERVER["argv"][1] ?? self::CLI_HELP);
    }
}
