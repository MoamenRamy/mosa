@extends('layouts.main')

@section('title', 'إضافة منتج')

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 fw-bold fs-2">إضافة منتج جديد</h1>

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
    <form action="{{ route('goods.store') }}" method="POST">
        @csrf

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control rounded-2" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!-- Price Input -->
        <div class="mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" class="form-control rounded-2" id="price" name="price" value="{{ old('price') }}" step="1" required>
        </div>

        <!-- Category Select Dropdown -->
        <div class="mb-3">
            <label for="category_id" class="form-label">التصنيف</label>
            <select class="form-select rounded-2" id="category_id" name="category_id">
                <option value="" selected>اختر تصنيف</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Count Input -->
        <div class="mb-3">
            <label for="count" class="form-label">الكمية / كيلو</label>
            <input type="number" class="form-control rounded-2" id="count" name="count" value="{{ old('count') }}" step="1" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('goods.index') }}" class="btn btn-secondary">الغاء</a>
    </form>
</div>

@endsection
