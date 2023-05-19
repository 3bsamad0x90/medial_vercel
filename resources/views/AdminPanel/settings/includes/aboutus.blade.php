<div class="row">
    <div class="divider">
        <div class="divider-text"><b>{{ trans('common.aboutUs') }}</b></div>
    </div>
   <div class="col-12 col-md-6">
      <label class="form-label" for="aboutusTitle_ar">{{ trans('common.title_ar') }}</label>
      {{Form::text('aboutusTitle_ar',getSettingValue('aboutusTitle_ar'),['id'=>'aboutusTitle_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12  col-md-6">
      <label class="form-label" for="aboutusTitle_en">{{ trans('common.title_en') }}</label>
      {{Form::text('aboutusTitle_en',getSettingValue('aboutusTitle_en'),['id'=>'aboutusTitle_en','class'=>'form-control'])}}
    </div>
    <div class="col-12">
      <label class="form-label" for="aboutusDes_ar">{{ trans('common.description_ar') }}</label>
      {{Form::textarea('aboutusDes_ar',getSettingValue('aboutusDes_ar'),['rows'=>'3','id'=>'aboutusDes_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12">
      <label class="form-label" for="aboutusDes_en"{{ trans('common.description_en') }}/label>
      {{Form::textarea('aboutusDes_en',getSettingValue('aboutusDes_en'),['rows'=>'3','id'=>'aboutusDes_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
      <label class="form-label" for="aboutusImage">{{ trans('common.image') }}</label>
      {{Form::file('aboutusImage',['id'=>'aboutusImage','class'=>'form-control'])}}
    </div>
</div>
