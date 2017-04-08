<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/06/2016
 * Time: 8:28 AM
 */
?>

<!--Modal phương án giá-->
<div id="modal-pagia-create" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Kê khai phương án giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" id="pag">
                    <div class="form-group">
                        <label for="sanluong" class="col-md-6 control-label">Sản lượng tính giá</label>
                        <div class="col-md-6">
                            <input type="text" id="sanluong" name="sanluong" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cpnguyenlieutt" class="col-md-6 control-label">Chi phí nguyên liệu trực tiếp</label>
                        <div class="col-md-6">
                            <input type="text" id="cpnguyenlieutt" name="cpnguyenlieutt" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>

                        <label for="cpcongnhantt" class="col-md-6 control-label">Chi phí nhân công trực tiếp</label>
                        <div class="col-md-6">
                            <input type="text" id="cpcongnhantt" name="cpcongnhantt" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>

                        <label for="cpkhauhaott" class="col-md-6 control-label">Chi phí khấu hao máy móc trực tiếp</label>
                        <div class="col-md-6">
                            <input type="text" id="cpkhauhaott" name="cpkhauhaott" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>

                        <label for="cpsanxuatdt" class="col-md-6 control-label">Chi phí sản xuất, kinh doanh theo đặc thù</label>
                        <div class="col-md-6">
                            <input type="text" id="cpsanxuatdt" name="cpsanxuatdt" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cpsanxuatc" class="col-md-6 control-label">Chi phí sản xuất chung</label>
                        <div class="col-md-6">
                            <input type="text" id="cpsanxuatc" name="cpsanxuatc" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>

                        <label for="cptaichinh" class="col-md-6 control-label">Chi phí tài chính</label>
                        <div class="col-md-6">
                            <input type="text" id="cptaichinh" name="cptaichinh" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>

                        <label for="cpbanhang" class="col-md-6 control-label">Chi phí bán hàng</label>
                        <div class="col-md-6">
                            <input type="text" id="cpbanhang" name="cpbanhang" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>

                        <label for="cpquanly" class="col-md-6 control-label">Chi phí quản lý</label>
                        <div class="col-md-6">
                            <input type="text" id="cpquanly" name="cpquanly" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                    </div>
                    <input type="hidden" id="idpag" name="idpag"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="update_pagia()">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<!--Script phương án giá-->
<script>
    function update_pagia(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$url}}'+'thao_tac/updatepag_temp',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                sanluong:$('#sanluong').val(),
                cpnguyenlieutt:$('#cpnguyenlieutt').val(),
                cpcongnhantt:$('#cpcongnhantt').val(),
                cpkhauhaott:$('#cpkhauhaott').val(),
                cpsanxuatdt:$('#cpsanxuatdt').val(),
                cpsanxuatc:$('#cpsanxuatc').val(),
                cptaichinh:$('#cptaichinh').val(),
                cpbanhang:$('#cpbanhang').val(),
                cpquanly:$('#cpquanly').val(),
                giaitrinh:$('#giaitrinh').val(),
                id: $('#idpag').val()
            },
            dataType: 'JSON',
            success: function () {},
            error: function(message){
                alert(message);
            }
        });
    }

    function editpagia(madichvu){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$url}}'+'thao_tac/getpag_temp',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                madichvu: madichvu
            },
            dataType: 'JSON',
            success: function (data) {
                //alert(data.message);
                if (data.status == 'success') {
                    $('#pag').replaceWith(data.message);
                    InputMask();
                }
            },
            error: function(message){
                alert(message);
            }
        });
    }
</script>