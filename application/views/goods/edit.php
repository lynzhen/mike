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
              <h3 class="box-title">修改</h3>
                <div class="box-tools pull-right">
                <a class="btn btn-sm btn-primary" href="index">返回列表</a>
                </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <form id="edit-form" class="form-horizontal" action="save" method="post">
                <!-- objectId for goods id -->
                <input type="hidden" name="objectId" value="<?=$goods->get('objectId')?>" id="objectId">
                <div class="form-group">
                  <label for="mc" class="col-sm-2 control-label">名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="mc" id="mc" value="<?=$goods->get('MC')?>">
                  </div>
                </div>                
                <div class="form-group">
                  <label for="longmc" class="col-sm-2 control-label">长名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="longmc" id="longmc" value="<?=$goods->get('LongMc')?>">
                  </div>
                </div>             
                <div class="form-group">
                  <label for="flno" class="col-sm-2 control-label">分类号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="flno" id="flno" value="<?=$goods->get('FLNO')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="spgg" class="col-sm-2 control-label">商品规格</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="spgg" id="spgg" value="<?=$goods->get('SPGG')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="spno" class="col-sm-2 control-label">商品编号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="spno" id="spno" value="<?=$goods->get('spno')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="package" class="col-sm-2 control-label">包装规格</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="package" id="package" value="<?=$goods->get('package')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="bzdw" class="col-sm-2 control-label">单位</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="bzdw" id="bzdw" value="<?=$goods->get('BZDW')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="lsj" class="col-sm-2 control-label">零售价</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="lsj" id="lsj" value="<?=$goods->get('LSJ')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dssl" class="col-sm-2 control-label">库存</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="dssl" id="dssl" value="<?=$goods->get('DSSL')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="pfj" class="col-sm-2 control-label">批发价</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="pfj" id="pfj" value="<?=$goods->get('PFJ')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="bz" class="col-sm-2 control-label">条码</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="bz" id="bz" value="<?=$goods->get('bz')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="mrcs" class="col-sm-2 control-label">供货商号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="mrcs" id="mrcs" value="<?=$goods->get('Mrcs')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="kcsl" class="col-sm-2 control-label">柜台存货数</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="kcsl" id="kcsl" value="<?=$goods->get('KCSL')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="jhj" class="col-sm-2 control-label">进货价</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="jhj" id="jhj" value="<?=$goods->get('KCSL')?>">
                  </div>
                </div>
                <!-- upload images -->
                <div class="form-group">
                  <label for="fileList" class="col-sm-2 control-label">产品图</label>
                  <style type="text/css">
                    .image {
                      width: 100%;
                    }
                    .mask {
                      position: absolute;
                      width: 100%;
                      height: 15%;
                      background: #eee;
                      opacity: 0.8;
                      bottom: 0;
                      left: 0;
                    }
                    .fa-block {
                      display: block;
                      margin-top: 2px;
                    }
                    .gallery {
                      border: 1px solid #eee;
                      border-radius: 3px;
                      margin-left: 4px;
                      margin-right: 4px;
                    }
                  </style>
                  <div class="col-sm-8">
                    <div class="row">
                        <?php foreach ($goods->get('images') as $image):?>
                          <div class="col-md-3 gallery">
                              <img class="image" src="<?=$image?>" />
                              <div class="mask" data-type="images"><i class="fa fa-2x fa-block fa-trash-o text-center"></i></div>
                          </div>
                        <?php endforeach;?>
                    </div>
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
                  <label for="fileList" class="col-sm-2 control-label">描述图</label>
                  <div class="col-sm-8">
                    <!-- 原描述图 -->
                    <div class="row">
                        <?php foreach ($goods->get('detail') as $image):?>
                          <div class="col-md-3 gallery">
                              <img class="image" src="<?=$image?>" />
                              <div class="mask" data-type="detail"><i class="fa fa-2x fa-block fa-trash-o text-center"></i></div>
                          </div>
                        <?php endforeach;?>
                    </div>
                    <div id="uploader-demo">
                      <!--用来存放item-->
                      <div id="imagesList" class="uploader-list"></div>
                      <div class="btns">
                        <div id="imagesPicker">选择图片</div>
                          <!-- <button id="ctlBtn" type="button" class="hidden btn btn-default">开始上传</button> -->
                      </div>
                    </div>
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
    var origin_images = <?=json_encode($goods->get('images'))?>;
    var origin_detail = <?=json_encode($goods->get('detail'))?>;   


    $('.mask').click(function () {
      // 当前图片url路径
      var url = $(this).parent().find('img').attr('src');
      console.log($(this).attr('data-type'));
      var target = $(this).attr('data-type') == 'images' ? origin_images : origin_detail;
      // 查找出数组元素索引，并移除它，之所以这么做，是因为由于splice会改会数组索引。
      target.splice(url.indexOf(target), 1);
      // console.log(origin_detail);
      $(this).parent().remove();
    });

    $('#edit-form').submit(function (e) {

      // 渲染回#images控件，用于post传值
      var images_control_value = JSON.parse($('#images').val());
      var new_images = images_control_value.concat(origin_images);
      $('#images').val(JSON.stringify(new_images));

      // 渲染回#detail控件，用于post传值
      var detail_control_value = JSON.parse($('#detail').val());
      var new_detail = detail_control_value.concat(origin_detail);
      $('#detail').val(JSON.stringify(new_detail));
      e.preventDefault();

      $('#edit-form').bootstrapValidator({
        // live: 'disabled',
        message: '输入不正确',
        feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          mc: {
            validators: {
              notEmpty: {
                message: '商品名称不能为空'
              }
            }
          },
          flno: {
            validators: {
              notEmpty: {
                message: '分类号不能为空'
              }
            }
          },
          spgg: {
            validators: {
              notEmpty: {
                message: '商品规格不能为空'
              }
            }
          },
          spno: {
            validators: {
              notEmpty: {
                message: '商品编号不能为空'
              }
            }
          },
          package: {
            validators: {
              notEmpty: {
                message: '包装含量不能为空'
              }
            }
          },
          bw: {
            validators: {
              notEmpty: {
                message: '商品单位不能为空'
              }
            }
          },
          lsj: {
            validators: {
              notEmpty: {
                message: '零售价不能为空'
              }
            }
          },
          pfj: {
            validators: {
              notEmpty: {
                message: '批发价不能为空'
              }
            }
          },
          bz: {
            validators: {
              notEmpty: {
                message: '条码不能为空'
              }
            }
          },
          jhj: {
            validators: {
              notEmpty: {
                message: '进货价不能为空'
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

        $.post(
          'save',
          {
            objectId: $('#objectId').val(),
            mc: $('#mc').val(),
            longmc: $('#longmc').val(),
            flno: $('#flno').val(),
            spgg: $('#spgg').val(),
            spno: $('#spno').val(),
            package: $('#package').val(),
            bzdw: $('#bzdw').val(),
            lsj: $('#lsj').val(),
            dssl: $('#dssl').val(),
            pfj: $('#pfj').val(),
            bz: $('#bz').val(),
            mrcs: $('#mrcs').val(),
            kcsl: $('#kcsl').val(),
            jhj: $('#jhj').val(),
            // isNew: $('#isNew .active input').val(),
            // isHot: $('#isHot .active input').val(),
            images: $('#images').val(),
            detail: $('#detail').val()
          },
          function (response) {
            sweetAlert("提示", response.message, "success");
          }  
        );
      }

    });
  </script>
  <!-- /.content -->
</div>