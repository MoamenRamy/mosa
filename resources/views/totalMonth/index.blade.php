@extends('layouts.main')

@section('title', 'إجمالي الشهر')

@section('content')

<div class="container">
    <div class="head d-flex justify-content-between align-items-center row">
        <div class="col-6 fs-2 fw-bold my-3">
            إجمالي الشهر
        </div>
        <div class="col-6">
            {{-- Month Filter Form --}}
            <form action="{{ route('totalMonth.index') }}" method="GET" class="float-end" style="max-width: 150px">
                <input type="month" name="month" value="{{ $month }}" class="form-control" onchange="this.form.submit()">
            </form>
        </div>
    </div>
    <hr>
    <div class="my-5" style="font-size: 16px;">
        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">إجمالي طلبيات الفنادق</div>
            <div class="text-success col-6 text-left">{{ $hotelOrders }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">إجمالي طلبيات الموردين</div>
            <div class="text-danger col-6 text-left">{{ $supplierOrders }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">ديون الفنادق</div>
            <div class="text-success col-6 text-left">{{ $hotelDebt_month }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">ديون الموردين</div>
            <div class="text-danger col-6 text-left">{{ $supplierDebt_month }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">مرتبات العمال</div>
            <div class="text-danger col-6 text-left">{{ $totalSalaries }} جنية</div>
        </div>
        <hr>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">تحصيل الفنادق</div>
            @if ($hotelIncome >= 0)
                <div class="text-success col-6 text-left">{{ $hotelIncome }} جنية</div>
            @else
                <div class="text-danger col-6 text-left">{{ $hotelIncome }} جنية</div>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">تم دفعة للموردين</div>
                <div class="text-danger col-6 text-left">{{ $supplierOutcome }} جنية</div>
        </div>
        <hr>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">الاجمالي</div>
            @if ($total >= 0)
                <div class="text-success col-6 text-left">{{ $total }} جنية</div>
            @else
                <div class="text-danger col-6 text-left">{{ $total }} جنية</div>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">الصافي</div>
            @if ($total >= 0)
                <div class="text-success col-6 text-left">{{ $income }} جنية</div>
            @else
                <div class="text-danger col-6 text-left">{{ $income }} جنية</div>
            @endif
        </div>

        <hr class="my-2">
        <hr class="my-2">
        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">اجمالي ديون الفنادق</div>
            <div class="text-success col-6 text-left">{{ $hotelsDebt }} جنية</div>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 row">
            <div class="col-6">اجمالي ديون الموردين</div>
            <div class="text-danger col-6 text-left">{{ $suppliersDebt }} جنية</div>
        </div>
    </div>
</div>

@endsection
