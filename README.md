Log for Humans for Yii2
=======================
人类能看得懂的操作日志

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
```

