@extends('layouts.main')

@section('title', 'إضافة فندق')

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 fw-bold fs-2">إضافة فندق جديد</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Good Form -->
    <form action="{{ route('hotels.store') }}" method="POST">
        @csrf

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control rounded-2" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">العنوان</label>
            <input type="text" class="form-control rounded-2" id="address" name="address" value="{{ old('address') }}" required>
        </div>

        <div class="mb-3">
            <label for="stars" class="form-label">النجوم</label>
            <input type="number" class="form-control rounded-2" id="stars" name="stars" value="{{ old('stars') }}" step="1" required>
        </div>

        <div class="mb-3">
            <label for="sales" class="form-label">المبيعات</label>
            <input type="number" class="form-control rounded-2" id="sales" name="sales" value="{{ old('sales') }}" step="1">
        </div>

        <div class="mb-3">
            <label for="debt" class="form-label">الديون</label>
            <input type="number" class="form-control rounded-2" id="debt" name="debt" value="{{ old('debt') }}" step="1">
        </div>

        <div class="mb-3">
            <label for="last_supply_date" class="form-label">اخر معاد توريد</label>
            <input type="date" class="form-control rounded-2" id="last_supply_date" name="last_supply_date" value="{{ old('last_supply_date') }}">
        </div>


        <div class="mb-3">
            <label for="last_supply_count" class="form-label">اخر كمية توريد / كيلو</label>
            <input type="number" class="form-control rounded-2" id="last_supply_count" name="last_supply_count" value="{{ old('last_supply_count') }}" step="1">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('hotels.index') }}" class="btn btn-secondary">الغاء</a>
    </form>
</div>

@endsection
