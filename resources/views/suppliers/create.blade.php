@extends('layouts.main')

@section('title', 'إضافة مورد')

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 fw-bold fs-2">إضافة مورد جديد</h1>

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
    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control rounded-2" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!-- Phone Input -->
        <div class="mb-3">
            <label for="phone" class="form-label">رقم التليفون</label>
            <input type="text" class="form-control rounded-2" id="phone" name="phone" value="{{ old('phone') }}">
        </div>

        <!-- address Input -->
        <div class="mb-3">
            <label for="address" class="form-label">العنوان</label>
            <input type="text" class="form-control rounded-2" id="address" name="address" value="{{ old('address') }}">
        </div>

        <!-- debt Input -->
        <div class="mb-3">
            <label for="debt" class="form-label">المديونية</label>
            <input type="number" class="form-control rounded-2" id="debt" name="debt" value="{{ old('debt') }}" step="1" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">الغاء</a>
    </form>
</div>

@endsection
