<!-- 引入bs-confirmation -->
<script src="/bower_components/bs-confirmation/bootstrap-confirmation.js"></script>
<!-- 引入css -->
<link rel="stylesheet" type="text/css" href="/assets/css/global.css">
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
					<a class="btn btn-sm btn-primary" href="import">导入表格</a>
					<a class="btn btn-sm btn-primary" href="add">添加</a>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
			<style>
				.flist{
					border:0;
					outline:0;
					width:100%;
					position:absolute;
					bottom:-24px;
					left:0;
					display:none;
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
							<th class="openlist">分类号</th>
							<th>商品规格</th>
							<th>商品编号</th>
							<th>包装含量</th>
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
								<td><?=$item->get('package')?></td>
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
			<?=$pagination;?>
			</div><!-- box-footer -->
		</div><!-- /.box -->
	</section>
	<!-- /.content -->
	<style>
		.flWrap{
			display:none;
			position: fixed;
			width: 800px;
			height: auto;
			padding: 20px;
			top: 50%;
			left: 50%;
			background: rgba(0,0,0,.4);
			border-radius: 10px;
			transform: translate(-50%,-50%);
		}
		.fltitle{
			height: 30px;
			line-height: 25px;
			color: #fff;
		}
		.fLists{
			background: #fff;
			padding: 20px;
			border-radius: 10px;
			overflow: hidden;
		}
		.flitems{
			overflow:hidden;
			margin-bottom:20px;
		}
		.fitem{
			float: left;
			margin: 5px;
			padding: 3px 10px;
			background: #337ab7;
			border: 1px solid #2e6da4;
			color: #fff;
			border-radius: 5px;
		}
		.flclose{
			position: absolute;
			top: 10px;
			right: 10px;
			width: 20px;
			height: 20px;
			border-radius: 50%;
			background: #d43f3a;
			color: #fff;
			text-align: center;
			line-height: 20px;
			cursor: pointer;
		}
	</style>
	<div class="flWrap">
		<div class="flclose">X</div>
		<div class="fltitle">分类列表</div>
		<div class="fLists">
		<div class="flitems"></div>
		<div class="box-footer">
			<ul class="pagination"></ul>
		</div>
	</div>
</div>
<script>
	$(function () { 
		$("[data-toggle='popover']").popover();

		$(".openlist").click(function(){
			sweetAlert("提示", '正在查询...', "success");
			getItem(1);
		})

		$(".flclose").click(function(){
			$(".flWrap").hide();
		})

		$(document.body).on('click','.pages',function(){
			$(this).addClass('active');
			$(this).siblings('.pages').removeClass('active');
			var page = $(this).find('a').data('index');
			// console.log(page);
			getItem(page);
		})

		$(document.body).on('click','.fitem',function(){
			var value = $(this).data('fl');
			// console.log(value);
			location.href = 'flist?flno='+value;
		})
	});

	function getItem(ipage){
		$(".flitems").html('');
		$(".pagination").html('');
		$(".flWrap").hide();
		$.post(
			'showLists',
			{
				pageIndex : ipage
			},
			function (response) {
				// console.log(response);console.log(typeof(response));
				var data = eval('(' + response + ')');//console.log(data);
				$(".sweet-overlay,.sweet-alert").hide();
				var arr = data.list;   
				var ipage = data.ipage; 
				var str = '';
				for(let index in arr){
					str += '<div class="fitem" data-fl="'+arr[index]['flno']+'">' + arr[index]['flno']+'<br>'+  arr[index]['mc']+ '</div>';
				}
				var pagestr = '';
				for(var i = 1;i<ipage+1;i++){
					if(i == ipage){
						pagestr += '<li class="pages active"><a href="javascript:;" data-index="'+i+'">'+i+'</a></li>';
					}else{
						pagestr += '<li class="pages"><a href="javascript:;" data-index="'+i+'">'+i+'</a></li>';
					}
				}
				$(".flitems").html(str);
				$(".pagination").html(pagestr);
				$(".flWrap").show();
			}  
		);
	}
</script>