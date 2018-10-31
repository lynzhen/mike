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
					<!-- <a class="btn btn-sm btn-primary" href="add">添加</a> -->
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>商家名称</th>
							<th>商家地址</th>
							<th>联系名称</th>
							<th>联系电话</th>
							<th>折扣</th>
							<th>通过</th>
							<th>拒绝</th>
							<th>拉黑</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php foreach($result as $item):?> -->
							<tr>
								<td><?=$item->get('shopname')?></td>
								<td><?=$item->get('addr')?></td>
								<td><?=$item->get('name')?></td>
								<td><?=$item->get('tel')?></td>
								<td><?=$item->get('discount')?></td>
								<td><button class="btn btn-primary pass" data-id='<?=$item->get('objectId')?>' <?=$item->get('isPass') == true ? 'disabled' : ''?> ><?=$item->get('isPass') == true ? '已通过' : '通过'?></button></td>
								<td><button class="btn btn-danger refuse" data-id='<?=$item->get('objectId')?>' <?=$item->get('isPass') == true ? 'disabled' : ''?> >拒绝</button></td>
								<td><button class="btn btn-danger black" data-id='<?=$item->get('objectId')?>'>拉黑</button></td>
							</tr>
						<!-- <?php endforeach;?> -->
					</tbody>
				</table>
			</div><!-- /.box-body -->
			<div class="box-footer">
			<?=$pagination;?>
			</div><!-- box-footer -->
		</div><!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<script>
	$(function () { 
		$("[data-toggletoggle='popover']").popover();

		$(".pass").click(function(){
			console.log('pass');
			var objectId = $(this).data('id');
			console.log(objectId);
			$.post(
				'pass',
				{
				objectId: objectId,
				},
				function (response) {
				sweetAlert("提示", response.message, "success");
				}  
			);
		})

		$(".refuse").click(function(){
			console.log('refuse');
			var objectId = $(this).data('id');
			console.log(objectId);
			$.post(
				'refuse',
				{
				objectId: objectId,
				},
				function (response) {
				sweetAlert("提示", response.message, "success");
				}  
			);
		})

		$(".black").click(function(){
			console.log('black');
			var objectId = $(this).data('id');
			console.log(objectId);
			$.post(
				'black',
				{
				objectId: objectId,
				},
				function (response) {
				sweetAlert("提示", response.message, "success");
				}  
			);
		})
	});
</script>