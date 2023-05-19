<div class="row">
    <div class="col-12 col-md-6">
        <label class="form-label" for="featureTitle_ar">{{ trans('common.title_ar') }}</label>
        {{Form::text('featureTitle_ar',getSettingValue('featureTitle_ar'),['id'=>'featureTitle_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12  col-md-6">
        <label class="form-label" for="featureTitle_en">{{ trans('common.title_en') }}</label>
        {{Form::text('featureTitle_en',getSettingValue('featureTitle_en'),['id'=>'featureTitle_en','class'=>'form-control'])}}
    </div>
    <div class="col-12">
        <label class="form-label" for="featureDes_ar">{{ trans('common.description_ar') }}</label>
        {{Form::textarea('featureDes_ar',getSettingValue('featureDes_ar'),['rows'=>'3','id'=>'featureDes_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12">
        <label class="form-label" for="featureDes_en">{{ trans('common.description_en') }}</label>
        {{Form::textarea('featureDes_en',getSettingValue('featureDes_en'),['rows'=>'3','id'=>'featureDes_en','class'=>'form-control'])}}
    </div>
    <div class="divider">
        <div class="divider-text"><b>{{ trans('common.details') }}</b></div>
    </div>
    @for($i=1;$i<=6;$i++)
        <div class="row pt-2 pb-4">
            <h3>{{ trans('common.icon') }} #{{$i}}</h3>
            <div class="col-md-4 text-center">
                {!! getSettingImageValue('feature'.$i.'icon') !!}
                <div class="file-loading">
                    <input class="files" name="feature{{$i}}icon" type="file">
                </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="feature{{$i}}title_ar">#{{ $i }} {{ trans('common.title_ar') }} </label>
                {{Form::text('feature_'.$i.'title_ar',getSettingValue('feature_'.$i.'title_ar'),['id'=>'feature'.$i.'title_ar','class'=>'form-control'])}}
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="feature{{$i}}title_en">#{{ $i }} {{ trans('common.title_en') }} </label>
                {{Form::text('feature_'.$i.'title_en',getSettingValue('feature_'.$i.'title_en'),['id'=>'feature'.$i.'title_en','class'=>'form-control'])}}
            </div>

            <div class="col-md-12"></div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="feature{{$i}}des_ar">#{{ $i }} {{ trans('common.description_ar') }}</label>
                {{Form::textarea('feature_'.$i.'des_ar',getSettingValue('feature_'.$i.'des_ar'),['id'=>'feature'.$i.'des_ar','class'=>'form-control','rows'=>'3'])}}
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="feature{{$i}}des_en">#{{ $i }} {{ trans('common.description_en') }}</label>
                {{Form::textarea('feature_'.$i.'des_en',getSettingValue('feature_'.$i.'des_en'),['id'=>'feature'.$i.'des_en','class'=>'form-control','rows'=>'3'])}}
            </div>
        </div>
    @endfor
</div>
