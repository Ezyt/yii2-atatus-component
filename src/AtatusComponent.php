<?php

namespace Ezyt\Yii2Atatus;

use Ezyt\Atatus\Service;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\console\Application as ConsoleApplication;
use yii\web\Application as WebApplication;

class AtatusComponent extends Component implements BootstrapInterface
{
    private $atatus;

    public $enabled = true;
    public $ignoreList = [];
    public $webIgnoreList = [];
    public $cliIgnoreList = [];
    public $enabledWebHandler = true;
    public $enabledCliHandler = true;

    public function __construct($config = [])
    {
        $this->atatus = new Service();
        parent::__construct($config);
    }

    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        if ($this->enabled && $this->atatus->isLoaded()) {
            $this->initHandlers($app);
        }
    }

    protected function initHandlers(Application $app)
    {
        if ($this->enabledCliHandler && $app instanceof ConsoleApplication) {
            $this->initConsoleHandler($app);
        }
        if ($this->enabledWebHandler && $app instanceof WebApplication) {
            $this->initWebHandler($app);
        }
    }

    protected function initConsoleHandler(Application $app)
    {
        $handler = new Handler($this->atatus, array_merge($this->ignoreList, $this->cliIgnoreList));
        $app->on(
            $app::EVENT_BEFORE_REQUEST,
            [$handler, 'handleBefore']
        );
        $app->on(
            $app::EVENT_AFTER_REQUEST,
            [$handler, 'handleAfter']
        );
    }

    protected function initWebHandler(Application $app)
    {
        $handler = new Handler($this->atatus, array_merge($this->ignoreList, $this->webIgnoreList));
        $app->on(
            $app::EVENT_BEFORE_REQUEST,
            [$handler, 'handleBefore']
        );
        $app->on(
            $app::EVENT_AFTER_REQUEST,
            [$handler, 'handleAfter']
        );
    }

    public function getAgent(): Service
    {
        return $this->atatus;
    }
}
