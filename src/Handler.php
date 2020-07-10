<?php

declare(strict_types=1);

namespace Ezyt\Yii2Atatus;

use Ezyt\Atatus\Service;
use yii\base\ActionEvent;

class Handler
{
    use IgnoreTrait;

    private $atatus;

    public function __construct(Service $atatus, array $ignoreList)
    {
        $this->atatus = $atatus;
        $this->ignoreList = $ignoreList;
    }

    public function handleBefore(ActionEvent $event)
    {
        $uniqueId = $event->action->getUniqueId();
        if ($this->isIgnore($uniqueId)) {
            $this->atatus->ignoreTransaction();
        } else {
            $this->atatus->setTransactionName($uniqueId);
            foreach ($event->action->controller->request->getParams() as $key => $param) {
                $this->atatus->addCustomData($key, $param);
            }
        }
    }

    public function handleAfter(ActionEvent $event)
    {
        $this->atatus->endTransaction();
    }
}
