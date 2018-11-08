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
							<th>门店名称</th>
							<th>门店地址</th>
							<th>门店编码</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php foreach($result as $item):?> -->
							<tr>
								<td><?=$item->get('mc')?></td>
								<td><?=$item->get('address')?></td>
								<td><?=$item->get('zspsc')?></td>
								<td><a class="btn btn-primary doSth" href='edit?id=<?=$item->get('objectId')?>'>编辑</a></td>
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
		
		$('.doSth').click(function(){
			var objectId = $(this).data('id');
			var thatTd = $(this).parent('td').siblings();
			var discount = thatTd.find('.discount').val();
			var dosth = thatTd.find('.sel').find("option:selected").val();
			// console.log(objectId+','+discount+','+dosth);
			$.post(
				dosth,
				{
				objectId: objectId,
				},
				function (response) {
				sweetAlert("提示", response.message, "success");		
				}
			);
		})

		$(document.body).on('click','.confirm',function(){
			location.reload(true);
		})
	});
</script>