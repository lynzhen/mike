
  <link rel="stylesheet" href="/assets/css/global.css">
  <!-- jQuery 2.2.3 -->
  <script src="https://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- 表单验证 -->
<script src="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/js/language/zh_CN.min.js"></script>
<link href="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.css" rel="stylesheet">
<!-- sweet alet -->
<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<link href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
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
                <a class="btn btn-sm btn-primary" href="banner">返回列表</a>
                </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <form id="edit-form" class="form-horizontal"  enctype="multipart/form-data">
              <!-- <div class="form-horizontal"> -->
                <!-- 原objectId值，用于保存 -->
                <input type="hidden" name="objectId" value="<?=$banner->get('objectId')?>" id="objectId" />
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">标题</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" id="title" placeholder="请输入分类的标题" value="<?=$banner->get('title');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="paixu" class="col-sm-2 control-label">排序</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="paixu" id="paixu" value="<?=$banner->get('paixu');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">图片</label>
                  <style>
                    .avatar{
                      width:300px;
                    }
                  </style>
                  <div class="col-sm-8">
                    <img class="avatar" src="<?=$banner->get('avatar');?>">
                    
                    <input type="file" name="avatar" id="avatar" value="">
                    <input type="hidden" name="iavatar" id="iavatar" value="">
                    
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

    //获取数据库里原有的
     var avatar = <?=json_encode($categorys->get('avatar'))?>;//分类图

      //赋值到 hidden input 里
      $("#iavatar").val(avatar);


    var trueAvatar;
    var flag = true;
    $('#submit').click(function (e) {
      
      //重新取出
      var avatarVal = $('#iavatar').val();

      var eleavatar = $("#avatar")[0];

      var title = $("#mc").val();
      var paixu = $("#onlyid").val();

      $('#edit-form').bootstrapValidator({
        // live: 'disabled',
        message: '输入不正确',
        feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          title: {
            validators: {
              notEmpty: {
                message: '标题不能为空'
              }
            }
          },
          paixu: {
            validators: {
              notEmpty: {
                message: '排序不能为空'
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
      }else if(avatarVal != ""){
        trueAvatar = avatarVal;
        console.log(trueAvatar);
      }else{
        sweetAlert("提示", "请上传描述图", "error");
      }
      
      setTimeout(() => {

      console.log('title--'+$("#title").val()+"--objectId--"+$('#objectId').val()+"--paixu--"+$("#paixu").val()+
      "--avatar--"+trueAvatar);
      // return false;

        $.post(
          'save',
          {
            objectId: $('#objectId').val(),
            title:$("#title").val(),
            paixu:$("#paixu").val(),
            avatar:trueAvatar,
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