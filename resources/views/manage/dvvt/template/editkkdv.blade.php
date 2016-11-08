<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="inputLastName" class="control-label">Ngày kê khai<span class="require">*</span></label>
            <div>
                <input type="date" name="ngaynhap" id="ngaynhap" class="form-control required" value="{{$model->ngaynhap}}" autofocus>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label for="selGender" class="control-label">Ngày thực hiện mức giá kê khai</label>
            <div><input type="date" name="ngayhieuluc" id="ngayhieuluc" value="{{$model->ngayhieuluc}}" class="form-control required"></div>
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
                <input type="date" name="ngaynhaplk" id="ngaynhaplk" class="form-control" value="{{$model->ngaynhaplk}}">
            </div>
        </div>
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

