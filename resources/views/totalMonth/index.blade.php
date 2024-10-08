@extends('layouts.main')

@section('title', 'إجمالي الشهر')

@section('content')

<div class="container">
    <div class="head">
        <div class="fs-2 fw-bold my-3">
            إجمالي الشهر
            {{-- <a href="{{ route('monthly_total.export') }}" class="btn btn-sm btn-info float-end">تصدير</a> --}}
        </div>
    </div>
    <hr>
    <div class="my-5">
        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">إجمالي طلبيات الفنادق</div>
            <div class="text-success">{{ $hotelOrders }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">إجمالي طلبيات الموردين</div>
            <div class="text-danger">{{ $supplierOrders }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">ديون الفنادق</div>
            <div class="text-success">{{ $hotelsDebt }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">ديون الموردين</div>
            <div class="text-danger">{{ $suppliersDebt }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">مرتبات العمال</div>
            <div class="text-danger">{{ $totalSalaries }} جنية</div>
        </div>
        <hr>

        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">تحصيل الفنادق</div>
            @if ($hotelPaid >= 0)
                <div class="text-success">{{ $hotelPaid }} جنية</div>
            @else
                <div class="text-danger">{{ $hotelPaid }} جنية</div>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">تحصيل الموردين</div>
            @if ($supplierPaid >= 0)
                <div class="text-success">{{ $supplierPaid }} جنية</div>
            @else
                <div class="text-danger">{{ $supplierPaid }} جنية</div>
            @endif
        </div>
        <hr>

        <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">الاجمالي</div>
            @if ($total >= 0)
                <div class="text-success">{{ $total }} جنية</div>
            @else
                <div class="text-danger">{{ $total }} جنية</div>
            @endif
        </div>

        {{-- <div class="d-flex justify-content-between align-items-center fs-5 p-3">
            <div class="">الدخل</div>
            @if ($income >= 0)
                <div class="text-success">{{ $income }} جنية</div>
            @else
                <div class="text-danger">{{ $income }} جنية</div>
            @endif
        </div> --}}

    </div>
</div>

@endsection
