<!--引入CSS-->
<link rel="stylesheet" href="/bower_components/AdminLTE/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="/bower_components/AdminLTE/plugins/select2/select2.full.min.js"></script>

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
              <h3 class="box-title">添加</h3>
                <div class="box-tools pull-right">
                <a class="btn btn-sm btn-primary" href="index">返回列表</a>
                </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <form class="form-horizontal" action="save" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">标题</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" id="title" placeholder="请输入分类的标题" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="parentId" class="col-sm-2 control-label">父类</label>
                  <div class="col-sm-8">
                    <select class="form-control select2" style="width: 100%;" name="parentId" id="parentId">
                      <option value="">顶级分类</option>
                      <?php foreach ($categories as $category):?>
                        <option  value="<?=$category->get('objectId')?>">|--<?=$category->get('mc')?></option>
                        <?php foreach ($category->children as $child):?>
                        <option  value="<?=$child->get('objectId')?>">|--|--<?=$child->get('mc')?></option>
                        <?php endforeach;?>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="onlyid" class="col-sm-2 control-label">唯一ID</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="onlyid" id="onlyid" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="flno" class="col-sm-2 control-label">分类号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="flno" id="flno" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">分类图</label>
                  <div class="col-sm-8">
                    <input type="file" name="avatar" id="avatar">
                  </div>
                </div>
                <div class="form-group">
                  <label for="banner" class="col-sm-2 control-label">横幅图</label>
                  <div class="col-sm-8">
                    <input type="file" name="banner" id="banner">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" id="submit" class="btn btn-primary">保存</button>
              </div>
              <!-- /.box-footer -->
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

    $('select').select2({
    });

    var trueAvatar,trueBanner;
    var flag = true;
    $('#submit').click(function (e) {

      var eleavatar = $("#avatar")[0];
      var elebanner = $("#banner")[0];

      var mc = $("#mc").val();
      var onlyid = $("#onlyid").val();
      var flno = $("#flno").val();

      $('#edit-form').bootstrapValidator({
        // live: 'disabled',
        message: '输入不正确',
        feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          mc: {
            validators: {
              notEmpty: {
                message: '标题不能为空'
              }
            }
          },
          onlyid: {
            validators: {
              notEmpty: {
                message: '唯一ID不能为空'
              }
            }
          },
          flno: {
            validators: {
              notEmpty: {
                message: '分类号不能为空'
              }
            }
          }
        }
      });

      // 渲染回#images控件，用于post传值
      if (eleavatar.files.length > 0) {
        var avaFile = eleavatar.files[0];
        var name = avaFile.name;

        var file = new AV.File(name, avaFile);
        file.save().then(function(file) {
          // 文件保存成功
          console.log(file.get('url'));
          $("#iavatar").val(file.get('url'));
          trueAvatar = file.get('url');
        }, function(error) {
          // 异常处理
          console.error(error);
        });
      }else{
        sweetAlert("提示", "请上传描述图", "error");
      }

      if (elebanner.files.length > 0) {
        var banFile = elebanner.files[0];
        var name = banFile.name;

        var file = new AV.File(name, banFile);
        file.save().then(function(file) {
          // 文件保存成功
          console.log(file.get('url'));
          $("#ibanner").val(file.get('url'));
          trueBanner = file.get('url');
        }, function(error) {
          // 异常处理
          console.error(error);
        });
      }else{
        sweetAlert("提示", "请上传横幅图", "error");
      }
      
      console.log('parentId--'+$("#parentId").val()+"--objectId--空"+"--mc--"+$("#mc").val()+
      "--onlyid--"+$("#onlyid").val()+"--flno--"+$("#flno").val()+"--avatar--"+trueAvatar+"--banner--"+trueBanner);
      // return false;
      
      setTimeout(() => {
        $.post(
          'save',
          {
            mc:$("#mc").val(),
            parentId:$("#parentId").val(),
            onlyid:$("#onlyid").val(),
            flno:$("#flno").val(),
            avatar:trueAvatar,
            banner:trueBanner
          },
          function (response) {
            console.log(response);
            sweetAlert("提示", response.message, "success");
          }
        )
      }, 500);
      
    });

		// $(document.body).on('click','.confirm',function(){
		// 	location.reload(true);
		// })
  });
</script>