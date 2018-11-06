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
        <h3 class="box-title">导入商品</h3>
          <div class="box-tools pull-right">
          <a class="btn btn-sm btn-primary" href="index">返回列表</a>
          </div><!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form id="edit-form" class="form-horizontal" action="" method="post">      
          <div class="form-group">
            <label for="import-data" class="col-sm-2 control-label">商品表格</label>
            <div class="col-sm-8">
              <div id="btns">
                <div class="importBtn">
                  <input type="file" class="import" name="import" onchange="importf(this)">选择文件
                </div>
                <div class="filename"></div>            
              </div>              
              <div id="datalist">
                <div id="list"></div>
                <table id="data-table" class='table table-hover table-striped table-bordered'>
                  <thead><tr></tr></thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" id="submit" class="btn btn-primary">保存</button>
          </div>
          <!-- /.box-footer -->
        </form>
        <style>
          .importBtn{
            position:relative;
            display: inline-block;
            vertical-align: middle;
            margin: 0 12px 0 0;
            width: 80px;
            height: 32px;
            line-height: 32px;
            background: #00c0ef;
            color: #fff;
            border-radius: 4px;
            text-align: center;
          }
          .import{
            position:absolute;
            top:0;
            left:0;
            opacity:0;
            width: 80px;
            height: 32px;
          }
          .filename{
            display: inline-block;
            line-height: 32px;
            font-size: 16px;
            color: #666;
          }
          #datalist{
            padding:10px;
          }
        </style>
      </div>
    </div>
  </section>
  <script src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>        
  <script>
    function getFileName(o){
      var pos=o.lastIndexOf("\\");
      return o.substring(pos+1);  
    }
    /*
    FileReader共有4种读取方法：
    1.readAsArrayBuffer(file)：将文件读取为ArrayBuffer。
    2.readAsBinaryString(file)：将文件读取为二进制字符串
    3.readAsDataURL(file)：将文件读取为Data URL
    4.readAsText(file, [encoding])：将文件读取为文本，encoding缺省值为'UTF-8'
    */
    var wb;//读取完成的数据
    var rABS = false; //是否将文件读取为二进制字符串

    function importf(obj) {//导入
        if(!obj.files) {
            return;
        }
        // 获取文件的名字
        var filename = getFileName($('.import').val());
        $('.filename').text(filename);

        var f = obj.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = e.target.result;
            if(rABS) {
                wb = XLSX.read(btoa(fixdata(data)), {//手动转化
                    type: 'base64'
                });
            } else {
                wb = XLSX.read(data, {
                    type: 'binary'
                });
            }
            //wb.SheetNames[0]是获取Sheets中第一个Sheet的名字
            //wb.Sheets[Sheet名]获取第一个Sheet的数据
            var dataArr = XLSX.utils.sheet_to_json(wb.Sheets[wb.SheetNames[0]]);
            console.log(dataArr);
            // console.log(JSON.stringify(dataArr));
            
            var thstr = '';
            $.each(dataArr[0],function(key,item){
              thstr += '<th>'+key+'</th>';
            })
            // console.log(thstr);
            $("#data-table thead tr").html(thstr);

            var dataObj = {};
            var tdstr = '';
            for(var i = 0;i<dataArr.length;i++){
              tdstr += '<tr>';
              dataObj[i]=[];
              $.each(dataArr[i],function(key,item){
                tdstr += '<td>'+item+'</td>';
                dataObj[i].push(item);
              })
              tdstr += '</tr>';
            }
            // console.log(tdstr);
            console.log(dataObj);
            $("#data-table tbody").html(tdstr);
        };
        if(rABS) {
            reader.readAsArrayBuffer(f);
        } else {
            reader.readAsBinaryString(f);
        }
    }

    function fixdata(data) { //文件流转BinaryString
        var o = "",
            l = 0,
            w = 10240;
        for(; l < data.byteLength / w; ++l) o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l * w + w)));
        o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));
        return o;
    }

</script>
  <script type="text/javascript">
  $(function() {
    $('#submit').click(function (e) {

    });
  });
  </script>
  <!-- /.content -->
</div>