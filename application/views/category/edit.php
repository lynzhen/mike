<!--引入CSS-->
<link rel="stylesheet" href="/bower_components/AdminLTE/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="/bower_components/AdminLTE/plugins/select2/select2.full.min.js"></script>
<!-- sweet alet -->
<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<link href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
<style type="text/css">
  .avatar {
    width: 100px;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="../dashboard/index"><i class="fa fa-dashboard"></i> 首页</a></li>
      <li class="active">分类管理</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">修改</h3>
                <div class="box-tools pull-right">
                <a class="btn btn-sm btn-primary" href="index">返回列表</a>
                </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <form class="form-horizontal"  enctype="multipart/form-data">
              <!-- <div class="form-horizontal"> -->
                <!-- 原objectId值，用于保存 -->
                <input type="hidden" name="objectId" value="<?=$categorys->get('objectId')?>" id="objectId" />
                <div class="form-group">
                  <label for="mc" class="col-sm-2 control-label">标题</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="mc" id="mc" placeholder="请输入分类的标题" value="<?=$categorys->get('mc');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="parentId" class="col-sm-2 control-label">父类</label>
                  <div class="col-sm-8">
                    <select class="form-control select2" style="width: 100%;" name="parentId" id="parentId">
                      <option value="">顶级分类</option>
                      <?php foreach ($categories as $category):?>
                        <option <?=$category->get('id') == $categorys->get('fid') ? 'selected' : '' ?> value="<?=$category->get('objectId')?>">|--<?=$category->get('mc')?></option>
                        <?php foreach ($category->children as $child):?>
                        <option <?=$child->get('id') == $categorys->get('fid') ? 'selected' : '' ?> value="<?=$child->get('objectId')?>">|--|--<?=$child->get('mc')?></option>
                        <?php endforeach;?>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="onlyid" class="col-sm-2 control-label">唯一ID</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" name="onlyid" id="onlyid" placeholder="最小最靠前" value="<?=$categorys->get('onlyid');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="flno" class="col-sm-2 control-label">分类号</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" name="flno" id="flno" value="<?=$categorys->get('flno');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">分类图</label>
                  <div class="col-sm-8">
                    <?php
                      if ($categorys->get('avatar') != null) {
                        echo '<img class="avatar" src="' . $categorys->get('avatar').'">';
                      }
                    ?>
                    <input type="file" name="avatar" id="avatar" value="">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="banner" class="col-sm-2 control-label">横幅图</label>
                  <div class="col-sm-8">
                    <?php
                      if ($categorys->get('banner') != null) {
                        echo '<img class="avatar" src="' . $categorys->get('banner').'">';
                      }
                    ?>
                    <input type="file" name="banner" id="banner" value="">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" id="submit" class="btn btn-primary">保存</button>
              </div>
              <!-- /.box-footer -->
            <!-- </div> -->
            </form>
          </div>
  </section>
  <!-- /.content -->
</div>
<script src="/assets/js/category/edit.js"></script>
<script src='/assets/js/category/av-weapp-min.js'></script>
<script type="text/javascript">
  const appId = "xim8nwfJmEWgWrarLzhh4DYe-gzGzoHsz";
  const appKey = "RSxqmzUqDiBT2LamDvKhLwgB";

  AV.init({
    appId: appId,
    appKey: appKey
  });

  $(function () { 

    // var avatar = <?=json_encode($categorys->get('avatar'))?>;//分类图
    // var banner = <?=json_encode($categorys->get('banner'))?>;//横幅图

      var avatar = $('#avatar')[0];
      var banner = $('#banner')[0];

    $('select').select2({
    });
    $('#submit').click(function (e) {
      // 渲染回#images控件，用于post传值
      if (avatar.files.length > 0) {
        var localFile = avatar.files[0];
        var name = localFile.name;

        var file = new AV.File(name, localFile);
        file.save().then(function(file) {
          // 文件保存成功
          console.log(file.get('url'));
          $("#avatar").val(file.get('url'));
        }, function(error) {
          // 异常处理
          console.error(error);
        });
      }else{
        sweetAlert("提示", "请上传描述图", "error");
      }

      if (banner.files.length > 0) {
        var localFile = banner.files[0];
        var name = localFile.name;

        var file = new AV.File(name, localFile);
        file.save().then(function(file) {
          // 文件保存成功
          console.log(file.get('url'));
          $("#banner").val(file.get('url'));
        }, function(error) {
          // 异常处理
          console.error(error);
        });
      }else{
        sweetAlert("提示", "请上传横幅图", "error");
      }
      
      console.log('parentId'+$("#parentId").val()+"objectId"+$('#objectId').val()+"mc"+$("#mc").val()+"onlyid"+$("#onlyid").val()+"flno"+$("#flno").val());
      // return false;
      $.post(
        'save',
        {
          objectId: $('#objectId').val(),
          mc:$("#mc").val(),
          parentId:$("#parentId").val(),
          onlyid:$("#onlyid").val(),
          flno:$("#flno").val(),
          banner:$("#banner").val(),
          avatar:$("#avatar").val()
        },
        function (response) {
          console.log(response);
          // sweetAlert("提示", response.message, "success");
        }
      )
      
    });

		$(document.body).on('click','.confirm',function(){
			location.reload(true);
		})
  });
</script>