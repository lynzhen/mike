<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="/bower_components/fex-webuploader/dist/webuploader.css">
<link rel="stylesheet" type="text/css" href="/assets/css/webuploader.css">
<!--引入JS-->
<script type="text/javascript" src="/bower_components/fex-webuploader/dist/webuploader.js"></script>
<!-- Select2 -->
<link rel="stylesheet" href="/bower_components/AdminLTE/plugins/select2/select2.min.css">
<script src="/bower_components/AdminLTE/plugins/select2/select2.full.min.js"></script>
<!-- 表单验证 -->
<script src="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/js/language/zh_CN.min.js"></script>
<link href="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.css" rel="stylesheet">
<!-- sweet alet -->
<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<link href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="../dashboard/index"><i class="fa fa-dashboard"></i> 首页</a></li>
      <li class="active">商品管理</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">添加</h3>
                <div class="box-tools pull-right">
                <a class="btn btn-sm btn-primary" href="index">返回列表</a>
                </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <form id="edit-form" class="form-horizontal" action="save" method="post">
                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" id="title" placeholder="名称" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="category" class="col-sm-2 control-label">长名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="longtitle" id="longtitle" placeholder="长名称" value="">
                  </div>
                </div>
                </div> -->
                <div class="form-group">
                  <label for="singleCode" class="col-sm-2 control-label">分类号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="flno" id="flno" placeholder="分类号" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="suppliers" class="col-sm-2 control-label">商品规格</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="spgg" id="spgg" placeholder="商品规格" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="price" class="col-sm-2 control-label">商品编号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="spno" id="spno" placeholder="商品编号" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="boxnumber" class="col-sm-2 control-label">单位</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="dw" id="dw" placeholder="单位" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="size" class="col-sm-2 control-label">零售价</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="price" id="price" placeholder="零售价" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="boxprice" class="col-sm-2 control-label">库存</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="dssl" id="dssl" placeholder="库存" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="singleTP" class="col-sm-2 control-label">批发价</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="pfj" id="pfj" placeholder="批发价" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="singleSize" class="col-sm-2 control-label">条码</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="bz" id="bz" placeholder="条码" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="barcode" class="col-sm-2 control-label">供货商号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="mrcs" id="mrcs" placeholder="供货商号" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="barcode" class="col-sm-2 control-label">柜台存货数</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="kcsl" id="kcsl" placeholder="柜台存货数" value="">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="isHot" class="col-sm-2 control-label">推荐</label>
                  <div class="col-sm-8">
                    <div class="btn-group" id="isHot" data-toggle="buttons">
                      <label class="btn btn-default active">
                        <input type="radio" name="isHot" value="1" id="option1" autocomplete="off" checked> 推荐
                      </label>
                      <label class="btn btn-default">
                        <input type="radio" name="isHot" value="0" id="option3" autocomplete="off"> 不推荐
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="isNew" class="col-sm-2 control-label">新品</label>
                  <div class="col-sm-8">
                    <div class="btn-group" id="isNew" data-toggle="buttons">
                      <label class="btn btn-default active">
                        <input type="radio" name="isNew" value="1" autocomplete="off"> 新品
                      </label>
                      <label class="btn btn-default">
                        <input type="radio" name="isNew" value="0" autocomplete="off"> 非新品
                      </label>
                    </div>
                  </div>
                </div> -->
                <!-- upload images -->
                <div class="form-group">
                  <label for="images" class="col-sm-2 control-label">产品图</label>
                  <div class="col-sm-8">
                    <div id="uploader-demo">
                      <!--用来存放item-->
                      <div id="imagesList" class="uploader-list"></div>
                      <div class="btns">
                        <div id="imagesPicker">选择图片</div>
                          <!-- <button id="ctlBtn" type="button" class="hidden btn btn-default">开始上传</button> -->
                      </div>
                      <!-- input控件用于保存详情图片的url -->
                      <input type="hidden" name="images" value="[]" id="images" />
                    </div>
                  </div>
                </div>
                <!-- upload detail -->
                <div class="form-group">
                  <label for="detail" class="col-sm-2 control-label">描述图</label>
                  <div class="col-sm-8">
                    <div id="uploader">
                      <div class="queueList">
                        <div id="dndArea" class="placeholder">
                          <div id="filePicker"></div>
                          <p>或将照片拖到这里，单次最多可选300张</p>
                        </div>
                      </div>
                      <div class="statusBar" style="display:none;">
                          <div class="progress">
                              <span class="text">0%</span>
                              <span class="percentage"></span>
                          </div><div class="info"></div>
                          <div class="btns">
                              <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                          </div>
                      </div>
                    </div>
                    <!-- input控件用于保存详情图片的url -->
                    <input type="hidden" name="detail" value="[]" id="detail" />

                    <!-- .upload -->
                  </div>
                </div>
                  <script src="/assets/js/goods/edit.js"></script>
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
  $(function() {
    $('#submit').click(function (e) {
      // $('#edit-form').submit();return;
      $('#edit-form').bootstrapValidator({
        // live: 'disabled',
         message: '输入不正确',
         feedbackIcons: {
           valid: 'glyphicon glyphicon-ok',
           invalid: 'glyphicon glyphicon-remove',
           validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
          title: {
           validators: {
             notEmpty: {
               message: '标题不能为空'
             }
           }
         },
         price: {
           validators: {
             notEmpty: {
               message: '价格不能为空'
             }
           }
         },
         category: {
           validators: {
             notEmpty: {
               message: '分类不能为空'
             }
           }
         },
         singleCode: {
           validators: {
             notEmpty: {
               message: '单瓶条码不能为空'
             }
           }
         },
         suppliers: {
           validators: {
             notEmpty: {
               message: '供货商不能为空'
             }
           }
         },
         images: {
           validators: {
             regexp: {
                 regexp: /^\[.+\]$/,
                 message: '请上传产品图'
             }
           }
         },
         detail: {
           validators: {
             regexp: {
                 regexp: /^\[.+\]$/,
                 message: '请上传描述图'
             }
           }
         }
       }
      });
      ;
      var bootstrapValidator = $("#edit-form").data('bootstrapValidator');
      bootstrapValidator.validate();
      if(bootstrapValidator.isValid()) {
        if ($('#images').val() == '[]') {
          sweetAlert("提示", "请上传产品图", "error");
          return;
        }
        if ($('#detail').val() == '[]') {
          sweetAlert("提示", "请上传描述图", "error");
          return;
        }
      //  console.log('valid');
      //  var theprice = $("#price").val();
      //  console.log(typeof(theprice));
      //  var floatprice = parseFloat($('#price').val());
      //  console.log(typeof(floatprice));
      //  var 
       $.post(
          'save',
          {
            title: $('#title').val(),
            category: $('#category').val(),
            singleCode: $('#singleCode').val(),
            suppliers: $('#suppliers').val(),
            price: parseFloat($('#price').val()),
            boxnumber: $('#boxnumber').val(),
            FCL: $('#FCL .active input').val(),
            size: $('#size').val(),
            singleTP: $('#singleTP').val(),
            singleSize: $('#singleSize').val(),
            barcode: $('#barcode').val(),
            isNew: $('#isNew .active input').val(),
            isHot: $('#isHot .active input').val(),
            images: $('#images').val(),
            detail: $('#detail').val()
          },
          function (response) {
            sweetAlert("提示", response.message, "success");
            if (response.success) {
              $('#edit-form').data('bootstrapValidator').resetForm();
              $('#title').val("");
              $('#price').val("");
              $('#images').val("[]");
              $('#detail').val("[]");
            }
          }
        );
     } else {
      console.log('invalid');
     }
    });
  });
  </script>
  <!-- /.content -->
</div>