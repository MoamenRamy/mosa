@extends('layouts.main')

@section('title', 'التصنيفات')

@section('content')


<div class="goods-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">التصنيفات</h1>
        <div class="create">
            <a class="text-center" href="{{route('category.create')}}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
            </a>
        </div>
    </div>
    <div class="row p-2">
        <div class="col text-center fw-bold">
            الاسم
        </div>

        <div class="col text-center fw-bold">

        </div>
    </div>
    @foreach ($categories as $category)
    <hr>
    <div class="row p-2">
        <div class="col d-flex justify-content-center align-items-center fw-bold text-center">
            <a href="{{ route('category.edit', $category) }}">
                {{$category->name}}
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            <a class="p-2" href="{{route('category.edit', $category->id)}}">
                <i class="fa-regular fa-pen-to-square text-warning"></i>
            </a>
            <!-- Form to trigger DELETE request -->
            <form class="p-2" action="{{ route('category.destroy', $category) }}" method="POST" style="display:inline;">
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
                @if ($categories->onFirstPage())
                    <li class="page-item disabled mx-1"><a class="page-link">السابق</a></li>
                @else
                    <li class="page-item mx-1"><a class="page-link" href="{{ $categories->previousPageUrl() }}">السابق</a></li>
                @endif

                {{-- First Page Link --}}
                @if ($categories->currentPage() > 2)
                    <li class="page-item"><a class="page-link" href="{{ $categories->url(1) }}">1</a></li>
                    @if ($categories->currentPage() > 3)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                @endif

                {{-- Page Links Around Current Page --}}
                @for ($i = max($categories->currentPage() - 1, 1); $i <= min($categories->currentPage() + 1, $categories->lastPage()); $i++)
                    @if ($i == $categories->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($categories->currentPage() < $categories->lastPage() - 1)
                    @if ($categories->currentPage() < $categories->lastPage() - 2)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $categories->url($categories->lastPage()) }}">{{ $categories->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($categories->hasMorePages())
                    <li class="page-item mx-1"><a class="page-link" href="{{ $categories->nextPageUrl() }}">التالي</a></li>
                @else
                    <li class="page-item disabled mx-1"><a class="page-link">التالي</a></li>
                @endif

            </ul>
        </nav>
    </div>
</div>

@endsection
