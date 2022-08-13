@extends('layouts.admin')

@section('content')


@if($sponser->type == 'personal')
<table class="table">
    <thead>
        <tr>
            <th>{{ __('الاسم') }}</th>
            <th>{{ __('نوع بطاقة التعريف') }}</th>
            <th>{{ __('رقم بطاقة التعريف') }}</th>
            <th>{{__('رقم الجوال')}}</th>
            <th>{{__('رقم الهاتف')}}</th>
            <th>{{__('البريد الالكتروني')}}</th>
            <th>{{__('الدولة')}}</th>
            <th>{{__('المدينة')}}</th>
            <th>{{__('الجنسية')}}</th>
            <th>{{__('العنوان')}}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $sponser->name }}</td>
            <td>{{ $sponser->ident_type }}</td>
            <td>{{ $sponser->identifier }}</td>
            <td>{{ $sponser->phone }}</td>
            <td>{{ $sponser->telephone }}</td>
            <td>{{ $sponser->email }}</td>
            <td>{{ $sponser->country->name }}</td>
            <td>{{ $sponser->city->name }}</td>
            <td>{{ $sponser->nationality }}</td>
            <td>{{ $sponser->address }}</td>
            <td>
        </tr>
    </tbody>
</table>
@endif
@if($sponser->type == 'institution')
<table class="table">
    <thead>
        <tr>
            <th>{{ __('الاسم') }}</th>
            <th>{{__('رقم الجوال')}}</th>
            <th>{{__('رقم الجوال 2')}}</th>
            <th>{{__('البريد الالكتروني')}}</th>
            <th>{{__('الدولة')}}</th>
            <th>{{__('العنوان')}}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $sponser->name }}</td>
            <td>{{ $sponser->phone }}</td>
            <td>{{ $sponser->phone2 }}</td>
            <td>{{ $sponser->email }}</td>
            <td>{{ $sponser->country->name }}</td>
            <td>{{ $sponser->address }}</td>
            <td>
        </tr>
    </tbody>
</table>
@endif



@endsection