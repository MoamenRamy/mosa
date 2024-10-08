@extends('layouts.main')

@section('title', $category->name)

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 fw-bold fs-2">{{ $category->name }}</h1>

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
    <form action="{{ route('category.update', $category) }}" method="POST">
        @csrf
        @method('PUT') <!-- This tells Laravel to use PUT method for update -->

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">الإسم</label>
            <input type="text" class="form-control rounded-2" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">تعديل</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">الغاء</a>
    </form>
</div>

@endsection
