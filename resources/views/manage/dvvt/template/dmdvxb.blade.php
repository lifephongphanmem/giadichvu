<label class="form-control-label">Điểm xuất phát<span class="require">*</span></label>
{!!Form::text('diemdau', null, array('id' => 'diemdau','class' => 'form-control','required'=>'required'))!!}

<label class="form-control-label">Điểm cuối<span class="require">*</span></label>
{!!Form::text('diemcuoi', null, array('id' => 'diemcuoi','class' => 'form-control','required'=>'required'))!!}

<label class="form-control-label">Mô tả dịch vụ<span class="require">*</span></label>
{!!Form::text('tendichvu', null, array('id' => 'tendichvu','class' => 'form-control','required'=>'required'))!!}

<label class="form-control-label">Quy cách chất lượng dịch vụ</label>
{!!Form::textarea('qccl', null, array('id' => 'qccl','class' => 'form-control','rows'=>'2'))!!}

<label class="form-control-label">Đơn vị tính vé lượt<span class="require">*</span></label>
{!!Form::text('dvtluot', null, array('id' => 'dvtluot','class' => 'form-control','required'=>'required'))!!}

<label class="form-control-label">Đơn vị tính vé tháng<span class="require">*</span></label>
{!!Form::text('dvtthang', null, array('id' => 'dvtthang','class' => 'form-control','required'=>'required'))!!}

<label class="form-control-label">Ghi chú</label>
{!!Form::textarea('ghichu', null, array('id' => 'ghichu','class' => 'form-control','rows'=>'2'))!!}

<input type="hidden" id="madichvu" name="madichvu"/>
<input type="hidden" id="iddv" name="iddv"/>