<div class="form-group">
    <label class="form-control-label"><b>Mô tả dịch vụ</b><span class="require">*</span></label>
    {!!Form::text('tendichvu', null, array('id' => 'tendichvu','class' => 'form-control','required'=>'required'))!!}
</div>
<div class="form-group">
    <label class="form-control-label"><b>Quy cách chất lượng dịch vụ</b></label>
    {!!Form::textarea('qccl', null, array('id' => 'qccl','class' => 'form-control','rows'=>'2'))!!}
</div>
<div class="form-group">
    <label class="form-control-label"><b>Đơn vị tính</b><span class="require">*</span></label>
    {!!Form::text('dvt', null, array('id' => 'dvt','class' => 'form-control','required'=>'required'))!!}
</div>
<div class="form-group">
    <label class="form-control-label"><b>Ghi chú</b></label>
    {!!Form::textarea('ghichu', null, array('id' => 'ghichu','class' => 'form-control','rows'=>'2'))!!}
</div>
<input type="hidden" id="madichvu" name="madichvu"/>
<input type="hidden" id="iddv" name="iddv"/>