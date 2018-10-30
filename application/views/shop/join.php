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
				<h3 class="box-title"><?=$title?></h3>
				<div class="box-tools pull-right">
					<a class="btn btn-sm btn-primary" href="add">添加</a>
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
								<td><a type="button" class="btn btn-primary" id='pass' data-id='<?=$item->get('objectId')?>' <?=$item->get('isPass') == true ? 'disabled' : ''?> href=""> <?=$item->get('isPass') == true ? '已通过' : '通过'?></a></td>
								<td><a type="button" class="btn btn-danger" id='refuse' data-id='<?=$item->get('objectId')?>' style='display: <?=$item->get('isPass') == true ? 'none' : 'block'?>' href="">拒绝</a></td>
								<td><a type="button" class="btn btn-danger" id='black' data-id='<?=$item->get('objectId')?>' style=' <?=$item->get('isPass') == true ? 'block' : 'none'?>' href="">拉黑</a></td>
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

		$("#pass").click(function(e){
			var objectId = $(this).data('id');
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
	});
</script>