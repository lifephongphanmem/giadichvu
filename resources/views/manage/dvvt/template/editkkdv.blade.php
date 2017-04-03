<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="inputLastName" class="control-label">Ngày kê khai<span class="require">*</span></label>
            <div>
                {!!Form::text('ngaynhap',date('d/m/Y',  strtotime($model->ngaynhap)), array('id' => 'ngaynhap','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required','autofocus'))!!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label for="selGender" class="control-label">Ngày thực hiện mức giá kê khai</label>
            <div>
                {!!Form::text('ngayhieuluc',date('d/m/Y',  strtotime($model->ngayhieuluc)), array('id' => 'ngayhieuluc','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="inputEmail" class="control-label">Số công văn<span class="require">*</span></label>
            <div>
                <input type="text" name="socv" id="socv" value="{{$model->socv}}" class="form-control required">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label for="inputEmail" class="control-label">Số công văn liền kề</label>
            <div>
                <input type="text" name="socvlk" id="socvlk" class="form-control" value="{{$model->socvlk}}">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="inputEmail" class="control-label">Ngày nhập số công văn liền kề</label>
            <div>
                {!!Form::text('ngaynhaplk',($model->ngaynhaplk != '' ? date('d/m/Y',  strtotime($model->ngaynhaplk)) : ''), array('id' => 'ngaynhaplk','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>
    </div>
    <div class="col-md-6 text-right">
        <button type="button" data-target="#modal-dichvu" data-toggle="modal" class="btn btn-default" onclick="clearForm()"><i class="fa fa-plus"></i>&nbsp;Kê khai bổ dịch vụ</button>
    </div>
</div>

@yield('content-dv')

<div class="row">
    <div class="col-md-12">
        <div class="form-group"><label for="selGender" class="control-label">Các yếu tố chi phí cấu thành giá (đối với kê khai lần đầu); phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá tác động làm tăng hoặc giảm giá (đối với kê khai lại).</label>
            <div>
                <textarea id="ghichu" class="form-control" name="ghichu" cols="30" rows="3">{{$model->ghichu}}</textarea>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group"><label for="selGender" class="control-label">Các trường hợp ưu đãi, giảm giá; điều kiện áp dụng giá (nếu có).</label>
            <div>
                <textarea id="uudai" class="form-control" name="uudai" cols="30" rows="3">{{$model->uudai}}</textarea>
            </div>
        </div>
    </div>
</div>

