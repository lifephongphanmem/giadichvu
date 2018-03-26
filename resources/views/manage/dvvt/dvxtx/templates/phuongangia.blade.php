<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/06/2016
 * Time: 8:28 AM
 */
?>

<!--Modal phương án giá-->
<div id="modal-pagia" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Kê khai phương án giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" id="pag">
                    <div class="form-group">
                        <label class="col-md-6 control-label">Nguyên giá phương tiện</label>
                        <div class="col-md-4">
                            <input type="text" id="nguyengia" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Tổng quảng đường lăn bánh</label>
                        <div class="col-md-4">
                            <input type="text" id="tongkm" class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(km)</label>

                        <label class="col-md-6 control-label">Tổng quảng đường lăn bánh có khách</label>
                        <div class="col-md-4">
                            <input type="text" id="kmcokhach" class="form-control pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(km)</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">Chi phí lương lái xe, phụ xe</label>
                        <div class="col-md-4">
                            <input type="text" id="luonglaixe" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí BHXH, BHYT, BHTN, KPCĐ</label>
                        <div class="col-md-4">
                            <input type="text" id="baohiem" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí nhiên liệu chính</label>
                        <div class="col-md-4">
                            <input type="text" id="nhienlieuchinh" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí vật liệu bôi trơn</label>
                        <div class="col-md-4">
                            <input type="text" id="nhienlieuboitron" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí khấu hao phương tiện</label>
                        <div class="col-md-4">
                            <input type="text" id="khauhao" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí sửa chữa lớn phương tiện</label>
                        <div class="col-md-4">
                            <input type="text" id="suachualon" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí sửa chữa thường xuyên</label>
                        <div class="col-md-4">
                            <input type="text" id="suachuatx" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí chích trước săm lốp, ắc quy</label>
                        <div class="col-md-4">
                            <input type="text" id="samlop" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí thuê văn phòng, nhà xe</label>
                        <div class="col-md-4">
                            <input type="text" id="thuevp" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí bảo hiểm phương tiện</label>
                        <div class="col-md-4">
                            <input type="text" id="baohiempt" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí bảo hiểm TNDS</label>
                        <div class="col-md-4">
                            <input type="text" id="baohiemtnds" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí đăng kiểm định kỳ</label>
                        <div class="col-md-4">
                            <input type="text" id="dangkiem" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>
                        <label class="col-md-6 control-label">Chi phí phí đường bộ</label>
                        <div class="col-md-4">
                            <input type="text" id="phiduongbo" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí quản lý</label>
                        <div class="col-md-4">
                            <input type="text" id="quanly" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí vay lãi ngân hàng</label>
                        <div class="col-md-4">
                            <input type="text" id="lainganhang" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí bán hàng</label>
                        <div class="col-md-4">
                            <input type="text" id="banhang" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
                        </div>
                        <label class="col-md-2 control-label" style="padding-left: 0px;text-align: left">(đồng)</label>

                        <label class="col-md-6 control-label">Chi phí BDCS các cấp</label>
                        <div class="col-md-4">
                            <input type="text" id="chiphibdcs" class="form-control chiphi pag" data-mask="fdecimal" style="text-align: right">
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
                        <label class="col-md-6 control-label">Thuế GTGT</label>
                        <div class="col-md-4">
                            <input type="text" id="thuevat" readonly class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Giá dịch vụ (giá vé)</label>
                        <div class="col-md-4">
                            <input type="text" id="doanhthu" readonly class="form-control" data-mask="fdecimal" style="text-align: right">
                        </div>
                    </div>

                    <div class="form-group" style="margin: 0px">
                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <textarea rows="4" id="ghichu_pag" class="form-control">Nội dung ghi chú</textarea>
                        </div>
                    </div>
                    <input type="hidden" id="madichvu" name="madichvu"/>
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
        var sanluong = getdl($('#kmcokhach').val());
        var tongcong = getdl($('#tongcong').val());
        var thuevat = Math.round(tongcong / 10);

        $('#thuevat').val(parseFloat(thuevat));
        if (sanluong == 0) {
            $('#doanhthu').val(0);
        } else {
            $('#doanhthu').val(Math.round((tongcong + thuevat) / sanluong));
        }
    }

    $('.pag').change(function(){
        tongchiphi();
        thuevat()
    });
</script>
@include('includes.script.scripts')

