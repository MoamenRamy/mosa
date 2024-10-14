@extends('layouts.main')

@section('title', 'الصفحة الرئيسية')

@section('content')
    @employee
    <div class="dashbord container text-center">
        <div class="row">
            <div class="dash col bg-success p-3 text-white">
                <div class="title">
                    مبيعات اليوم
                </div>
                <div class="number">
                    {{ $totalIncome }} جنية
                </div>
            </div>
            <div class="dash col bg-warning p-3 fw-bold">
                <div class="title">
                    الكمية المباعة
                </div>
                <div class="number">
                    {{ $totalGoodsSold }} كيلو
                </div>
            </div>
        </div>
    </div>
    @endemployee
    <div class="home-cards">
        <div id="card" class="card">
            <a class="link" href="{{route('orders.index')}}">
                <div class="card-image"
                    style="background-image: url('{{ asset('images/home/Payment at the Food Establishment.jpeg') }}');">
                    <div class="card-content">
                        <h2>طلبيات الفنادق</h2>
                    </div>
                </div>
            </a>
        </div>
        <div id="card" class="card">
            <a class="link" href="{{route('goods.index')}}">
                <div class="card-image"
                    style="background-image: url('{{ asset('images/home/Fresh Fish on Ice Display (2).jpeg') }}');">
                    <div class="card-content">
                        <h2>البضاعة</h2>
                    </div>
                </div>
            </a>
        </div>
        <div id="card" class="card">
            <a class="link" href="{{ route('category.index') }}">
                <div class="card-image"
                    style="background-image: url('{{ asset('images/home/Indoor Aquatic Store Scene.jpeg') }}');">
                    <div class="card-content">
                        <h2>التصنيفات</h2>
                    </div>
                </div>
            </a>
        </div>
        <div id="card" class="card">
            <a class="link" href="{{ route('hotels.index') }}">
                <div class="card-image"
                    style="background-image: url('{{ asset('images/home/Luxurious Resort Poolside (1).jpeg') }}');">
                    <div class="card-content">
                        <h2>الفنادق</h2>
                    </div>
                </div>
            </a>
        </div>
        @admin
        <div id="card" class="card">
            <a class="link" href="{{ route('suppliers.index') }}">
                <div class="card-image"
                    style="background-image: url('{{ asset('images/home/Contemplative Maiden at the Fish Market.jpeg') }}');">
                    <div class="card-content">
                        <h2>الموردين</h2>
                    </div>
                </div>
            </a>
        </div>
        
        <div id="card" class="card">
            <a class="link" href="{{ route('users.index') }}">
                <div class="card-image"
                    style="background-image: url('{{ asset('images/home/Confident Industrial Worker.jpeg') }}');">
                    <div class="card-content">
                        <h2>الموظفين</h2>
                    </div>
                </div>
            </a>
        </div>

        <div id="card" class="card">
            <a class="link" href="{{route('financial.index')}}">
                <div class="card-image"
                    style="background-image: url('{{ asset('images/home/Financial Analytics Business Setting.jpeg') }}');">
                    <div class="card-content">
                        <h2>الحسابات</h2>
                    </div>
                </div>
            </a>
        </div>
        @endadmin

        </div>
    </div>

@endsection


