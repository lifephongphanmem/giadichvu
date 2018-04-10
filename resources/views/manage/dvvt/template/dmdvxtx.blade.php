<div class="form-group">
<label class="form-control-label"><b>Loại xe</b><span class="require">*</span></label>
{!! Form::select('loaixe',getLoaiXe(), null, ['id' => 'loaixe','class' => 'form-control','required'=>'required']) !!}
</div>

@include('manage.dvvt.template.dmdv')