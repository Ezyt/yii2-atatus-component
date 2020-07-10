<?php

declare(strict_types=1);

namespace Ezyt\Yii2Atatus;

use Ezyt\Atatus\Service;
use yii\base\ActionEvent;

abstract class Handler
{
    use IgnoreTrait;

    protected $atatus;

    public function __construct(Service $atatus, array $ignoreList)
    {
        $this->atatus = $atatus;
        $this->ignoreList = $ignoreList;
    }

    abstract public function handleBeforeRequest();

    public function handleBeforeAction(ActionEvent $event)
    {
        $uniqueId = $event->action->getUniqueId();
        if ($this->isIgnore($uniqueId)) {
            $this->atatus->ignoreTransaction();
        } else {
            $this->atatus->setTransactionName($uniqueId);
        }
    }

    public function handleAfterRequest()
    {
        $this->atatus->endTransaction();
    }
}
