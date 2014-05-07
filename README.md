QActivityLog
============
Yii Extension to log user that open controller action.

# Installation
Copy all extension files to your extension folder.

# Usage
## config/main

```php

  component => array(
      ...
      'log' => array(
         'class' => 'CLogRouter',
             'routes' => array(         
               ...
               array(
                        'class'=>'ext.activityLog.QDbLogRoute',
                        // table name
                         'logTableName'=>'trn_activity_log',
               
                       // level and category that will used in log message
                       'levels'=>'action',
                       'categories'=>array('Backend'),

                       'connectionID'=>'db',

                       // set true for first installation, 
                       'autoCreateLogTable'=>false,

                       // set true if log message will inserted to table
                       'collectMessage'=>false,
                    ),
            ),
   ),
...
),
```

## controller

Define filter in controller that you want to log user activity.

```php
 public function filters()
    {
      return array(
       //other filter
        ...   
        array('ext.activityLog.QLogFilter','logCategory'=>'Backend','logLevel'=>'action'),
      );
    }
```

Since QLogFilter is extends of CFilter, you can use as contoller filter. Please refer to [documentation](http://www.yiiframework.com/doc/guide/1.1/en/basics.controller#filter).

**Warning!** logCategory and logLevel should be same as in your config

# Resource
* [Github Project](http://www.github.com/luckynvic/QActivityLog)