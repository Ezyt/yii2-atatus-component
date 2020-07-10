# yii2-atatus-component

For license information check the [LICENSE](LICENSE)-file.

Installation
------------

```
php composer.phar require --prefer-dist ezyt/yii2-atatus-component
```

or add

```json
"ezyt/yii2-atatus-component": "*"
```

to the require section of your composer.json.

Config
-------
```php
[
    'bootstrap' => [
        #...
        'atatus'        
    ],
    'components' => [
        'class'   => \Ezyt\Yii2Atatus\AtatusComponent::class,
    ],
];
```

Example
-------
```php
        #...
        Yii::$app->atatus->getAgent()->setTransactionName();
        #...
```

Documentation for config.
-------------
|Param                |Default|Description                                                                                                   |
|---------------------|-------|--------------------------------------------------------------------------------------------------------------|
| `enabled`           | true  | off component                                                                                                |
| `ignoreList`        | []    | actions for ignore transaction. Example `'controllerName\*'` - all actions in ControllerName will be ignored |
| `webIgnoreList`     | []    | ignoreList only for WebApplication. Merges with `ignoreList`                                                 |
| `cliIgnoreList`     | []    | ignoreList only for ConsoleApplication. Merges with `ignoreList`                                             |
| `enabledWebHandler` | true  | off handler for WebApplication                                                                               |
| `enabledCliHandler` | true  | off handler for ConsoleApplication                                                                           |
