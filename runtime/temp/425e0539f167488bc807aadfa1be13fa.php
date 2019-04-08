<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:105:"/Applications/XAMPP/xamppfiles/htdocs/dashboard/fastadmin/public/../application/admin/view/video/add.html";i:1548345705;s:100:"/Applications/XAMPP/xamppfiles/htdocs/dashboard/fastadmin/application/admin/view/layout/default.html";i:1547349022;s:97:"/Applications/XAMPP/xamppfiles/htdocs/dashboard/fastadmin/application/admin/view/common/meta.html";i:1547349022;s:99:"/Applications/XAMPP/xamppfiles/htdocs/dashboard/fastadmin/application/admin/view/common/script.html";i:1547349022;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/dashboard/fastadmin/public/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/dashboard/fastadmin/public/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/dashboard/fastadmin/public/assets/js/html5shiv.js"></script>
  <script src="/dashboard/fastadmin/public/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">


    <div class="form-group">
    <label for="c-avatar" class="control-label col-xs-12 col-sm-2">头像:</label>
    <div class="col-xs-12 col-sm-8">
        <div class="input-group">
            <input id="c-avatar" data-rule="" class="form-control" size="50" name="row[avatar]" type="text" value="<?php echo $row['avatar']; ?>">
            <div class="input-group-addon no-border no-padding">
                <span><button type="button" id="plupload-avatar" class="btn btn-danger plupload" data-input-id="c-avatar" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-avatar"><i class="fa fa-upload"></i> 上传</button></span>
                <span><button type="button" id="fachoose-avatar" class="btn btn-primary fachoose" data-input-id="c-avatar" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> 选择</button></span>
            </div>
            <span class="msg-box n-right" for="c-avatar"></span>
        </div>
        <ul class="row list-inline plupload-preview" id="p-avatar"></ul>
    </div>
</div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/dashboard/fastadmin/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/dashboard/fastadmin/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>