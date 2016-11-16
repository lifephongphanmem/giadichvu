<div id="tradvvt-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <form id="frmTraDVVT" method="GET" action="#" accept-charset="UTF-8">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý trả lại kê khai giá dịch vụ vận tải cho đơn vị?</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label">Lý do trả lại</label>
                        <textarea id="lydotra" data-provide="markdown" class="form-control md-input" name="lydotra" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickTraDVVT()">Đồng ý</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="idtra" name="idtra"/>
    </form>
</div>

<script>
    function confirmTraLai(id) {
        $('#idtra').attr('value', id);
        $('#ttnguoinop').attr('value', '');
    }

    function LyDoTraLai(str){
        $('#lydotra').attr('value', str);
        $('#idtra').attr('value', 'null');
    }

    function clickTraDVVT() {//Chỉ giao diện tổng hợp mới có chức năng trả lại
        var idtra= $('#idtra').val();

        if (idtra != 'null') {
            var lydo= $('#lydotra').val();
            if(lydo==''){
                toastr.error('Lý do trả lại không hợp lệ','Lỗi!');
                return false;
            }
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'xet_duyet/tra_lai',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('#idtra').val(),
                    lydo: $('#lydotra').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Trả lại bảng kê khai thành công.","Thành công");
                        location.reload();
                    }
                },
                error: function (message) {
                    toastr.error(message);
                }
            })
        }
    }
</script>