<div class="form-group">
<label class="form-control-label"><b>Điểm xuất phát</b></label>
{!!Form::text('diemdau', null, array('id' => 'diemdau','class' => 'form-control'))!!}
</div>
<div class="form-group">
<label class="form-control-label"><b>Điểm cuối</b></label>
{!!Form::text('diemcuoi', null, array('id' => 'diemcuoi','class' => 'form-control'))!!}
</div>
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
@include('manage.dvvt.template.dmdv')