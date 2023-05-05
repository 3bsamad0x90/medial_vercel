@extends('AdminPanel.layouts.master')
@section('content')


<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <small class="validity text-danger"> * {{trans('common.maxNumber') }} * </small>
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
                            <th scope="col">{{ trans('common.title') }}</th>
                            <th scope="col">{{ trans('common.description') }}</th>
                            <th scope="col">{{ trans('common.image') }}</th>
                            <th>{{ trans('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($mainPages as $mainPage)
                        <tr id="row_{{$mainPage->id}}">
                            <td>
                                {{$mainPage['title_ar']}}<br>
                                {{$mainPage['title_en']}}
                            </td>
                            <td style="word-break: break-word;">
                                {{$mainPage->description_ar}}<br>
                                {{ $mainPage->description_en }}
                            </td>
                            <td>
                                <img src="{{ $mainPage->photoLink() }}" width="80px" height="80px" class="round border">

                            </td>
                            <td class="text-center">
                                <a href="javascript:;" data-bs-target="#editmainPage{{$mainPage->id}}"
                                    data-bs-toggle="modal" class="btn btn-icon btn-info m-1" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-name="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>
                                <?php $delete = route('mainPages.delete',['mainPage'=>$mainPage->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger m-1"
                                    onclick="confirmDelete('{{$delete}}','{{$mainPage->id}}')" data-bs-toggle="tooltip"
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

            @foreach($mainPages as $mainPage)
            <div class="modal fade text-md-start" id="editmainPage{{$mainPage->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">{{trans('common.edit')}}</h1>
                            </div>
                            {{Form::open(['url'=>route('mainPages.update',['mainPage'=>$mainPage->id]),
                            'id'=>'editmainPageForm', 'class'=>'row gy-1 pt-75', 'files'=>true])}}
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="title_ar">{{ trans('common.title_ar') }}</label>
                                {{Form::text('title_ar',$mainPage->title_ar,['id'=>'title_ar',
                                'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="title_en">{{ trans('common.title_en') }}</label>
                                {{Form::text('title_en',$mainPage->title_en,['id'=>'title_en',
                                'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="description_ar">{{ trans('common.description_ar') }}</label>
                                {{Form::textarea('description_ar',$mainPage->description_ar,['id'=>'description_ar',
                                'class'=>'form-control', 'rows'=>3])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="description_en">{{ trans('common.description_en') }}</label>
                                {{Form::textarea('description_en',$mainPage->description_en,['id'=>'description_en',
                                'class'=>'form-control', 'rows'=>3])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="image">{{ trans('common.image') }}</label>
                                {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
                            </div>

                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-primary me-1">{{ trans('common.Save Changes') }}</button>
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
            {{ $mainPages->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
<!-- Bordered table end -->



@stop
@section('page_buttons')
@if($mainPages->count() < 11)
<a href="javascript:;" data-bs-target="#createmainPage" data-bs-toggle="modal" class="btn btn-primary">
    {{ trans('common.CreateNew') }}
</a>
@endif
<div class="modal fade text-md-start" id="createmainPage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{ trans('common.CreateNew') }}</h1>
                </div>
                {{Form::open(['url'=>route('mainPages.store'), 'id'=>'createmainPageForm', 'class'=>'row gy-1 pt-75',
                'files'=>true])}}
                <div class="col-12 col-md-6">
                    <label class="form-label" for="title_ar">{{ trans('common.title_ar') }}</label>
                    {{Form::text('title_ar','',['id'=>'title_ar', 'class'=>'form-control'])}}
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="title_en">{{ trans('common.title_en') }}</label>
                    {{Form::text('title_en','',['id'=>'title_en', 'class'=>'form-control'])}}
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
                    <label class="form-label" for="image">{{ trans('common.image') }}</label>
                    {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
                </div>
                <div class="col-12 text-center mt-2 pt-50">
                    <button type="submit" class="btn btn-primary me-1">{{ trans('common.Save Changes') }}</button>
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
