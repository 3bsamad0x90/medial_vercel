@extends('AdminPanel.layouts.master')
@section('content')


<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered mb-2">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">{{ trans('common.name') }}</th>
                            <th scope="col">{{ trans('common.description') }}</th>
                            <th scope="col">{{ trans('common.address') }}</th>
                            <th scope="col">{{ trans('common.image') }}</th>
                            <th>{{ trans('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($testimonials as $testimonial)
                        <tr id="row_{{$testimonial->id}}">
                            <td>
                                {{$testimonial['name_ar']}}<br>
                                {{$testimonial['name_en']}}
                            </td>
                            <td style="word-break: break-word;">
                                {{$testimonial->description_ar}}<br>
                                {{ $testimonial->description_en }}
                            </td>
                            <td style="word-break: break-word;">
                                {{$testimonial->address}}
                            </td>
                            <td>
                                <img src="{{ $testimonial->photoLink() }}" width="80px" height="80px" class="round border">

                            </td>
                            <td class="text-center">
                                <a href="javascript:;" data-bs-target="#edittestimonial{{$testimonial->id}}"
                                    data-bs-toggle="modal" class="btn btn-icon btn-info m-1" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-name="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>
                                <?php $delete = route('testimonials.delete',['testimonial'=>$testimonial->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger m-1"
                                    onclick="confirmDelete('{{$delete}}','{{$testimonial->id}}')" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-name="{{trans('common.delete')}}">
                                    <i data-feather='trash-2'></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center ">
                                <h2>{{trans('common.nothingToView')}}</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @foreach($testimonials as $testimonial)
            <div class="modal fade text-md-start" id="edittestimonial{{$testimonial->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">{{trans('common.edit')}}</h1>
                            </div>
                            {{Form::open(['url'=>route('testimonials.update',['testimonial'=>$testimonial->id]),
                            'id'=>'edittestimonialForm', 'class'=>'row gy-1 pt-75', 'files'=>true])}}
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="name_ar">{{ trans('common.name_ar') }}</label>
                                {{Form::text('name_ar',$testimonial->name_ar,['id'=>'name_ar',
                                'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="name_en">{{ trans('common.name_en') }}</label>
                                {{Form::text('name_en',$testimonial->name_en,['id'=>'name_en',
                                'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="description_ar">{{ trans('common.description_ar') }}</label>
                                {{Form::textarea('description_ar',$testimonial->description_ar,['id'=>'description_ar',
                                'class'=>'form-control', 'rows'=>3])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="description_en">{{ trans('common.description_en') }}</label>
                                {{Form::textarea('description_en',$testimonial->description_en,['id'=>'description_en',
                                'class'=>'form-control', 'rows'=>3])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="address">{{ trans('common.address') }}</label>
                                {{Form::text('address',$testimonial->address,['id'=>'address', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="image">{{ trans('common.image') }}</label>
                                {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
                            </div>

                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-primary me-1">حفظ التغييرات</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{trans('common.Cancel')}}
                                </button>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $testimonials->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
<!-- Bordered table end -->



@stop

@section('page_buttons')
<a href="javascript:;" data-bs-target="#createtestimonial" data-bs-toggle="modal" class="btn btn-primary">
    إضافة جديد
</a>

<div class="modal fade text-md-start" id="createtestimonial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">إضافة جديد</h1>
                </div>
                {{Form::open(['url'=>route('testimonials.store'), 'id'=>'createtestimonialForm', 'class'=>'row gy-1 pt-75',
                'files'=>true])}}
                <div class="col-12 col-md-6">
                    <label class="form-label" for="name_ar">{{ trans('common.name_ar') }}</label>
                    {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control'])}}
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="name_en">{{ trans('common.name_en') }}</label>
                    {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
                </div>

                <div class="col-12 col-md-12">
                    <label class="form-label" for="description_ar">{{ trans('common.description_ar') }}</label>
                    {{Form::textarea('description_ar','',['id'=>'description_ar', 'class'=>'form-control', 'rows'=>3])}}
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label" for="description_en">{{ trans('common.description_en') }}</label>
                    {{Form::textarea('description_en','',['id'=>'description_en', 'class'=>'form-control', 'rows'=>3])}}
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label" for="address">{{ trans('common.address') }}</label>
                    {{Form::text('address','',['id'=>'address', 'class'=>'form-control'])}}
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label" for="image">{{ trans('common.image') }}</label>
                    {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
                </div>


                <div class="col-12 text-center mt-2 pt-50">
                    <button type="submit" class="btn btn-primary me-1">حفظ التغييرات</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        {{trans('common.Cancel')}}
                    </button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>
    function removeItem(elem,id){
      const idItem = document.getElementById(id).src;
      const Item = document.getElementById(id);
      elem.remove();
      Item.remove();

}
</script>

@stop
