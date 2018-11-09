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
      <li class="active">供应商管理</li>
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
                <input type="hidden" name="objectId" value="<?=$suppliers->get('objectId')?>" id="objectId">
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">供应商编号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="cno" id="cno" value="<?=$suppliers->get('cno')?>">
                  </div>
                </div>                
                <div class="form-group">
                  <label for="singleCode" class="col-sm-2 control-label">供应商名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="mc" id="mc" value="<?=$suppliers->get('mc')?>">
                  </div>
                </div>            
                <div class="form-group">
                  <label for="singleCode" class="col-sm-2 control-label">名称缩写</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="bzbz1" id="bzbz1" value="<?=$suppliers->get('bzbz1')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="suppliers" class="col-sm-2 control-label">供应商分组</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="groupabc" id="groupabc" value="<?=$suppliers->get('groupabc')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="suppliers" class="col-sm-2 control-label">联系人</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="lxr" id="lxr" value="<?=$suppliers->get('lxr')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="suppliers" class="col-sm-2 control-label">联系人电话</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="lxrdh" id="lxrdh" value="<?=$suppliers->get('lxrdh')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="suppliers" class="col-sm-2 control-label">支付天数</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="payoutday" id="payoutday" value="<?=$suppliers->get('payoutday')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="suppliers" class="col-sm-2 control-label">日期限制</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="qhddaylimit" id="qhddaylimit" value="<?=$suppliers->get('qhddaylimit')?>">
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
          bzbz1: $('#bzbz1').val(),
          zcpsc: $('#zcpsc').val(),
          groupabc: $('#groupabc').val(),
          lxr: $('#lxr').val(),
          lxrdh: $('#lxrdh').val(),
          payoutday: $('#payoutday').val(),
          qhddaylimit: $('#qhddaylimit').val()
        },
        function (response) {
           sweetAlert("提示", response.message, "success");
        }  
      );
    });
  </script>
  <!-- /.content -->
</div>