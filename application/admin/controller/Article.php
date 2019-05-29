<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use think\File;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Article extends Backend
{
    
    /**
     * Article模型对象
     * @var \app\admin\model\Article
     */
    protected $model = null;

    protected $noNeedLogin = ['test','getArticleDetail','getArticles'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Article;

    }

    protected function writeFile($name,$content)
    {
        $path = ROOT_PATH."public/articles/".$name;
        $myfile = fopen("$path", "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }

    public function test()
    {
        $article = Db::table('fa_article')->find(25);
        var_dump($article);
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


    public function getArticleDetail()
    {
        $id = $_POST['id'];
        if (!isset($_POST['id'])) {
            return msg("",1,"无参数");
        }
        $data = Db::table('fa_article')->find($id);
        if (!$data) {
            return msg("",2,"查无此数据");
        }
        return msg($data,0,"");
    }
    public function getArticles()
    {
        $data = Db::table('fa_article')->field(['id','title','date'])->select();
        return msg($data,0,"");
    }

    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validate($validate);
                    }


                    $data = $this->model->saveArticle($params['url']);
                    $params['title'] = $data['title'];
                    $params['content'] = $data['content'];
                    $params['date'] = $data['date'];
                    $name = md5(uniqid(microtime(true),true)).".html";
                    $params['article_path'] = "/articles/".$name;
                    $result = $this->model->allowField(true)->save($params);
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error($this->model->getError());
                    }
                } catch (\think\exception\PDOException $e) {
                    $this->error($e->getMessage());
                } catch (\think\Exception $e) {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }


    

}
