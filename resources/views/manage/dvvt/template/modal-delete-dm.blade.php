<div id="del-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>$url.'danh_muc/del','id' => 'frm_del','method'=>'GET'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                <input type="hidden" name="iddel" id="iddel">

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickdel()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    function confirmDel(id) {
        document.getElementById("iddel").value=id;
    }
    function clickdel(){
        $('#frm_del').submit();
    }
</script>