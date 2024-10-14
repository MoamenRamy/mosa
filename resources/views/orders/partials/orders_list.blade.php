<div class="row p-2" style="font-size: 14px">
    <div class="col-1 text-center fw-bold">رقم</div>
    <div class="col text-center fw-bold">اسم الفندق</div>
    <div class="col p-0 text-center fw-bold">ثمن</div>
    <div class="col p-0 text-center fw-bold">تم دفعة</div>
    <div class="col text-center fw-bold">تاريخ</div>
    <div class="col-1 text-center fw-bold"></div>
</div>
@foreach ($orders as $order)
    <hr>
    <div class="row p-2" style="font-size: 14px">
        <div class="col-1 d-flex justify-content-center align-items-center fw-bold text-center">
            <a class="no-hover" href="{{ route('orders.show', $order) }}">{{$order->id}}</a>
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            {{ $order->hotel ? $order->hotel->name : 'لا يوجد' }}
        </div>
        <div class="col d-flex justify-content-center align-items-center p-0 text-center">
            {{$order->price}} جنية
        </div>
        <div class="col d-flex justify-content-center align-items-center p-0 text-center">
            {{ $order->paid == $order->price ? 'مدفوع' : $order->paid . ' جنية' }}
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center text-center">
            @admin
            <form class="p-2" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="border: none; background: none;" onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="fa-solid fa-trash text-danger"></i>
                </button>
            </form>
            @endadmin
        </div>
    </div>
@endforeach

 <!-- Pagination Links -->
 <div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            {{-- Previous Page Link --}}
            @if ($orders->onFirstPage())
                <li class="page-item disabled mx-1"><a class="page-link">السابق</a></li>
            @else
                <li class="page-item mx-1"><a class="page-link" href="{{ $orders->previousPageUrl() }}">السابق</a></li>
            @endif

            {{-- First Page Link --}}
            @if ($orders->currentPage() > 2)
                <li class="page-item"><a class="page-link" href="{{ $orders->url(1) }}">1</a></li>
                @if ($orders->currentPage() > 3)
                    <li class="page-item disabled"><a class="page-link">...</a></li>
                @endif
            @endif

            {{-- Page Links Around Current Page --}}
            @for ($i = max($orders->currentPage() - 1, 1); $i <= min($orders->currentPage() + 1, $orders->lastPage()); $i++)
                @if ($i == $orders->currentPage())
                    <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            {{-- Last Page Link --}}
            @if ($orders->currentPage() < $orders->lastPage() - 1)
                @if ($orders->currentPage() < $orders->lastPage() - 2)
                    <li class="page-item disabled"><a class="page-link">...</a></li>
                @endif
                <li class="page-item"><a class="page-link" href="{{ $orders->url($orders->lastPage()) }}">{{ $orders->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($orders->hasMorePages())
                <li class="page-item mx-1"><a class="page-link" href="{{ $orders->nextPageUrl() }}">التالي</a></li>
            @else
                <li class="page-item disabled mx-1"><a class="page-link">التالي</a></li>
            @endif

        </ul>
    </nav>
</div>
