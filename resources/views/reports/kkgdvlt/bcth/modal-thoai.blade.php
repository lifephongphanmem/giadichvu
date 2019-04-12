
<script>
    function ClickBC1(url){
        $('#frm_bc1').attr('action',url);
        $('#frm_bc1').submit();
    }
    function ClickBC1_excel(url){
        $('#frm_bc1').attr('action',url);
        $('#frm_bc1').submit();
    }

    function ClickBC2(url){
        $('#frm_bc2').attr('action',url);
        $('#frm_bc2').submit();
    }
    function ClickBC2_excel(url){
        $('#frm_bc2').attr('action',url);
        $('#frm_bc2').submit();
    }

    function ClickBC3(url){
        $('#frm_bc3').attr('action',url);
        $('#frm_bc3').submit();
    }
    function ClickBC3_excel(url){
        $('#frm_bc3').attr('action',url);
        $('#frm_bc3').submit();
    }

    function ClickBC4(url){
        $('#frm_bc4').attr('action',url);
        $('#frm_bc4').submit();
    }
    function ClickBC4_excel(url){
        $('#frm_bc4').attr('action',url);
        $('#frm_bc4').submit();
    }

    function ClickBC5(url){
        $('#frm_bc5').attr('action',url);
        $('#frm_bc5').submit();
    }
    function ClickBC5_excel(url){
        $('#frm_bc5').attr('action',url);
        $('#frm_bc5').submit();
    }
    function ClickBC6(url){
        $('#frm_bc6').attr('action',url);
        $('#frm_bc6').submit();
    }
    function ClickBC6_excel(url){
        $('#frm_bc6').attr('action',url);
        $('#frm_bc6').submit();
    }

    function ClickBC7(url){
        $('#frm_bc7').attr('action',url);
        $('#frm_bc7').submit();
    }

    function ClickBC8(url){
        $('#frm_bc8').attr('action',url);
        $('#frm_bc8').submit();
    }
    function ClickBC9(url){
        $('#frm_bc9').attr('action',url);
        $('#frm_bc9').submit();
    }
    function ClickBC12(url){
        $('#frm_bc12').attr('action',url);
        $('#frm_bc12').submit();
    }
</script>

