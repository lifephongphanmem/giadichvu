<div id="chuyendvvt-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <form id="frmChuyenDVVT" method="GET" action="#" accept-charset="UTF-8">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý chuyển kê khai giá dịch vụ vận tải lên Sở Tài Chính?</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label">Thông tin người chuyển</label>
                        <textarea id="ttnguoinop" class="form-control required" name="ttnguoinop" cols="30" rows="6"
                                  placeholder="Họ và tên - Số điện thoại liên lạc - Email - Fax"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickChuyenDVVT()">Đồng ý</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="idkk" name="idkk"/>
    </form>
</div>

<script>
    function confirmChuyen(id) {
        $('#idkk').attr('value', id);
        $('#ttnguoinop').attr('value', '');
    }

    function TTNguoiChuyen(str){
        $('#ttnguoinop').attr('value', str);
        $('#idkk').attr('value', 'null');
    }

    function clickChuyenDVVT() {
        var idkk= $('#idkk').val();
        var ttnguoinop= $('textarea[name="ttnguoinop"]').val();
        if(ttnguoinop==''){
            toastr.error('Thông tin người nộp không hợp lệ','Lỗi!');
            return false;            
        }

        if(idkk!='null') {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}' + 'thao_tac/chuyen',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: idkk,
                    ttnguoinop: ttnguoinop
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Chuyển bảng kê khai thành công.", "Thành công");
                        location.reload();
                    }
                },
                error: function (message) {
                    toastr.error(message);
                }
            });
        }
    }
</script>