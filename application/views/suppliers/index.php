<!-- 引入bs-confirmation -->
<script src="/bower_components/bs-confirmation/bootstrap-confirmation.js"></script>
<!-- 引入css -->
<link rel="stylesheet" type="text/css" href="/assets/css/global.css">
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="/bower_components/fex-webuploader/dist/webuploader.css">
<link rel="stylesheet" type="text/css" href="/assets/css/webuploader.css">
<!--引入JS-->
<script type="text/javascript" src="/bower_components/fex-webuploader/dist/webuploader.js"></script>

<link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- sweet alet -->
<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<link href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">

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
				<h3 class="box-title"><?=$title?></h3>
				<div class="box-tools pull-right">
					<a class="btn btn-sm btn-primary" href="add">添加</a>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>供应商编号</th>
							<th>供应商名称</th>
							<th>名称缩写</th>
							<th>供应商分组</th>
							<th>联系人</th>
							<th>联系人电话</th>
							<th>进货总金额</th>
							<th>支付天数</th>
							<th>日期限制</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php foreach($result as $item):?> -->
							<tr>
								<td><?=$item->get('cno')?></td>
								<td><?=$item->get('mc')?></td>
								<td><?=$item->get('bzbz1')?></td>
								<td><?=$item->get('groupabc')?></td>
								<td><?=$item->get('lxr')?></td>
								<td><?=$item->get('lxrdh')?></td>
								<td><?=$item->get('totalwjje')?></td>
								<td><?=$item->get('payoutday')?></td>
								<td><?=$item->get('qhddaylimit')?></td>
								<td><a class="btn btn-primary" href='edit?id=<?=$item->get('objectId')?>'>编辑</a></td>
							</tr>
						<!-- <?php endforeach;?> -->
					</tbody>
				</table>
			</div><!-- /.box-body -->
			<div class="box-footer">
			<!-- <?=$pagination;?> -->
			</div><!-- box-footer -->
		</div><!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<script>
	$(function () { 
		$("[data-toggletoggle='popover']").popover();


		$(document.body).on('click','.confirm',function(){
			location.reload(true);
		})
	});
</script>