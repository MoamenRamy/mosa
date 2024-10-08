@extends('layouts.main')

@section('title', 'طلبيات الموردين')

@section('content')

<div class="goods-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">طلبيات الموردين</h1>
        <div class="create">
            <a class="text-center no-hover" href="{{route('supplierOrders.create')}}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
            </a>
        </div>
    </div>
    <div class="row p-2" style="font-size: 14px">
        <div class="col-1 text-center fw-bold">
            رقم
        </div>
        <div class="col text-center fw-bold">
            اسم المورد
        </div>
        {{-- <div class="col text-center fw-bold">
            الموظف
        </div> --}}
        <div class="col p-0 text-center fw-bold">
            ثمن
        </div>
        <div class="col p-0 text-center fw-bold">
            تم دفعة
        </div>
        <div class="col text-center fw-bold">
            تاريخ
        </div>
        <div class="col text-center fw-bold">

        </div>
    </div>
    @foreach ($supplierOrders as $supplierOrder)
    <hr>
    <div class="row p-2" style="font-size: 14px">
        <div class="col-1 d-flex justify-content-center align-items-center fw-bold text-center">
            <a class="no-hover" href="{{ route('supplierOrders.show', $supplierOrder) }}">
                {{$supplierOrder->id}}
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            @if ($supplierOrder->supplier)
                {{$supplierOrder->supplier->name}}
            @else
                لا يوجد
            @endif
        </div>
        {{-- <div class="col d-flex justify-content-center align-items-center text-center">
            @if ($supplierOrder->user)
                {{$supplierOrder->user->name}}
            @else
                لا يوجد
            @endif
        </div> --}}

        <div class="col d-flex justify-content-center align-items-center p-0 text-center">
            {{$supplierOrder->price}} جنية
        </div>

        <div class="col d-flex justify-content-center align-items-center p-0 text-center">
            @if ($supplierOrder->paid == $supplierOrder->price)
                مدفوع
            @else
                {{$supplierOrder->paid}} جنية
            @endif
        </div>

        <div class="col d-flex justify-content-center align-items-center text-center">
            @if ($supplierOrder->created_at)
                {{ \Carbon\Carbon::parse($supplierOrder->created_at)->diffForHumans() }}
            @else
                لا يوجد تاريخ
            @endif
        </div>

        <div class="col d-flex justify-content-center align-items-center text-center">
            {{-- <a class="p-2" href="{{route('supplierOrders.edit', $supplierOrder)}}">
                <i class="fa-regular fa-pen-to-square text-warning"></i>
            </a> --}}
            <!-- Form to trigger DELETE request -->
            <form class="p-2" action="{{ route('supplierOrders.destroy', $supplierOrder->id) }}" method="POST" style="display:inline;">
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
                @if ($supplierOrders->onFirstPage())
                    <li class="page-item disabled mx-1"><a class="page-link">السابق</a></li>
                @else
                    <li class="page-item mx-1"><a class="page-link" href="{{ $supplierOrders->previousPageUrl() }}">السابق</a></li>
                @endif

                {{-- First Page Link --}}
                @if ($supplierOrders->currentPage() > 2)
                    <li class="page-item"><a class="page-link" href="{{ $supplierOrders->url(1) }}">1</a></li>
                    @if ($supplierOrders->currentPage() > 3)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                @endif

                {{-- Page Links Around Current Page --}}
                @for ($i = max($supplierOrders->currentPage() - 1, 1); $i <= min($supplierOrders->currentPage() + 1, $supplierOrders->lastPage()); $i++)
                    @if ($i == $supplierOrders->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $supplierOrders->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($supplierOrders->currentPage() < $supplierOrders->lastPage() - 1)
                    @if ($supplierOrders->currentPage() < $supplierOrders->lastPage() - 2)
                        <li class="page-item disabled"><a class="page-link">...</a></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $supplierOrders->url($supplierOrders->lastPage()) }}">{{ $supplierOrders->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($supplierOrders->hasMorePages())
                    <li class="page-item mx-1"><a class="page-link" href="{{ $supplierOrders->nextPageUrl() }}">التالي</a></li>
                @else
                    <li class="page-item disabled mx-1"><a class="page-link">التالي</a></li>
                @endif

            </ul>
        </nav>
    </div>
</div>

@endsection
