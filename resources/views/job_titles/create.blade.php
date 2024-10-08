@extends('layouts.main')

@section('title', 'إاضافة وظيفة')

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 fw-bold fs-2">إضافة وظيفة</h1>

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

    <!-- Edit Good Form -->
    <form action="{{ route('jobTitles.store') }}" method="POST">
        @csrf
        @method('POST') <!-- This tells Laravel to use PUT method for update -->

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">الإسم</label>
            <input type="text" class="form-control rounded-2" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">المرتب</label>
            <input type="number" class="form-control rounded-2" id="salary" name="salary" value="{{ old('salary') }}" step="1" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('jobTitles.index') }}" class="btn btn-secondary">الغاء</a>
    </form>
</div>

@endsection
