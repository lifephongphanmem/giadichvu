<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <select name="namhs" id="namhs" class="form-control">
                @if ($nam_start = intval(date('Y')) - 5 ) @endif
                @if ($nam_stop = intval(date('Y')) ) @endif
                @for($i = $nam_start; $i <= $nam_stop; $i++)
                    <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>Năm {{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <select class="form-control select2me" id="masothue" name="masothue">
                <option value="all" selected>-- Nhập thông tin doanh nghiệp --</option>
                @foreach($m_dv as $dv)
                    <option value="{{$dv->masothue}}" {{$dv->masothue==$masothue?'selected':''}}>{{$dv->tendonvi}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-body">
                <div class="portlet-body">
                    <table id="sample_3"class="table table-hover table-striped table-bordered table-advanced tablesorter">
                        <thead>
                            <tr style="text-align: center">
                                <th style="text-align: center">STT</th>
                                <th style="text-align: center">Tên đơn vị</th>
                                <th style="text-align: center">Ngày kê khai</th>
                                <th style="text-align: center">Ngày thực hiện<br>mức giá kê khai</th>
                                <th style="text-align: center">Số công văn</th>
                                <th style="text-align: center">Số công văn</br>liền kề</th>
                                <th width="20%">Thao tác</th>
                            </tr>
                            </thead>
                        <?php $i=1?>
                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$i++}}</td>
                                    <td class="active">{{$tt->tendonvi}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                    <td style="text-align: center" class="active">{{$tt->socv}}</td>
                                    <td style="text-align: center">{{$tt->socvlk}}</td>
                                    <td>
                                        <a href="{{url($url.'in/'.$tt->masokk)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
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

