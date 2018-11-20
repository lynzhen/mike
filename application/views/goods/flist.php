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
			<style>
				.flist{
					border:0;
					outline:0;
					width:100%;
				}
				.flist option{
					height:24px;
					line-height:24px;
				}
				.openlist{
					position:relative;
				}
				.openlist:after{
					position:absolute;
					right:10px;
					bottom:20px;
					content:'';
					width:0px;
					height:0px;
					border-top: 5px solid black;
					border-left: 5px solid transparent;
					border-right: 5px solid transparent;
				}
			</style>
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>缩略图</th>
							<th>名称</th>
							<th>长名称</th>
							<th style="width:90px;" class="openlist">分类号</th>
							<th>商品规格</th>
							<th>商品编号</th>
							<th>单位</th>
							<th>零售价</th>
							<th>库存</th>
							<th>批发价</th>
							<th>条码</th>
							<th>供货商号</th>
							<th>柜台存货数</th>
							<th>进货价</th>
							<th>修改</th>
							<th>删除</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($result as $item):?>
							<tr>
								<td><img width="40" height="40" src="<?=$item->get('avatar')?>" class="popover-show" data-container="body" data-placement="bottom" data-toggle="popover" data-html="true" data-trigger="hover focus click" data-content="<img src='<?=$item->get('avatar')?>' />" /></td>
								<td><?=$item->get('MC')?></td>
								<td><?=$item->get('LongMc')?></td>
								<td><?=$item->get('FLNO')?></td>
								<td><?=$item->get('SPGG')?></td>
								<td><?=$item->get('spno')?></td>
								<td><?=$item->get('BZDW')?></td>
								<td><?=$item->get('LSJ')?></td>
								<td><?=$item->get('DSSL')?></td>
								<td><?=$item->get('JHJ')?></td>
								<td><?=$item->get('bz')?></td>
								<td><?=$item->get('Mrcs')?></td>
								<td><?=$item->get('KCSL')?></td>
								<td><?=$item->get('JHJ')?></td>
								<td><a type="button" class="btn btn-primary" href="edit?objectId=<?=$item->get('objectId')?>">修改</a></td>
								<td><a type="button" class="btn btn-danger delete" href="delete?objectId=<?=$item->get('objectId')?>">删除</a></td>
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
			</div><!-- box-footer -->
		</div><!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<script>
	$(function () { 
		$("[data-toggle='popover']").popover();
		$(".openlist").click(function(){
			$.post(
				'showList',				
				function (response) {
					var arr = response;
					console.log('111111');
					console.log(arr);
					console.log('222222222');
					console.log(JSON.parse(arr));
					// sweetAlert("提示", response.message, "success");
					// for(var i = 0;i<)
				}  
			);
		})
	});
	function func(){
		var value = $('.flist option:selected').val();
		console.log(value);
		location.href = 'flist?flno='+value;
	}
</script>