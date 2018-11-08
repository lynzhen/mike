<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="/bower_components/fex-webuploader/dist/webuploader.css">
<link rel="stylesheet" type="text/css" href="/assets/css/webuploader.css">
<!--引入JS-->
<script type="text/javascript" src="/bower_components/fex-webuploader/dist/webuploader.js"></script>
<!-- Select2 -->
<link rel="stylesheet" href="/bower_components/AdminLTE/plugins/select2/select2.min.css">
<script src="/bower_components/AdminLTE/plugins/select2/select2.full.min.js"></script>
<!-- sweet alet -->
<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<link href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="../dashboard/index"><i class="fa fa-dashboard"></i> 首页</a></li>
      <li class="active">门店管理</li>
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
              <form id="edit-form" class="form-horizontal" action="save" method="post">
                <!-- objectId for goods id -->
                <input type="hidden" name="objectId" value="<?=$result->get('objectId')?>" id="objectId">
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">门店名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="mc" id="mc" value="<?=$result->get('mc')?>">
                  </div>
                </div>                
                <div class="form-group">
                  <label for="singleCode" class="col-sm-2 control-label">门店地址</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="address" id="address" value="<?=$result->get('address')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="suppliers" class="col-sm-2 control-label">门店编码</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="zcpsc" id="zcpsc" value="<?=$result->get('zcpsc')?>">
                  </div>
                </div>
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

    $('#edit-form').submit(function (e) {

      $.post(
        'save',
        {
          objectId: $('#objectId').val(),
          mc: $('#mc').val(),
          address: $('#address').val(),
          zcpsc: $('#zcpsc').val()
        },
        function (response) {
           sweetAlert("提示", response.message, "success");
        }  
      );
    });
  </script>
  <!-- /.content -->
</div>