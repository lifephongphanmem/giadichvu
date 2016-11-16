<div id="nhandvvt-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <form id="frmNhanDVVT" method="GET" action="#" accept-charset="UTF-8">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý nhận hồ sơ kê khai giá dịch vụ vận tải của đơn vị?</h4>
                </div>
                <div class="modal-body">
                    <!--div class="form-group">
                        <label class="form-control-label">Ngày trả</label>
                        <input type="date" class="form-control" id="ngaychuyentra" name="ngaychuyentra">
                    </div -->

                    <div class="form-group">
                        <label class="form-control-label">Số hồ sơ</label>
                        <input type="text" id="sohsnhan" data-provide="markdown" class="form-control md-input" name="sohsnhan">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Ngày nhận hồ sơ</label>
                        <input type="date" id="ngaynhan" data-provide="markdown" class="form-control md-input" name="ngaynhan">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickNhanHS()">Đồng ý</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="idnhan" name="idnhan"/>
    </form>
</div>

<script>
    function confirmNhan(id) {
        $('#idnhan').attr('value', id);
        var sohs = '{{(getGeneralConfigs()['sodvvt'] + 1)}}';
        var today = new Date();
        //alert(sohs);
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd='0'+dd
        }

        if(mm<10) {
            mm='0'+mm
        }

        $('#ngaynhan').attr('value', yyyy+'-'+ mm+'-'+dd);
        $('#sohsnhan').attr('value', sohs);
    }

    function confirmNhanCS(str){
        var aKQ=str.split('?');
        $('#idnhan').attr('value', aKQ[0]);
        $('#sohsnhan').attr('value', aKQ[1]);
        $('#ngaynhan').attr('value', aKQ[2]);
    }

    function clickNhanHS(){
        if($('#ngaynhan').val()==''){
            toastr.error('Ngày nhận hồ sơ không hợp lệ','Lỗi!');
            return false;
        }

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$url}}'+'xet_duyet/duyet',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: $('#idnhan').val(),
                sohsnhan: $('#sohsnhan').val(),
                ngaynhan: $('#ngaynhan').val()
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'success') {
                    toastr.success('Nhận bảng kê khai thành công.','Thành công!');
                    location.reload();
                }
            },
            error: function (message) {
                toastr.error(message);
            }
        })
    }
</script>