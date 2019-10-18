<?php
return [
    // 生成应用公共文件
    // '__file__' => ['common.php', 'config.php', 'database.php'],
    // 其他更多的模块定义
    'api' => [
        '__dir__' => ['model','view','controller'],
        'model' => ['index'],
    ],
    // 'admin' => [
    //     '__dir__' => ['model','view','controller'],
    //     'model' => ['test'],
    //     'view' => ['index/index','order/index'],
    ]
];
?>