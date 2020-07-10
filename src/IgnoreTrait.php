<?php

declare(strict_types=1);

namespace Ezyt\Yii2Atatus;

trait IgnoreTrait
{
    private $ignoreList;

    protected function isIgnore(string $uniqueId): bool
    {
        if (!empty($this->ignoreList)) {
            foreach ($this->ignoreList as $pattern) {
                if (preg_match('/' . $pattern . '/', $uniqueId)) {
                    return true;
                }
            }
        }
        return false;
    }
}
