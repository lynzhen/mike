<!-- 引入bs-confirmation -->
<script src="/bower_components/bs-confirmation/bootstrap-confirmation.js"></script>
<!-- 引入css -->
<link rel="stylesheet" type="text/css" href="/assets/css/global.css">

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?=base_url('dashboard/index')?>"><i class="fa fa-dashboard"></i> 首页</a></li>
      <li class="active"><?=$title?></li>
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
<script type="text/javascript">

  $(function () { 
		$("[data-toggle='popover']").popover();

  });
</script>
