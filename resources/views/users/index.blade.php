@extends('layouts.main')

@section('title', 'الموظفين')

@section('content')


<div class="goods-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">الموظفين</h1>
        <div class="create">
            {{-- <a class="text-center" href="{{route('users.create')}}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
            </a> --}}
        </div>
    </div>
    <div class="row p-2">
        <div class="col text-center fw-bold">
            الاسم
        </div>
        <div class="col text-center fw-bold">
            رقم التليفون
        </div>
        <div class="col text-center fw-bold">
            الوظيفة
        </div>
        <div class="col text-center fw-bold">
            المرتب
        </div>
        <div class="col text-center fw-bold">
            الصلاحية
        </div>
        <div class="col text-center fw-bold">

        </div>
    </div>
    @foreach ($users as $user)
    <hr>
    <div class="row p-2">
        <div class="col d-flex justify-content-center align-items-center fw-bold text-center">
            <a href="{{ route('users.edit', $user) }}">
                {{$user->name}}
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            <a target="_blank" href="tel:{{$user->phone}}">
                @if ($user->phone)
                {{$user->phone}}
                @else
                غير معين
                @endif
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            @if ($user->jobTitle)
                {{$user->jobTitle->name}}
            @else
            غير معين
            @endif

        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            @if ($user->jobTitle)
                {{$user->jobTitle->salary}}
            @else
            غير معين
            @endif

        </div>

        <div class="col d-flex justify-content-center align-items-center text-center">
            @if ($user->role == 0)
                غير مفعل
            @elseif ($user->role == 1)
                موظف
            @elseif ($user->role == 2)
                مدير
            @elseif ($user->role == 3)
                مدير عام
            @endif
        </div>

        <div class="col d-flex justify-content-center align-items-center text-center">
            <a class="p-2" href="{{route('users.edit', $user)}}">
                <i class="fa-regular fa-pen-to-square text-warning"></i>
            </a>
            <!-- Form to trigger DELETE request -->
            <form class="p-2" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="border: none; background: none;" onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="fa-solid fa-trash text-danger"></i>
                </button>
            </form>
        </div>
    </div>
    @endforeach

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">

                {{-- Previous Page Link --}}
                @if ($users->onFirstPage())
                    <li class="page-item disabled mx-1"><a class="page-link">السابق</a></li>
                @else
                    <li class="page-item mx-1"><a class="page-link" href="{{ $users->previousPageUrl() }}">السابق</a></li>
                @endif

                {{-- First Page Link --}}
                @if ($users->currentPage() > 2)
                    <li class="page-item"><a class="page-link" href="{{ $users->url(1) }}">1</a></li>
                    @if ($users->currentPage() > 3)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                @endif

                {{-- Page Links Around Current Page --}}
                @for ($i = max($users->currentPage() - 1, 1); $i <= min($users->currentPage() + 1, $users->lastPage()); $i++)
                    @if ($i == $users->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($users->currentPage() < $users->lastPage() - 1)
                    @if ($users->currentPage() < $users->lastPage() - 2)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($users->hasMorePages())
                    <li class="page-item mx-1"><a class="page-link" href="{{ $users->nextPageUrl() }}">التالي</a></li>
                @else
                    <li class="page-item disabled mx-1"><a class="page-link">التالي</a></li>
                @endif

            </ul>
        </nav>
    </div>
</div>

@endsection
