@extends('main')

@section('custom-style')
    <!-- put the custom style for this page here -->
    <link rel="stylesheet" href="{{ url('vendors/DataTables/media/css/jquery.dataTables.css') }}">
    <!-- <link rel="stylesheet" href="{{ url('vendors/DataTables/extensions/TableTools/css/dataTables.tableTools.min.css') }}">-->
    <link rel="stylesheet" href="{{ url('vendors/DataTables/media/css/dataTables.bootstrap.css') }}">

@stop

@section('custom-script')
    <!-- put the custom script for this page here -->
    <script type="text/javascript" src="{{ url('vendors/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/DataTables/media/js/dataTables.bootstrap.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ url('vendors/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ url('js/table-datatables.js') }}"></script>

    <script>
        function confirmDelete(id) {
            $('#frmDelete').attr('action', "taikhoan-dangky/delete/" + id);
        }

        function  getSelectedCheckboxes(){

            var ids = '';
            $.each($("input[name='ck_value']:checked"), function(){
                ids += ($(this).attr('value')) + '-';
            });
            return ids = ids.substring(0, ids.length - 1);

        }

        function multiActivated() {

            var ids = getSelectedCheckboxes();
            var pl = $('#select_phanloai').val();
            if(ids == '') {
                $('#btnMultiActivated').attr('data-target', '#notid-modal-confirm');
            }else {
                $('#btnMultiActivated').attr('data-target', '#activated-modal-confirm');
                $('#frmActivated').attr('action', "{{ url('taikhoan-dangky/activated')}}/"+pl+'/' + ids );
            }

        }
        $(function(){

            $('#select_phanloai').change(function() {
                var type = $('#select_phanloai').val();
                var url = '/taikhoan-dangky/pl='+type;

                window.location.href = url;
            });
        })
    </script>

@stop

@section('content')
    <div class="page-content">
        <div id="" class="row">
            <div class="col-lg-12">
                <form id="view_user">
                    <div class="portlet box">
                        <div class="portlet-header">
                            <div class="caption">
                                <b>DANH SÁCH TÀI KHOẢN</b>
                            </div>
                            <div class="actions">
                                <button id="btnMultiActivated" type="button" onclick="multiActivated()" class="btn btn-warning btn-xs" data-target="#activated-modal-confirm" data-toggle="modal"><i class="fa fa-unlock"></i>&nbsp;
                                    Kích hoạt</button>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row mbm">
                                <div class="col-md-1">
                                    <div class="form-control-static"  style="white-space: nowrap;">Tài khoản</div>
                                </div>
                                <div class="col-md-5">
                                    <select id="select_phanloai" name="select_phanloai" class="form-control required">
                                        <option value="DVLT" {{ ($pl == 'DVLT') ? 'selected' : '' }}>Dịch vụ lưu trú</option>
                                        <option value="DVVT" {{ ($pl == 'DVVT') ? 'selected' : '' }}>Dịch vụ vận tải</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="table_id"class="table table-hover table-striped table-bordered table-advanced tablesorter">
                                            <thead>
                                                <tr>
                                                    <th style="width: 1%; padding: 10px; background: #efefef"><input type="checkbox" class="checkall"/></th>
                                                    <th>Tên doanh nghiệp </th>
                                                    <th>Mã số thuế </th>
                                                    <th>Địa chỉ</th>
                                                    <th>Phone</th>
                                                    <th>Fax</th>
                                                    <th>Giấy đăng ký kinh doanh</th>
                                                    <th style="width: 20%">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($model as $tt)
                                                <tr>
                                                    <td><input type="checkbox" type="checkbox" name = "ck_value"  id="ck_value" value="{{$tt->id}}"/></td>
                                                    <td>{{$tt->tendn}}</td>
                                                    <td>{{$tt->masothue}}</td>
                                                    <td>{{$tt->diachidn}}</td>
                                                    <td>{{$tt->teldn}}</td>
                                                    <td>{{$tt->faxdn}}</td>
                                                    <td>{{$tt->giayphepkd}}</td>
                                                    <td>
                                                        @if($tt->pl == 'DVLT')
                                                            <a href="" class="btn btn-info btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                                        @else
                                                            <a href="" class="btn btn-info btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('includes.e.modal-confirm')

@stop


