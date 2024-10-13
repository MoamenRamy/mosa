@extends('layouts.main')

@section('title', 'البضاعة')

@section('content')


<div class="goods-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">البضاعة</h1>
        <div class="create">
            <a class="text-center" href="{{route('goods.create')}}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
            </a>
        </div>
    </div>
    <div class="row p-2" style="font-size: 14px">
        <div class="col-2 text-center fw-bold">
            الاسم
        </div>
        <div class="col-3 text-center fw-bold">
            السعر
        </div>
        <div class="col-3 text-center fw-bold">
            الكمية
        </div>
        <div class="col-2 text-center fw-bold">
            التصنيف
        </div>
        <div class="col-2 text-center fw-bold">

        </div>
    </div>
    @foreach ($goods as $good)
    <hr>
    <div class="row p-2" style="font-size: 14px">
        <div class="col-2 d-flex justify-content-center align-items-center fw-bold text-center">
            <a href="{{ route('goods.edit', $good) }}">
                {{$good->name}}
            </a>
        </div>
        <div class="col-3 d-flex justify-content-center align-items-center text-center">
            {{$good->price}} جنية
        </div>
        <div class="col-3 d-flex justify-content-center align-items-center text-center">
            {{$good->count}} كيلو
        </div>
        <div class="col-2 d-flex justify-content-center align-items-center text-center">
            @if ($good->category && $good->category->name)
                {{ $good->category->name }}
            @else
                لا يوجد
            @endif
        </div>
        <div class="col-2 d-flex justify-content-center align-items-center text-center">
            <a class="p-2" href="{{route('goods.edit', $good)}}">
                <i class="fa-regular fa-pen-to-square text-warning"></i>
            </a>
            <!-- Form to trigger DELETE request -->
            <form class="p-2" action="{{ route('goods.destroy', $good->id) }}" method="POST" style="display:inline;">
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
                @if ($goods->onFirstPage())
                    <li class="page-item disabled mx-1"><a class="page-link">السابق</a></li>
                @else
                    <li class="page-item mx-1"><a class="page-link" href="{{ $goods->previousPageUrl() }}">السابق</a></li>
                @endif

                {{-- First Page Link --}}
                @if ($goods->currentPage() > 2)
                    <li class="page-item"><a class="page-link" href="{{ $goods->url(1) }}">1</a></li>
                    @if ($goods->currentPage() > 3)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                @endif

                {{-- Page Links Around Current Page --}}
                @for ($i = max($goods->currentPage() - 1, 1); $i <= min($goods->currentPage() + 1, $goods->lastPage()); $i++)
                    @if ($i == $goods->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $goods->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($goods->currentPage() < $goods->lastPage() - 1)
                    @if ($goods->currentPage() < $goods->lastPage() - 2)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $goods->url($goods->lastPage()) }}">{{ $goods->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($goods->hasMorePages())
                    <li class="page-item mx-1"><a class="page-link" href="{{ $goods->nextPageUrl() }}">التالي</a></li>
                @else
                    <li class="page-item disabled mx-1"><a class="page-link">التالي</a></li>
                @endif

            </ul>
        </nav>
    </div>
</div>

@endsection
