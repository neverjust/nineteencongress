# 十九大网站

- 无特别说明，API返回值及前端传递的值均为json格式

## 状态码

| 状态码 | 解释       |
| ------ | ---------- |
| 0      | 成功       |
| 1      | 缺少参数   |
| 2      | 数据不存在 |



## Artical

> 功能：获取文章信息

#### getArticles

- 获取所有文章的信息

request:

```php
//空
```

return:

```json
{
    'data':[
        {
        'id':int,
        'title':string
        }
        ........
    ],
    'errorCode':int, 
    'errorMsg':string
}
```

#### getArticleDetail

- 获取指定文章的具体信息

request:

```jso
{
    'id':int
}
```

return:

```json
{
    'data':{
        'id':int,
        'title':string
        .......
    },
    'errorCode':int, 
    'errorMsg':string
}
```



## Video

> 功能：获取视频信息

#### getVideos

- 获取所有文章的信息

request:

```php
//空
```

return:

```json
{
    'data':[
        {
        'id':int,
        'title':string,
        'author':string,
        'institude':string,
        'pic_path':string
        }
        ......
    ],
    'errorCode':int, 
    'errorMsg':string
}
```

#### getArticleDetail

- 获取指定文章的具体信息

request:

```jso
{
    'id':int
}
```

return:

```json
{
    'data':{
        'id':int,
        'title':string,
        'author':string,
        'institude':string,
        'pic_path':string,
        'video_path':string
    },
    'errorCode':int, 
    'errorMsg':string
}
```



## Pic

> 功能：获取图片

#### getPictures

- 获取最后四张图片的信息

request:

```php
//空
```

return:

```json
{
    'data':[
        {
        'id':int,
        'image':string,
        }
        ......
    ],
    'errorCode':int, 
    'errorMsg':string
}
```