<!--Modal Thoại BC1-->
<div id="BC1-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC1','target'=>'_blank' , 'id' => 'frm_bc1', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp hồ sơ kê khai giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Loại hạng</b></label>
                        <div class="col-md-6 ">
                            <select id="loaihang" name="loaihang" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="1">1 sao</option>
                                <option value="1.5">1.5 sao</option>
                                <option value="2">2 sao</option>
                                <option value="2.5">2.5 sao</option>
                                <option value="3">3 sao</option>
                                <option value="3.5">3.5 sao</option>
                                <option value="4">4 sao</option>
                                <option value="4.5">4.5 sao</option>
                                <option value="5">5 sao</option>
                                <option value="K">Khác (Nhà nghỉ)</option>
                            </select>
                        </div>
                    </div>

                    @if(session('admin')->level == 'T')
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đơn vị chủ quản</b></label>
                        <div class="col-md-6 ">
                            <select class="form-control select2me" name="cqcq" id="cqcq">
                                <option value="all">--Tất cả--</option>
                                @foreach($model as $cqcq)
                                    <option value="{{$cqcq->maqhns}}">{{$cqcq->tendv}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC1('/reports/dich_vu_luu_tru/BC1')">Đồng ý</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC1_excel('/reports/dich_vu_luu_tru/BC1_excel')">Xuất Excel</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </form>
</div>
<!--Modal Thoại Bc2-->
<div id="BC2-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC2','target'=>'_blank' , 'id' => 'frm_bc2', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo chi tiết hồ sơ kê khai giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Tháng</b></label>
                        <div class="col-md-6 ">
                            <select name="thang" id="thang" class="form-control">
                                <option value="01" {{date('m') == '01' ? 'selected' : ''}}>Tháng 01</option>
                                <option value="02" {{date('m')  == '02' ? 'selected' : ''}}>Tháng 02</option>
                                <option value="03" {{date('m')  == '03' ? 'selected' : ''}}>Tháng 03</option>
                                <option value="04" {{date('m')  == '04' ? 'selected' : ''}}>Tháng 04</option>
                                <option value="05" {{date('m')  == '05' ? 'selected' : ''}}>Tháng 05</option>
                                <option value="06" {{date('m')  == '06' ? 'selected' : ''}}>Tháng 06</option>
                                <option value="07" {{date('m')  == '07' ? 'selected' : ''}}>Tháng 07</option>
                                <option value="08" {{date('m')  == '08' ? 'selected' : ''}}>Tháng 08</option>
                                <option value="09" {{date('m')  == '09' ? 'selected' : ''}}>Tháng 09</option>
                                <option value="10" {{date('m')  == '10' ? 'selected' : ''}}>Tháng 10</option>
                                <option value="11" {{date('m')  == '11' ? 'selected' : ''}}>Tháng 11</option>
                                <option value="12" {{date('m')  == '12' ? 'selected' : ''}}>Tháng 12</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Năm</b></label>
                        <div class="col-md-6 ">
                            <select name="nam" id="nam" class="form-control">
                                @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                @for($i = $nam_start; $i <= $nam_stop; $i++)
                                    <option value="{{$i}}" {{$i == date('Y') ? 'selected' : ''}}>Năm {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Loại hạng</b></label>
                        <div class="col-md-6 ">
                            <select id="loaihang" name="loaihang" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="1">1 sao</option>
                                <option value="1.5">1.5 sao</option>
                                <option value="2">2 sao</option>
                                <option value="2.5">2.5 sao</option>
                                <option value="3">3 sao</option>
                                <option value="3.5">3.5 sao</option>
                                <option value="4">4 sao</option>
                                <option value="4.5">4.5 sao</option>
                                <option value="5">5 sao</option>
                                <option value="K">Khác (Nhà nghỉ)</option>
                            </select>
                        </div>
                    </div>

                    @if(session('admin')->level == 'T')
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Đơn vị</b></label>
                            <div class="col-md-6 ">
                                <select class="form-control" name="cqcq" id="cqcq">
                                    <option value="all">--Tất cả--</option>
                                    @foreach($model as $cqcq)
                                        <option value="{{$cqcq->maqhns}}">{{$cqcq->tendv}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC2('/reports/dich_vu_luu_tru/BC2')">Đồng ý</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC2_excel('/reports/dich_vu_luu_tru/BC2_excel')">Xuất Excel</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!--Modal Thoại BC3-->
<div id="BC3-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC3','target'=>'_blank' , 'id' => 'frm_bc3', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp hồ sơ kê khai giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Loại hạng</b></label>
                        <div class="col-md-6 ">
                            <select id="loaihang" name="loaihang" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="1">1 sao</option>
                                <option value="1.5">1.5 sao</option>
                                <option value="2">2 sao</option>
                                <option value="2.5">2.5 sao</option>
                                <option value="3">3 sao</option>
                                <option value="3.5">3.5 sao</option>
                                <option value="4">4 sao</option>
                                <option value="4.5">4.5 sao</option>
                                <option value="5">5 sao</option>
                                <option value="K">Khác (Nhà nghỉ)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đơn vị</b></label>
                        <div class="col-md-6">
                            <select class="form-control select2me" name="masothue" id="masothue">
                                @foreach($model_donvi as $cqcq)
                                    <option value="{{$cqcq->masothue}}">{{$cqcq->tendn}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC3('/reports/dich_vu_luu_tru/BC3')">Đồng ý</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC3_excel('/reports/dich_vu_luu_tru/BC3_excel')">Xuất Excel</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </form>
</div>
<!--Modal Thoại Bc4-->
<div id="BC4-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC4','target'=>'_blank' , 'id' => 'frm_bc4', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo chi tiết hồ sơ kê khai giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Loại hạng</b></label>
                        <div class="col-md-6 ">
                            <select id="loaihang" name="loaihang" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="1">1 sao</option>
                                <option value="1.5">1.5 sao</option>
                                <option value="2">2 sao</option>
                                <option value="2.5">2.5 sao</option>
                                <option value="3">3 sao</option>
                                <option value="3.5">3.5 sao</option>
                                <option value="4">4 sao</option>
                                <option value="4.5">4.5 sao</option>
                                <option value="5">5 sao</option>
                                <option value="K">Khác (Nhà nghỉ)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đơn vị</b></label>
                        <div class="col-md-6">
                            <select class="form-control select2me" name="masothue" id="masothue">
                                @foreach($model_donvi as $cqcq)
                                    <option value="{{$cqcq->masothue}}">{{$cqcq->tendn}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC4('/reports/dich_vu_luu_tru/BC4')">Đồng ý</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC4_excel('/reports/dich_vu_luu_tru/BC4_excel')">Xuất Excel</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </form>
</div>
<!--Modal Thoại BC5-->
<div id="BC5-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC5','target'=>'_blank' , 'id' => 'frm_bc5', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp hồ sơ kê khai giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Loại hạng</b></label>
                        <div class="col-md-6 ">
                            <select id="loaihang" name="loaihang" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="1">1 sao</option>
                                <option value="1.5">1.5 sao</option>
                                <option value="2">2 sao</option>
                                <option value="2.5">2.5 sao</option>
                                <option value="3">3 sao</option>
                                <option value="3.5">3.5 sao</option>
                                <option value="4">4 sao</option>
                                <option value="4.5">4.5 sao</option>
                                <option value="5">5 sao</option>
                                <option value="K">Khác (Nhà nghỉ)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Phân loại hồ sơ</b></label>
                        <div class="col-md-6 ">
                            <select id="thoihan" name="thoihan" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="Trước thời hạn">Trước thời hạn</option>
                                <option value="Đúng thời hạn">Đúng thời hạn</option>
                                <option value="Quá thời hạn">Quá thời hạn</option>
                            </select>
                        </div>
                    </div>

                    @if(session('admin')->level == 'T')
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Đơn vị chủ quản</b></label>
                            <div class="col-md-6 ">
                                <select class="form-control select2me" name="cqcq" id="cqcq">
                                    <option value="all">--Tất cả--</option>
                                    @foreach($model as $cqcq)
                                        <option value="{{$cqcq->maqhns}}">{{$cqcq->tendv}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC5('/reports/dich_vu_luu_tru/BC5')">Đồng ý</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC5_excel('/reports/dich_vu_luu_tru/BC5_excel')">Xuất Excel</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </form>
</div>
<!--Modal Thoại BC6-->
<div id="BC6-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC6','target'=>'_blank' , 'id' => 'frm_bc6', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo đơn vị kê khai giá dịch vụ lưu trú</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>

                    <!--div class="form-group">
                        <label class="col-md-4 control-label"><b>Loại hạng</b></label>
                        <div class="col-md-6 ">
                            <select id="loaihang" name="loaihang" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="1">1 sao</option>
                                <option value="2">2 sao</option>
                                <option value="3">3 sao</option>
                                <option value="4">4 sao</option>
                                <option value="5">5 sao</option>
                                <option value="K">Khác (Nhà nghỉ)</option>
                                <option value="CXD">Chưa xác định (Khách sạn chưa xác định sao)</option>
                            </select>
                        </div>
                    </div-->

                    @if(session('admin')->level == 'T')
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Đơn vị chủ quản</b></label>
                            <div class="col-md-6 ">
                                <select class="form-control select2me" name="cqcq" id="cqcq">
                                    @foreach($model as $cqcq)
                                        <option value="{{$cqcq->maqhns}}">{{$cqcq->tendv}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Phân loại</b></label>
                        <div class="col-md-6 ">
                            <select id="phanloai" name="phanloai" class="form-control">
                                <option value="all">--Tất cả--</option>
                                <option value="CKK">Chưa kê khai</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC6('/reports/dich_vu_luu_tru/BC6')">Đồng ý</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC6_excel('/reports/dich_vu_luu_tru/BC6_excel')">Xuất Excel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!--Modal Thoại Bc7-->
<div id="BC7-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC7','target'=>'_blank' , 'id' => 'frm_bc7', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo xét duyệt hồ sơ kê khai giá dịch vụ lưu trú</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Tháng</b></label>
                        <div class="col-md-6 ">
                            <select name="thang" id="thang" class="form-control">
                                <option value="01" {{date('m') == '01' ? 'selected' : ''}}>Tháng 01</option>
                                <option value="02" {{date('m')  == '02' ? 'selected' : ''}}>Tháng 02</option>
                                <option value="03" {{date('m')  == '03' ? 'selected' : ''}}>Tháng 03</option>
                                <option value="04" {{date('m')  == '04' ? 'selected' : ''}}>Tháng 04</option>
                                <option value="05" {{date('m')  == '05' ? 'selected' : ''}}>Tháng 05</option>
                                <option value="06" {{date('m')  == '06' ? 'selected' : ''}}>Tháng 06</option>
                                <option value="07" {{date('m')  == '07' ? 'selected' : ''}}>Tháng 07</option>
                                <option value="08" {{date('m')  == '08' ? 'selected' : ''}}>Tháng 08</option>
                                <option value="09" {{date('m')  == '09' ? 'selected' : ''}}>Tháng 09</option>
                                <option value="10" {{date('m')  == '10' ? 'selected' : ''}}>Tháng 10</option>
                                <option value="11" {{date('m')  == '11' ? 'selected' : ''}}>Tháng 11</option>
                                <option value="12" {{date('m')  == '12' ? 'selected' : ''}}>Tháng 12</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Năm</b></label>
                        <div class="col-md-6 ">
                            <select name="nam" id="nam" class="form-control">
                                @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                @for($i = $nam_start; $i <= $nam_stop; $i++)
                                    <option value="{{$i}}" {{$i == date('Y') ? 'selected' : ''}}>Năm {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    @if(session('admin')->level == 'T')
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Đơn vị</b></label>
                            <div class="col-md-6 ">
                                <select class="form-control" name="cqcq" id="cqcq">
                                    @foreach($model as $cqcq)
                                        <option value="{{$cqcq->maqhns}}">{{$cqcq->tendv}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC7('/reports/dich_vu_luu_tru/BC7')">Đồng ý</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!--Modal Thoại BC8-->
<div id="BC8-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC8','target'=>'_blank' , 'id' => 'frm_bc8', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp hồ sơ kê khai giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-6 ">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Loại hạng</b></label>
                        <div class="col-md-6 ">
                            <select id="loaihang" name="loaihang" class="form-control select2me">
                                <option value="all">--Tất cả--</option>
                                <option value="1">1 sao</option>
                                <option value="1.5">1.5 sao</option>
                                <option value="2">2 sao</option>
                                <option value="2.5">2.5 sao</option>
                                <option value="3">3 sao</option>
                                <option value="3.5">3.5 sao</option>
                                <option value="4">4 sao</option>
                                <option value="4.5">4.5 sao</option>
                                <option value="5">5 sao</option>
                                <option value="K">Khác (Nhà nghỉ)</option>
                            </select>
                        </div>
                    </div>

                    @if(session('admin')->level == 'T')
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Đơn vị chủ quản</b></label>
                            <div class="col-md-6 ">
                                <select class="form-control select2me" name="cqcq" id="cqcq">
                                    <option value="all">--Tất cả--</option>
                                    @foreach($model as $cqcq)
                                        <option value="{{$cqcq->maqhns}}">{{$cqcq->tendv}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC8('/reports/dich_vu_luu_tru/BC8')">Đồng ý</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC1_excel('/reports/dich_vu_luu_tru/BC1_excel')">Xuất Excel</button-->
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!--Modal Thoại Bc9-->
<div id="BC9-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC9','target'=>'_blank' , 'id' => 'frm_bc9', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo chi tiết hồ sơ kê khai giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-8">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-8">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Cơ sở kinh doanh</b></label>
                        <div class="col-md-8">
                            <select class="form-control select2me" name="macskd" id="macskd">
                                @foreach($model_cskd as $cskd)
                                    <option value="{{$cskd->macskd}}">{{$cskd->tencskd}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC9('/reports/dich_vu_luu_tru/BC9')">Đồng ý</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC4_excel('/reports/dich_vu_luu_tru/BC4_excel')">Xuất Excel</button-->
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!--Modal Thoại Bc12-->
<div id="BC12-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/reports/dich_vu_luu_tru/BC12','target'=>'_blank' , 'id' => 'frm_bc12', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo hồ sơ trả lại</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Từ ngày</b></label>
                        <div class="col-md-8">
                            <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><b>Đến ngày</b></label>
                        <div class="col-md-8">
                            <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC12('/reports/dich_vu_luu_tru/BC12')">Đồng ý</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBC4_excel('/reports/dich_vu_luu_tru/BC4_excel')">Xuất Excel</button-->
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickPL1Excel('/reports/tt55-2011-BTC/PL1Excel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>