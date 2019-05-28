<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Video extends Backend
{
    
    /**
     * Video模型对象
     * @var \app\admin\model\Video
     */
    protected $model = null;
    protected $noNeedLogin = ['test','getVideoDetail',"institudes",'getVideos'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Video;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    public function getVideoDetail()
    {
        $id = $_POST['id'];
        if (!isset($_POST['id'])) {
            return msg("",1,"无参数");
        }
        $data = Db::table('fa_video')->find($id);
        if (!$data) {
            return msg("",2,"查无此数据");
        }
        return msg($data,0,"");
    }

    public function getVideos()
    {
        $data = Db::table('fa_video')->field(['id','title','author','institude','pic_path'])->select();
        return msg($data,0,"");
    }


    public function institudes()
    {
            $arrays = ["信息与通信工程学院","电子科学与工程学院","材料与能源学院","机械与电气工程学院","光电科学与工程学院","自动化工程学院","资源与环境学院","计算机科学与工程学院","信息与软件工程学院","航空航天学院","数学科学学院","物理学院","医学院","生命科学与技术学院","经济与管理学院","公共管理学院","外国语学院","马克思主义学院","格拉斯哥学院","体育部","英才实验学院"];
            for ($i=1; $i <= 21; $i++) { 
                $list[] = [
                    'id' => $i,
                    'institude' => $arrays[$i-1]
                ];
            }
            $result = array("total" => 1, "rows" => $list);
            return json($result);

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

                    $data['title'] = $params['title'];
                    $data['video_path'] = $params['videofile'];
                    $data['pic_path'] = ".".str_replace('.mp4','.jpg',$params['videofile']);
                    #$absolute_video_path = ROOT_PATH."public".$data['video_path'];
                    #$absolute_pic_path = ROOT_PATH."public".$data['pic_path'];
                    $title = $params['title'];
                    $author = $params['author'];
                    $arrays = ["学工部","信息与通信工程学院","电子科学与工程学院","材料与能源学院","机械与电气工程学院","光电科学与工程学院","自动化工程学院","资源与环境学院","计算机科学与工程学院","信息与软件工程学院","航空航天学院","数学科学学院","物理学院","医学院","生命科学与技术学院","经济与管理学院","公共管理学院","外国语学院","马克思主义学院","格拉斯哥学院","体育部","英才实验学院"];
                    $institude = $arrays[$params['institude']-1];
                    $data['author'] = $author;
                    $data['institude'] = $institude;
                    $image = \think\Image::open('./uploads/base.jpg');
                    $image->text("$title",'simple.ttf',100,'#DC143C',2,350);
                    $image->text("$author",'simple.ttf',50,'#DC143C',2,550);
                    $image->text("$institude",'simple.ttf',40,'#DC143C',2,650)->save($data['pic_path']);
                    $result = $this->model->allowField(true)->save($data);
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
