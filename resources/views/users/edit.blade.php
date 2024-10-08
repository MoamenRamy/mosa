@extends('layouts.main')

@section('title', $user->name)

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 fw-bold fs-2">{{$user->name}}</h1>

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
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control rounded-2" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Phone Input -->
        <div class="mb-3">
            <label for="phone" class="form-label">رقم التليفون</label>
            <input type="text" class="form-control rounded-2" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <!-- address Input -->
        <div class="mb-3">
            <label for="email" class="form-label">البريد الالكتروني</label>
            <input type="email" class="form-control rounded-2" id="email" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label for="jobTitle_id" class="form-label">الوظيفة</label>
            <select class="form-select rounded-2" id="jobTitle_id" name="jobTitle_id">
                <option value="" selected>اختر وظيفة</option>
                @foreach ($jobTitle as $job)
                    <option value="{{ $job->id }}" {{ old('jobTitle_id', $user->jobTitle_id) == $job->id ? 'selected' : '' }}>
                        {{ $job->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- role Input -->
        <div class="mb-3">
            <label for="role" class="form-label">الصلاحية</label>
            <select class="form-select rounded-2" id="role" name="role" value="{{ old('role', $user->role) }}" step="1">
                <option value="" disabled >اختر صلاحية</option>
                <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }} >غير مفعل</option>
                <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }} >موظف</option>
                <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }} >مدير</option>
                <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }} >مدير عام</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">تعديل</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">الغاء</a>
    </form>
</div>

@endsection
