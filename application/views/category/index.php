<!-- 引入bs-confirmation -->
<script src="/bower_components/bs-confirmation/bootstrap-confirmation.js"></script>
<!-- 引入css -->
<link rel="stylesheet" type="text/css" href="/assets/css/global.css">

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="../dashboard/index"><i class="fa fa-dashboard"></i> 首页</a></li>
      <li class="active">商品分类</li>
    </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">分类</h3>
				<div class="box-tools pull-right">
                <a class="btn btn-sm btn-primary" href="add">添加</a>
				</div>
				<!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>分类名称</th>
							<th>父级分类</th>
							<th>一级序号</th>
							<th>操作</th>			
						</tr>
					</thead>
					<tbody>
						<?php foreach($categories as $item):?>
							<tr>
								<td><?=$item->get('title')?></td>
								<td><?=$item->get('pname')?></td>
								<td><?=$item->get('index')?></td>
								<td><a type="button" class="btn btn-primary" href="editcate?objectId=<?=$item->get('objectId')?>">修改</a></td>
							</tr>
						<?php endforeach;?>
					</tbody>

				</table>
				<script type="text/javascript">
					$('.delete').confirmation({
						onConfirm: function() { },
						onCancel: function() { },
						href: function (e) {
							return $(e).attr('href');
						},
						title: '确定删除吗？',
						btnOkClass: 'btn btn-sm btn-danger btn-margin',
						btnCancelClass: 'btn btn-sm btn-default btn-margin',
						btnOkLabel: '删除',
						btnCancelLabel: '取消',
						placement: 'bottom'
					})
				</script>
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
		$("[data-toggle='popover']").popover();
	});
</script>