Labuilder
======

### 安装

1. `composer`安装`laravel`框架，完成配置数据库的基本配置

2. 然后安装本扩展`labuilder`

```bash
composer require ichynul/labuilder
```

3. 发布资源

```bash
php artisan vendor:publish --provider="Ichynul\Labuilder\LabuilderServiceProvider"
```

4. 同步数据库

```bash
php artisan migrate:fresh
```

5. 代码
admin模块:示例：`/app/Admin/`目录，
配置：`/config/labuilder.php`。