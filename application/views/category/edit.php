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
              <form class="form-horizontal" action="save" method="post" enctype="multipart/form-data">
                <!-- 原objectId值，用于保存 -->
                <input type="hidden" name="editingId" value="<?=$categorys->get('objectId')?>" id="objectId" />
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">标题</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" id="title" placeholder="请输入分类的标题" value="<?=$categorys->get('mc');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">父类</label>
                  <div class="col-sm-8">
                    <select class="form-control select2" style="width: 100%;" name="category" id="category">
                      <option value="">顶级分类</option>
                      <?php foreach ($categories as $category):?>
                        <option <?=$category->get('id') == $categorys->get('id') ? 'selected' : '' ?> value="<?=$category->get('objectId')?>">|--<?=$category->get('mc')?></option>
                        <?php foreach ($category->children as $child):?>
                        <option <?=$child->get('id') == $categorys->get('id') ? 'selected' : '' ?> value="<?=$child->get('objectId')?>">|--|--<?=$child->get('mc')?></option>
                        <?php endforeach;?>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="index" class="col-sm-2 control-label">唯一ID</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" name="index" id="index" placeholder="最小最靠前"value="<?=$categorys->get('onlyid');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="index" class="col-sm-2 control-label">分类号</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" name="index" id="index" placeholder="最小最靠前"value="<?=$categorys->get('flno');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">分类图</label>
                  <div class="col-sm-8">
                    <?php
                      if ($categorys->get('avatar') != null) {
                        echo '<img class="avatar" src="' . $categorys->get('avatar')->get('url') . '">';
                      }
                    ?>
                    <input type="file" name="avatar" id="avatar">
                  </div>
                </div>
                <div class="form-group">
                  <label for="banner" class="col-sm-2 control-label">横幅图</label>
                  <div class="col-sm-8">
                    <?php
                      if ($categorys->get('banner') != null) {
                        echo '<img class="avatar" src="' . $categorys->get('banner')->get('url') . '">';
                      }
                    ?>
                    <input type="file" name="banner" id="banner">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">保存</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
  </section>
  <!-- /.content -->
</div>
<!-- <script src="/assets/js/category/edit.js"></script> -->
<script type="text/javascript">
  $(function () { 

    var avatar = <?=json_encode($categorys->get('avatar'))?>;//分类图
    var banner = <?=json_encode($categorys->get('banner'))?>;//横幅图

    $('select').select2({
    });
    $('form').submit(function (e) {
      // 渲染回#images控件，用于post传值
      var avatar_control_value = JSON.parse($('#avatar').val());
      var new_avatar = images_control_value.concat(avatar);
      $('#avatar').val(JSON.stringify(new_avatar));

      // 渲染回#detail控件，用于post传值
      var banner_control_value = JSON.parse($('#banner').val());
      var new_banner = detail_control_value.concat(banner);
      $('#banner').val(JSON.stringify(new_banner));

      if ($('#avatar').val() == '') {
        alert('请上传分类图');
        e.preventDefault();
      }
      $.post(
        'save',
        {
          objectId: $('#objectId').val(),
          mc:$("#title").val(),
          category:$("#category").val(),
          onlyid:$("#index").val(),
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