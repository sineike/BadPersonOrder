badPerson/tp-order
===============

基于tp5.1组件化开发的订单模块，目前正在调试，并不能应用于生产模式中。

 + 订单列表
 + 订单添加
 + 订单修改
 + 订单删除
 + 订单数据库迁移
 
 ## 目录结构
 
 目录结构如下：
 
 ~~~
 vendor  第三方组件根目录目录
 ├─badperson    供应商名称
 │  ├─tp-order      项目名称
 │  │  ├─src            模块函数文件
 │  │  │  ├─command         添加think命令
 │  │  │  │  ├─config.php           添加think命令配置文件
 │  │  │  │  ├─CreateOrder.php      添加think命令文件
 │  │  │  │  ├─migrate.stub         数据库迁移文件
 │  │  │  ├─lib             项目类库
 │  │  │  │  ├─Common.php           公共方法
 │  │  │  │  ├─Model.php            处理数据模型
 │  │  │  │  ├─Validate.php         数据验证类
 │  │  │  ├─OrderApi.php    项目入口文件
 │  │  │  ├─test.php        实例测试类
 │  │  ├─composer.json   composer配置文件
 ~~~
 
 Requirements
 ------------
  - PHP >= 5.6.0
  - ThinkPHP >= 5.1.0
  -  tp数据库迁移组件 [topthink/think-installer](https://packagist.org/packages/topthink/think-migration)
  
 Installation
 ------------
 
 > 首先安装 PHP 5.6+ 和 ThinkPHP 5.1+ ，再安装该组件
 
 ```
 composer require badperson/tp-order
 ```
 > 安装tp数据库迁移组件
 
  ```
  composer require topthink/think-migration
  ```
 > 在项目根目录下执行以下命令(如果出现"CreateOrder"命令代表ok)
 
 ```
   php think
 ```
 > 生成数据库迁移文件到根目录（database/migrations）下
  
 ```
   php think CreateOrder
 ```

 > 迁移数据库
  
 ```
    php think migrate:run
 ```
 安装完成具体使用请参考(test.php)
  