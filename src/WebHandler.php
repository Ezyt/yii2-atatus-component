<?php

declare(strict_types=1);

namespace Ezyt\Yii2Atatus;

use Yii;

class WebHandler extends Handler
{
    public function handleBeforeRequest()
    {
        $this->atatus->setTransactionName($_SERVER['REQUEST_URI']);
        $this->atatus->addCustomData('method', $_SERVER['REQUEST_METHOD']);
        foreach (Yii::$app->request->getQueryParams() as $key => $param) {
            $this->atatus->addCustomData($key, $param);
        }
    }
}
