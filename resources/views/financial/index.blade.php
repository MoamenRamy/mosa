@extends('layouts.main')

@section('title', 'الحسابات')

@section('content')

<div class="container">
    <a href="{{route('orders.index')}}" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            طلبيات الفنادق
        </div>

    </a>
    <a href="{{route('supplierOrders.index')}}" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            طلبيات الموردين
        </div>
        {{--  --}}
    </a>
    {{-- <a href="" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            ديون الفنادق
        </div>

    </a>
    <a href="" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            ديون الموردين
        </div>

    </a> --}}
    {{-- <a href="" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            مرتبات العمال
        </div>

    </a> --}}
    @superAdmin
    <a href="{{route('totalMonth.index')}}" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            اجمالي الشهر
        </div>

    </a>
    {{-- <a href="" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            إضافة عامل
        </div>

    </a> --}}
    <a href="{{route('jobTitles.index')}}" class="d-flex justify-content-center align-items-center bg-dark text-white text-center fs-4 m-3 mt-4 rounded-2 no-hover">
        <div class="p-2 m-2 no-hover">
            الوظايف
        </div>

    </a>
    @endsuperAdmin

</div>

@endsection
