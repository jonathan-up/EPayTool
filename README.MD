## EPay Tool
### 简介
功能很简单，就只有订单和余额明细的Excel表格导出。  
基于PHP73环境开发，这个版本随手写的，有些地方可能不完善
### 安装说明
没有一气呵成的安装向导，因为没有必要，这套程序使用易支付的数据库，只需要简单的配置一下连接数据库就可以了。  

修改web/core/common.php

```php
$database = new Medoo([
        'database_type' => 'mysql',
        'server' => 'localhost',
        'port' => '3306',
        'database_name' => '',    //数据库
        'username' => '',    //用户名
        'password' => '',    //密码
        'charset' => 'utf8',
        'prefix' => 'pay_'
    ]);
```

完事后就可以使用了

~~再无乔纳森 <77266837@qq.com>~~