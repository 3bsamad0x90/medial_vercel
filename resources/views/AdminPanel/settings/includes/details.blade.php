<div class="row">
    <div class="divider">
        <div class="divider-text"><b>{{ trans('common.detailsSection') }}</b></div>
    </div>
   @for($i=1; $i <= 4; $i++)
        <div class="col-12 col-md-12">
            <label class="form-label" for="details{{$i}}number">#{{ $i }} {{ trans('common.number') }}</label>
            {{Form::number('details_'.$i.'number',getSettingValue('details_'.$i.'number'),['id'=>'details'.$i.'number','class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label" for="details{{$i}}title_ar">#{{ $i }} {{ trans('common.text_ar') }}</label>
            {{Form::text('details_'.$i.'title_ar',getSettingValue('details_'.$i.'title_ar'),['id'=>'details'.$i.'title_ar','class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label" for="details{{$i}}title_en">#{{ $i }} {{ trans('common.text_ar') }}</label>
            {{Form::text('details_'.$i.'title_en',getSettingValue('details_'.$i.'title_en'),['id'=>'details'.$i.'title_en','class'=>'form-control'])}}
        </div>
        <div class="divider">
            <div class="divider-text"><b>----</b></div>
        </div>
   @endfor

    <div class="col-md-3 text-center">
        <label class="form-label" for="detailsImage">{{ trans('common.image') }}</label>
        {!! getSettingImageValue('detailsImage') !!}
        <div class="file-loading">
            <input class="files" name="detailsImage" type="file">
        </div>
    </div>
</div>
