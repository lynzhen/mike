<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="/bower_components/fex-webuploader/dist/webuploader.css">
<link rel="stylesheet" type="text/css" href="/assets/css/webuploader.css">
<!--引入JS-->
<script type="text/javascript" src="/bower_components/fex-webuploader/dist/webuploader.js"></script>
<!-- Select2 -->
<link rel="stylesheet" href="/bower_components/AdminLTE/plugins/select2/select2.min.css">
<script src="/bower_components/AdminLTE/plugins/select2/select2.full.min.js"></script>
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
      <li class="active">商品分类管理</li>
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
              <form id="edit-form" class="form-horizontal" action="savecate" method="post">
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">标题</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" id="title" placeholder="" value="<?=$data->get('title')?>">
                  </div>
                </div>                 
                <!-- upload images -->
                <div class="form-group">
                  <label for="images" class="col-sm-2 control-label">banner图</label>
                  <div class="col-sm-8">
                    <div id="uploader-demo">
                      <!--用来存放item-->
                      <div id="imagesList" class="uploader-list"></div>
                      <div class="btns">
                        <div id="imagesPicker">选择图片</div>
                          <!-- <button id="ctlBtn" type="button" class="hidden btn btn-default">开始上传</button> -->
                      </div>
                      <!-- input控件用于保存详情图片的url -->
                      <input type="hidden" name="images" value="[]" id="images" />
                    </div>
                  </div>
                </div><!-- upload detail -->
                <div class="form-group">
                  <label for="detail" class="col-sm-2 control-label">描述图</label>
                  <div class="col-sm-8">
                    <div id="uploader">
                      <div class="queueList">
                        <div id="dndArea" class="placeholder">
                          <div id="filePicker"></div>
                          <p>或将照片拖到这里，单次最多可选300张</p>
                        </div>
                      </div>
                      <div class="statusBar" style="display:none;">
                          <div class="progress">
                              <span class="text">0%</span>
                              <span class="percentage"></span>
                          </div><div class="info"></div>
                          <div class="btns">
                              <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                          </div>
                      </div>
                    </div>
                    <!-- input控件用于保存详情图片的url -->
                    <input type="hidden" name="detail" value="[]" id="detail" />

                    <!-- .upload -->
                  </div>              
                  <script src="/assets/js/goods/edit.js"></script>
                <!-- /upload -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">保存</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
  </section>
  <script type="text/javascript">
  $(function() {
    $('#submit').click(function (e) {
      $('#edit-form').bootstrapValidator({
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
         images: {
           validators: {
             regexp: {
                 regexp: /^\[.+\]$/,
                 message: '请上传banner图'
             }
           }
         }
       }
      });
      ;
      var bootstrapValidator = $("#edit-form").data('bootstrapValidator');
      bootstrapValidator.validate();
      if(bootstrapValidator.isValid()) {
        if ($('#images').val() == '[]') {
          sweetAlert("提示", "请上传banner图", "error");
          return;
        }
       console.log('valid');
       $.post(
          'savecate',
          {
            title: $('#title').val(),
            images: $('#images').val()
          },
          function (response) {
            sweetAlert("提示", response.message, "success");
            if (response.success) {
              $('#edit-form').data('bootstrapValidator').resetForm();
              $('#title').val("");
              $('#images').val("[]");
            }
          }
        );
     } else {
      console.log('invalid');
     }
    });
  });
  </script>
  <!-- /.content -->
</div>