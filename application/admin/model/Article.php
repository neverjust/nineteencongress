<?php

namespace app\admin\model;

use think\Model;

class Article extends Model
{
    // 表名
    protected $name = 'article';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'create_time_text'
    ];

    public function saveArticle($url)
    {
        $type = $this->getType($url);
        $data = $this->getHtml($url,$type);
        return $data;
    }

    public function getType($url)
    {
        $site = preg_match("/https:\/\/(\S+cn)/", $url,$result);
        if ($site) {
            if ($result[1] == "xgb.uestc.edu.cn") {
                return 2;
            }
            elseif ($result[1] == "news.uestc.edu.cn") {
                return 1;
            }
            else {
                return 0;
            }
        }
        return 0;
    }


    public function getHtml($url,$type)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $html = (string)$response->getBody();
        // var_dump((string)$html);
        // exit();
        if ($type == 1) {
            preg_match("/<!-- 标题 -->([\s\S]*)<\/h1>/",$html,$result);
            $title = $result[1];
            preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$html,$result);
            $date = $result[0];
            preg_match("/<div class=\"Degas_news_content\">((.*?))<\/div>/is",$html,$result);
            $div = $result[1];
            preg_match("/<body>((.*?))<\/body>/is",$div,$result);
            $content = $result[1];
            $web = "https://news.uestc.edu.cn";
            $content = preg_replace("/(src=\")(\/upload\/image\/[a-z0-9]+\.jpg\")/","$1$web$2",$content);
        }
        elseif ($type == 2) {
            preg_match("/<title>((.*?))- Student Affairs Department Of UESTC/",$html,$result);
            $title = ($result[1]);
            preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$html,$result);
            $date = $result[0];
            preg_match("/<div class=\"detail-content\">((.*?))<div class=\"content-footer\">/is",$html,$result);
            $content ="<div>"."\n".$result[1];
            $web = "https://xgb.uestc.edu.cn";
            $content = preg_replace("/(src=\")(\/uploads\/image\/[a-z0-9]+\.jpg\")/","$1$web$2",$content);
        }

        $res = [
            'title'         => $title,
            'date'   => $date,
            'content'       => $content,
            'url'           => $url
        ];

        return $res;
    }
    

    



    public function getCreateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['create_time']) ? $data['create_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setCreateTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


}
