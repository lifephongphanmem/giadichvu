<label class="form-control-label">Điểm xuất phát</label>
{!!Form::text('diemdau', null, array('id' => 'diemdau','class' => 'form-control'))!!}

<label class="form-control-label">Điểm cuối</label>
{!!Form::text('diemcuoi', null, array('id' => 'diemcuoi','class' => 'form-control'))!!}

<label class="form-control-label">Loại xe<span class="require">*</span></label>
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

@include('manage.dvvt.template.dmdv')