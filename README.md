## 必須
- xdebug

## セットアップ方法

1. composer.pharのインストール
    -  https://getcomposer.org/download/
1. `apt install -y git vim`
1. start.phpを設定
    1. php.ini
        - auto_prepend_file=/path/to/start.php
    1. apache
        - php_value auto_prepend_file "/path/to/start.php"
    1. nginx
        - fastcgi_param PHP_VALUE "auto_prepend_file=\"/path/to/start.php\"";
1. `php composer.phar  require phpunit/php-code-coverage`

## 利用方法
1. e2e, unittest, etc.. を実行
1. aggregate.phpの`/path/to/your/project/src`を設定
1. `php aggregate.php`

## 参考
- https://blog.freedom-man.com/e2e_coverage
- https://tech.yappli.io/entry/yappli_php_test
