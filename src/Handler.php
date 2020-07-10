<?php

declare(strict_types=1);

namespace Ezyt\Yii2Atatus;

use Ezyt\Atatus\Service;
use Yii;
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

    public function handleBeforeRequest()
    {
        $this->atatus->setTransactionName(Yii::$app->request->url);
        $this->atatus->addCustomData('method', Yii::$app->request->method);
    }

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
