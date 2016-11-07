<label class="form-control-label">Mô tả dịch vụ<span class="require">*</span></label>
{!!Form::text('tendichvu', null, array('id' => 'tendichvu','class' => 'form-control','required'=>'required'))!!}

<label class="form-control-label">Quy cách chất lượng dịch vụ</label>
{!!Form::textarea('qccl', null, array('id' => 'qccl','class' => 'form-control','rows'=>'2'))!!}

<label class="form-control-label">Đơn vị tính<span class="require">*</span></label>
{!!Form::text('dvt', null, array('id' => 'dvt','class' => 'form-control','required'=>'required'))!!}

<label class="form-control-label">Ghi chú</label>
{!!Form::textarea('ghichu', null, array('id' => 'ghichu','class' => 'form-control','rows'=>'2'))!!}

<input type="hidden" id="madichvu" name="madichvu"/>
<input type="hidden" id="iddv" name="iddv"/>