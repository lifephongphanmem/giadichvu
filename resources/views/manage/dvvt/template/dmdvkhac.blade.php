<!--div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label"><b>Điểm xuất phát</b></label>
        {!!Form::text('diemdau', null, array('id' => 'diemdau','class' => 'form-control'))!!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label"><b>Điểm cuối</b></label>
        {!!Form::text('diemcuoi', null, array('id' => 'diemcuoi','class' => 'form-control'))!!}
        </div>
    </div>
</div-->
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label"><b>Loại xe</b><span class="require">*</span></label>
        {!! Form::select('loaixe',[
            'Xe tải 5 tạ' => 'Xe tải 5 tạ',
            'Xe tải 1,25 tấn' => 'Xe tải 1,25 tấn',
            'Xe tải 2,5 tấn' => 'Xe tải 2,5 tấn',
            'Xe tải 3,5 tấn' => 'Xe tải 3,5 tấn',
            'Xe tải 5 tấn' => 'Xe tải 5 tấn',
            'Xe tải 8 tấn' => 'Xe tải 8 tấn',
            'Xe tải 10 tấn' => 'Xe tải 10 tấn',
            'Xe tải 15 tấn' => 'Xe tải 15 tấn',
            'Xe tải 20 tấn' => 'Xe tải 20 tấn',
            'Chuyển phát nhanh' => 'Chuyển phát nhanh',
            'Chuyển phát hàng' => 'Chuyển phát hàng',
            'Loại xe khác' => 'Loại xe khác'
            ], null, ['id' => 'loaixe','class' => 'form-control','required'=>'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label"><b>Đơn vị tính</b><span class="require">*</span></label>
            {!!Form::text('dvt', null, array('id' => 'dvt','class' => 'form-control','required'=>'required'))!!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label"><b>Mô tả dịch vụ</b><span class="require">*</span></label>
            {!!Form::text('tendichvu', null, array('id' => 'tendichvu','class' => 'form-control','required'=>'required'))!!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label"><b>Quy cách chất lượng dịch vụ</b></label>
            {!!Form::textarea('qccl', null, array('id' => 'qccl','class' => 'form-control','rows'=>'2'))!!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label"><b>Ghi chú</b></label>
            {!!Form::textarea('ghichu', null, array('id' => 'ghichu','class' => 'form-control','rows'=>'2'))!!}
        </div>
    </div>
</div>
<input type="hidden" id="madichvu" name="madichvu"/>
<input type="hidden" id="iddv" name="iddv"/>


<!--@include('manage.dvvt.template.dmdv')-->