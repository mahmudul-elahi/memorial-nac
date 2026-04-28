@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Categories')}}
                </div>
                <span class="card-subtitle">
                    {{__('Take control of your web application.')}}
                </span>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                   <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                       {{__('Add New Category')}}
                   </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card table-responsive">
            <div class="card-header">
                <h2 class="card-title">
                    {{__('Categories')}}
                </h2>
            </div>
            
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th class="w-1">{{__('ID')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Slug')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr id="cat-{{ $category->id }}">
                        <td class="text-muted">
                            {{ $category->id }}
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">
                                {{ $category->name }}
                            </span>
                        </td>
                        <td>
                            <span class="text-muted">
                                {{ Str::limit($category->description, 100, '...') }}
                            </span>
                        </td>
                        <td>
                            <em class="text-muted">
                                {{ $category->slug }}
                            </em>
                        </td>
                        <td>
                            {{ $category->created_at }}
                        </td>

                        <td>
                            <a href="javascript:void(0);" onclick="updateStatusPost({{ $category->id }}, 'category')" class="text-decoration-none" id="status-post-{{ $category->id }}">
                                <span id="status-post-{{ $category->id }}">@if($category->getStatus()) <span class="badge bg-green-lt">{{__('active')}}</span> @else <span class="badge bg-red-lt">{{__('Disabled')}}</span> @endif</span>
                            </a>
                        </td>

                        <td class="text-end">
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('admin.category.edit', $category->id) }}">
	                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                        {{__('Edit')}}
                                    </a>
                                    <a href="{{ route('admin.category.destroy', $category->id) }}" onclick="return confirm('Are you sure?')" class="dropdown-item">
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

        {{ $categories->links() }}
        
    </div>
</div>

@endsection