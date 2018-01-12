<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Mô tả</label>
            {!!Form::text('mota',null, array('id' => 'mota','class' => 'form-control required'))!!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Từ ngày<span class="require">*</span></label>
            {!!Form::text('ngaytu',isset($model->ngaytu) ? date('d/m/Y',  strtotime($model->ngaytu)) : 'null', array('id' => 'tungay','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
        </div>
    </div>
    <!--/span-->
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Đến ngày</label>
            {!!Form::text('ngayden',isset($model->ngayden) ? date('d/m/Y',  strtotime($model->ngayden)) : 'null', array('id' => 'denngay','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
        </div>
    </div>
    <!--/span-->
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Số ngày nghỉ<span class="require">*</span></label>
            {!! Form::select(
            'songaynghi',
            $arraynn, isset($model->songaynghi) ? $model->songaynghi : 'null',
            array('id' => 'songaynghi', 'class' => 'form-control'))
            !!}
        </div>
    </div>
</div>