@extends('admin.layouts.app')
@section('content')

<!-- Latest obituaries -->
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Obituaries List')}}
                </div>
                <span class="card-subtitle">
                    {{__('Take control of your web application.')}}
                </span>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('admin.obituary.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        {{__('Add New Obituary')}}
                    </a>
                    <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ route('admin.obituary.destroyall') }}">
                        {{__('Delete All Selected')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    {{__('Obituaries')}}
                </h2>
            </div>

            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th class="w-1">{{__('ID')}}</th>
                        <th>{{__('Thumb')}}</th>
                        <th>{{__('Name of Deceased')}}</th>
                        <th>{{__('Posted by')}}</th>
                        <th>{{__('Category')}}</th>
                        <th>{{__('Slug')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obituaries as $key => $item)
                    <tr id="tr_{{ $item->id }}">
                        <td>
                            <input type="checkbox" class="sub_chk" data-id="{{ $item->id }}">
                        </td>
                        <td class="text-muted">
                            {{ $item->id }}
                        </td>
                        <td class="">
                            <span class="avatar" style="background-image: url({{ asset($item->getThumb()) }})"></span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">
                                {{ $item->title }}
                            </span>
                        </td>
                        <td>
                            <a href="" class="font-weight-bold">
                                @if(!is_null($item->user_id))
                                {{ $item->user->name }}
                                @endif
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.categories', '/#cat-'.$item->category->id) }}" class="font-weight-bold">
                                {{ $item->category->name }}
                            </a>
                        </td>
                        <td>
                            <em class="text-muted font-weight-bold">
                                {{ $item->slug }}
                            </em>
                        </td>
                        <td>
                            {{ $item->created_at }}
                        </td>

                        <td>
                            <a href="javascript:void(0);" onclick="updateStatusPost({{ $item->id }}, 'item')" class="text-decoration-none" id="status-post-{{ $item->id }}">
                                <span id="status-post-{{ $item->id }}">@if($item->getStatus()) <span class="badge bg-green-lt">{{__('active')}}</span> @else <span class="badge bg-red-lt">{{__('Disabled')}}</span> @endif</span>
                            </a>
                        </td>

                        <td class="text-end">
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('admin.obituary.edit', $item->id) }}">
	                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                        {{__('Edit')}}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.obituary.download', $item->id) }}">
	                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                        {{__('Download PDF')}}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.obituary.destroy', $item->id) }}" data-tr="tr_{{ $item->id }}"
                                        data-toggle="confirmation"
                                        data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                        data-btn-ok-class="btn btn-sm btn-danger"
                                        data-btn-cancel-label="Cancel"
                                        data-btn-cancel-icon="fa fa-chevron-circle-left"
                                        data-btn-cancel-class="btn btn-sm btn-default"
                                        data-title="Are you sure you want to delete ?"
                                        data-placement="left" data-singleton="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        {{__('Delete')}}
                                    </a>
                                </div>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $obituaries->links() }}
        
    </div>
</div>

@endsection