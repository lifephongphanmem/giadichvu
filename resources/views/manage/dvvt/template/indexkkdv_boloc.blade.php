<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <select name="namhs" id="namhs" class="form-control">
                @if ($nam_start = intval(date('Y')) - 5 ) @endif
                @if ($nam_stop = intval(date('Y')) ) @endif
                @for($i = $nam_start; $i <= $nam_stop; $i++)
                    <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>Năm {{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>