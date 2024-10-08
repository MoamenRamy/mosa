@extends('layouts.main')

@section('title', 'الموردين')

@section('content')


<div class="goods-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">الموردين</h1>
        <div class="create">
            <a class="text-center" href="{{route('suppliers.create')}}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
            </a>
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
            الديون
        </div>
        <div class="col text-center fw-bold">
            العنوان
        </div>
        <div class="col text-center fw-bold">

        </div>
    </div>
    @foreach ($suppliers as $supplier)
    <hr>
    <div class="row p-2">
        <div class="col d-flex justify-content-center align-items-center fw-bold text-center">
            <a href="{{ route('suppliers.edit', $supplier) }}">
                {{$supplier->name}}
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            <a target="_blank" href="tel:{{$supplier->phone}}">
                @if ($supplier->phone)
                    {{$supplier->phone}}
                @else
                    غير معين
                @endif
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            {{$supplier->debt}} جنية
        </div>

        <div class="col d-flex justify-content-center align-items-center text-center">
            @if ($supplier->address)
                {{ $supplier->address }}
            @else
                لا يوجد
            @endif
        </div>

        <div class="col d-flex justify-content-center align-items-center text-center">
            <a class="p-2" href="{{route('suppliers.edit', $supplier)}}">
                <i class="fa-regular fa-pen-to-square text-warning"></i>
            </a>
            <!-- Form to trigger DELETE request -->
            <form class="p-2" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
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
                @if ($suppliers->onFirstPage())
                    <li class="page-item disabled mx-1"><a class="page-link">السابق</a></li>
                @else
                    <li class="page-item mx-1"><a class="page-link" href="{{ $suppliers->previousPageUrl() }}">السابق</a></li>
                @endif

                {{-- First Page Link --}}
                @if ($suppliers->currentPage() > 2)
                    <li class="page-item"><a class="page-link" href="{{ $suppliers->url(1) }}">1</a></li>
                    @if ($suppliers->currentPage() > 3)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                @endif

                {{-- Page Links Around Current Page --}}
                @for ($i = max($suppliers->currentPage() - 1, 1); $i <= min($suppliers->currentPage() + 1, $suppliers->lastPage()); $i++)
                    @if ($i == $suppliers->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $suppliers->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($suppliers->currentPage() < $suppliers->lastPage() - 1)
                    @if ($suppliers->currentPage() < $suppliers->lastPage() - 2)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $suppliers->url($suppliers->lastPage()) }}">{{ $suppliers->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($suppliers->hasMorePages())
                    <li class="page-item mx-1"><a class="page-link" href="{{ $suppliers->nextPageUrl() }}">التالي</a></li>
                @else
                    <li class="page-item disabled mx-1"><a class="page-link">التالي</a></li>
                @endif

            </ul>
        </nav>
    </div>
</div>

@endsection
