# 十九大网站

- 无特别说明，API返回值及前端传递的值均为json格式



## 配置环境

1. php(ThinkPHP)、mysql、nginx

2. 配置nginx时需要开启对php的path_info支持：

   ```nginx
           location ~ \.php(.*)$ {
               fastcgi_pass 127.0.0.1:9000;
               fastcgi_index index.php;
               fastcgi_split_path_info ^((?U).+\.php)(/?.+)$;
               fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
               fastcgi_param PATH_INFO $fastcgi_path_info;
               fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
               include fastcgi_params;
           }
   ```

3. 后台目录为 项目根目录 ./ 入口文件为 ./public/admin.php
4. 前端目录为 ./public/static 入口文件为 ./public/static/index.html
5. thinkphp框架的权限设置 public 和 runtime文件夹的权限
6. 数据库配置在 ./application/database.php

