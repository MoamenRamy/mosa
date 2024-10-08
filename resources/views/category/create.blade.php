@extends('layouts.main')

@section('title', 'إضافة تصنيف')

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 fw-bold fs-2">إضافة تصنيف جديد</h1>

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
    <form action="{{ route('category.store') }}" method="POST">
        @csrf

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control rounded-2" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">الغاء</a>
    </form>
</div>

@endsection
