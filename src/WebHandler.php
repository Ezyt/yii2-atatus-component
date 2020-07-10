<?php

declare(strict_types=1);

namespace Ezyt\Yii2Atatus;

use Yii;

class WebHandler extends Handler
{
    public function handleBeforeRequest()
    {
        parent::handleBeforeRequest();
        foreach (Yii::$app->request->getQueryParams() as $key => $param) {
            $this->atatus->addCustomData($key, $param);
        }
    }
}
