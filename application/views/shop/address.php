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
					<!-- <a class="btn btn-sm btn-primary" href="add">添加</a> -->
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>商家名称</th>
							<th>收货区域</th>
							<th>详细收货地址</th>
							<th>商家联系人</th>
							<th>联系电话</th>
							<th>提交时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php foreach($result as $item):?> -->
							<tr>
								<td><?=$item->get('shopname')?></td>
								<td><?=$item->get('province')?><?=$item->get('city')?><?=$item->get('town')?><?=$item->get('region')?></td>
								<td><?=$item->get('detail')?></td>
								<td><?=$item->get('realname')?></td>
								<td><?=$item->get('mobile')?></td>
								<td><?=$item->get('updatedA')?></td>
								<td><button type="button" data-type="<?=$item->get('objectId')?>" class="btn btn-primary doSth>">通过</button></td>
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

		$(".doSth").click(function(){
			var objectId = $(this).data('type');
		})
	});
</script>