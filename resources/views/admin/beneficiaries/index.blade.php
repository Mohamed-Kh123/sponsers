@extends('layouts.admin')


@section('title')
<div class="d-flex justify-content-between">
    <h2>Beneficiaries</h2>
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('beneficiary.create') }}">Create</a>
    </div>
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('beneficiary.index')}}">Beneficiaries</a></li>
</ol>
@endsection


@section('content')

<x-alert />

<table class="table">
    <thead>
        <tr>
            <th>{{ __('الاسم') }}</th>
            <th>{{ __('نوع الكفالة') }}</th>
            <th>{{__('اسم الكفيل')}}</th>
            <th>{{__('تاريخ الإضافة')}}</th>
        </tr>
    </thead>
    <tbody>
        @php
        use App\Models\Beneficiaries;
        use Carbon\Carbon;
        $beneficiary = new Beneficiaries();
        $date = new DateTime ($beneficiary->create_at);
        $date = $date->format('Y-m-d'); 
        @endphp
        @foreach($beneficiaries as $beneficiary)
        <tr>
            <td>{{ $beneficiary->name }}</td>
            <td>{{ $beneficiary->type }}</td>
            <td>{{ $beneficiary->sponser->name}}</td>
            <td>{{ $date }}</td>
            <td>
            <a href="{{ route('beneficiary.edit', $beneficiary->id) }}" class="btn btn-sm btn-dark">{{__('Edit')}}</a>
            </td>
            <td>
            <a href="{{ route('beneficiary.show', $beneficiary->id) }}" class="btn btn-sm btn-primary">{{__('Show')}}</a>
            </td>
            <td>
                <form action="{{ route('beneficiary.destroy', $beneficiary->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger" id="delete">{{__('Delete')}}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 

<script>


    $(document).ready(function () {
        $("#delete").on('sumbit', function(){
            alert('hello')
        })
    });


</script>


@endsection