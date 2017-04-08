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
            url: '{{$url}}'+'thao_tac/updatepag',
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
            url: '{{$url}}'+'thao_tac/getpag',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                madichvu: madichvu,
                masokk: $('#masokk').val()
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