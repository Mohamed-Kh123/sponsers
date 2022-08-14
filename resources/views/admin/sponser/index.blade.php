@extends('layouts.admin')


@section('title')
<div class="d-flex justify-content-between">
    <h2>Sponsers</h2>
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('sponsers.create') }}">Create</a>
    </div>
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('sponsers.index')}}">Sponsers</a></li>
</ol>
@endsection


@section('content')

<table class="table">
    <thead>
        <tr>
            <th>{{ __('الاسم') }}</th>
            <th>{{ __('نوع الكفيل') }}</th>
            <th>{{__('رقم الجوال')}}</th>
            <th>{{__('البريد الالكتروني')}}</th>
            <th>{{__('الدولة')}}</th>
            <th>{{__('العنوان')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sponsers as $sponser)
        <tr>
            <td>{{ $sponser->name }}</td>
            <td>{{ $sponser->type }}</td>
            <td>{{ $sponser->phone }}</td>
            <td>{{ $sponser->email }}</td>
            <td>{{ $sponser->country->name }}</td>
            <td>{{ $sponser->address }}</td>
            <td>
            <a href="{{ route('sponsers.edit', $sponser->id) }}" class="btn btn-sm btn-dark">{{__('Edit')}}</a>
            </td>
            <td>
            <a href="{{ route('sponsers.show', $sponser->id) }}" class="btn btn-sm btn-primary">{{__('Show')}}</a>
            </td>
            <td>
                <form action="{{ route('sponsers.destroy', $sponser->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection