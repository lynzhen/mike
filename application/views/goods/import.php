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
      <li class="active">商品管理</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">导入商品</h3>
                <div class="box-tools pull-right">
                <a class="btn btn-sm btn-primary" href="index">返回列表</a>
                </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form id="edit-form" class="form-horizontal" action="" method="post">
            
                <div class="form-group">
                  <label for="import-data" class="col-sm-2 control-label">商品表格</label>
                  <div class="col-sm-8">
                    <div id="import-data">
                      <!--用来存放item-->
                      <div id="datalist" class="data-list"></div>                    
                    </div>
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
  <script type="text/javascript">
  $(function() {
    $('#submit').click(function (e) {

    });
  });
  </script>
  <!-- /.content -->
</div>