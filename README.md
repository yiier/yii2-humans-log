Log for Humans for Yii2
=======================
人类能看得懂的操作日志

[![Latest Stable Version](https://poser.pugx.org/yiier/yii2-humans-log/v/stable)](https://packagist.org/packages/yiier/yii2-humans-log) 
[![Total Downloads](https://poser.pugx.org/yiier/yii2-humans-log/downloads)](https://packagist.org/packages/yiier/yii2-humans-log) 
[![Latest Unstable Version](https://poser.pugx.org/yiier/yii2-humans-log/v/unstable)](https://packagist.org/packages/yiier/yii2-humans-log) 
[![License](https://poser.pugx.org/yiier/yii2-humans-log/license)](https://packagist.org/packages/yiier/yii2-humans-log)


Description
------
 
- 此扩展只要你按照约定的规则，可以帮你记录操作日志。
- 只能监控单条数据，所以不适用于需要操作多条数据。
- 无法做到颗粒度很细的日志，比方说你要记录谁操作了订单的状态，此扩展是无法做到的，你只能记录谁操作了订单，也只能记录订单的最新状态，操作之前的状态无法记录。
- 有特殊情况的话，可以使用 `yiier\humansLog\models\HLog::saveLog()` 方法单独记录日志。
- 模板使用说明可以看截图，也可以看 `src\views\h-log-template\_form.php` 文件。

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiier/yii2-humans-log "*"
```

or add

```
"yiier/yii2-humans-log": "*"
```

to the require section of your `composer.json` file.


Migrations
----------

Run the following command

```
php yii migrate --migrationPath=@yiier/humansLog/migrations/
```

Usage
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    'modules' => [
        'humans-log' => [
            'class' => 'yiier\humansLog\Module',
            // 'mainLayout' => '@app/views/layout/hlog.php',
            // 'safeDelete' => false
        ],
    ],
];

```

### Method One (方式一，推荐)

you need to include it in config in bootstrap section:

```php
return [
    'bootstrap' => [
        'yiier\humansLog\EventBootstrap',
    ],
];
```


### Method Two (方式二)

Configure Controller class as follows :

```php
use use yiier\humansLog\HLogBehavior;

class Controller extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            HLogBehavior::className(),
        ];
    }
}
```

Configure Model class as follows :

```php
use use yiier\humansLog\HLogBehavior;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            HLogBehavior::className(),
        ];
    }
}
```

### Routing

You can then access Merit Module through the following URL:

```
http://localhost/path/to/index.php?r=humans-log/h-log
http://localhost/path/to/index.php?r=humans-log/h-log-template
http://localhost/path/to/index.php?r=humans-log/h-log-template/create
```

Screenshots
----

![create log Template](https://i.loli.net/2017/12/06/5a27e12fcc4a7.png)

![logs](https://i.loli.net/2017/12/06/5a27e1bf18876.png)