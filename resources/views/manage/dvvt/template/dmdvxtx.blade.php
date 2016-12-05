<div class="form-group">
<label class="form-control-label"><b>Loại xe</b><span class="require">*</span></label>
{!! Form::select('loaixe',[
'Xe 4 chỗ' => 'Xe 4 chỗ',
'Xe 7 chỗ' => 'Xe 7 chỗ',
'Xe 16 chỗ' => 'Xe 16 chỗ',
'Xe 29 chỗ' => 'Xe 29 chỗ',
'Xe 45 chỗ' => 'Xe 45 chỗ',
'Loại xe khác' => 'Loại xe khác'
], null, ['id' => 'loaixe','class' => 'form-control','required'=>'required']) !!}
</div>

@include('manage.dvvt.template.dmdv')