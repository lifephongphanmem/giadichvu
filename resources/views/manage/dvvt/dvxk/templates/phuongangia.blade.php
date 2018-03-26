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
                <h4 id="header_pag" name="header_pag" class="modal-title">Kê khai phương án giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" id="pag">
                    <div class="form-group">
                        <label for="sanluong" class="col-md-6 control-label">Sản lượng tính giá</label>
                        <div class="col-md-4">
                            <input type="text" id="sanluong" class="form-control pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(hành khách)</label>
                    </div>

                    <div class="form-group">
                        <label for="cpnguyenlieutt" class="col-md-6 control-label">Chi phí nguyên liệu trực tiếp</label>
                        <div class="col-md-4">
                            <input type="text" id="cpnguyenlieutt" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label for="cpcongnhantt" class="col-md-6 control-label">Chi phí nhân công trực tiếp</label>
                        <div class="col-md-4">
                            <input type="text" id="cpcongnhantt" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label for="cpkhauhaott" class="col-md-6 control-label">Chi phí khấu hao máy móc trực tiếp</label>
                        <div class="col-md-4">
                            <input type="text" id="cpkhauhaott" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label for="cpsanxuatdt" class="col-md-6 control-label">CP sản xuất, kinh doanh theo đặc thù</label>
                        <div class="col-md-4">
                            <input type="text" id="cpsanxuatdt" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>
                    </div>

                    <div class="form-group">
                        <label for="cpsanxuatc" class="col-md-6 control-label">Chi phí sản xuất chung</label>
                        <div class="col-md-4">
                            <input type="text" id="cpsanxuatc" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label for="cptaichinh" class="col-md-6 control-label">Chi phí tài chính</label>
                        <div class="col-md-4">
                            <input type="text" id="cptaichinh" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label for="cpbanhang" class="col-md-6 control-label">Chi phí bán hàng</label>
                        <div class="col-md-4">
                            <input type="text" id="cpbanhang" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label for="cpquanly" class="col-md-6 control-label">Chi phí quản lý</label>
                        <div class="col-md-4">
                            <input type="text" id="cpquanly" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Lợi nhuận dự kiến</label>
                        <div class="col-md-4">
                            <input type="text" id="loinhuan" class="form-control pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Tổng chi phí và lợi nhuận dự kiến</label>
                        <div class="col-md-4">
                            <input type="text" id="tongcong" readonly class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Giá dịch vụ (giá vé)</label>
                        <div class="col-md-4">
                            <input type="text" id="giadv" readonly class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Giải trình chi tiết</label>
                        <div class="col-md-6">
                            <textarea rows="4" id="giaitrinh" class="form-control"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="idpag" name="idpag"/>
                    <input type="hidden" id="thuevat" />
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
    function tongchiphi() {
        var hs = 0;
        var loinhuan = getdl($('#loinhuan').val());
        $('.chiphi').each(function () {
            hs += getdl($(this).val());
        });
        $('#tongcong').val(parseFloat(hs + loinhuan));
    }

    function thuevat() {
        var sanluong = getdl($('#sanluong').val());
        var tongcong = getdl($('#tongcong').val());
        var thuevat = 0;
        //var thuevat = Math.round(tongcong / 10);

        $('#thuevat').val(parseFloat(thuevat));
        if (sanluong == 0) {
            $('#giadv').val(0);
        } else {
            $('#giadv').val(Math.round((tongcong + thuevat) / sanluong));
        }
    }

    $('.pag').change(function(){
        tongchiphi();
        thuevat()
    });
</script>
@include('includes.script.scripts')

