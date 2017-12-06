Log for Humans for Yii2
=======================
人类能看得懂的操作日志

[![Latest Stable Version](https://poser.pugx.org/yiier/yii2-yii2-humans-log/v/stable)](https://packagist.org/packages/yiier/yii2-yii2-humans-log) 
[![Total Downloads](https://poser.pugx.org/yiier/yii2-yii2-humans-log/downloads)](https://packagist.org/packages/yiier/yii2-yii2-humans-log) 
[![Latest Unstable Version](https://poser.pugx.org/yiier/yii2-yii2-humans-log/v/unstable)](https://packagist.org/packages/yiier/yii2-yii2-humans-log) 
[![License](https://poser.pugx.org/yiier/yii2-yii2-humans-log/license)](https://packagist.org/packages/yiier/yii2-yii2-humans-log)


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

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    'modules' => [
        'humans-log' => [
            'class' => 'yiier\humansLog\Module',
        ],
    ],
];

```

You can then access Merit Module through the following URL:

```
http://localhost/path/to/index.php?r=humans-log/h-log
http://localhost/path/to/index.php?r=humans-log/h-log-template
```


