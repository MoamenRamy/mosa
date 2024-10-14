<div class="row p-2">
    <div class="col text-center fw-bold">
        الاسم
    </div>

    <div class="col text-center fw-bold">

    </div>
</div>
@foreach ($category as $cat)
<hr>
<div class="row p-2">
    <div class="col d-flex justify-content-center align-items-center text-center">
        <a href="{{ route('goods.getByCategory', $cat->id) }}">
            {{$cat->name}}
        </a>
    </div>
    <div class="col d-flex justify-content-center align-items-center text-center">
        @admin
        <a class="p-2" href="{{route('category.edit', $cat->id)}}">
            <i class="fa-regular fa-pen-to-square text-warning"></i>
        </a>
        <!-- Form to trigger DELETE request -->
        <form class="p-2" action="{{ route('category.destroy', $cat) }}" method="POST" style="display:inline;">
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
            @if ($category->onFirstPage())
                <li class="page-item disabled mx-1"><a class="page-link">السابق</a></li>
            @else
                <li class="page-item mx-1"><a class="page-link" href="{{ $category->previousPageUrl() }}">السابق</a></li>
            @endif

            {{-- First Page Link --}}
            @if ($category->currentPage() > 2)
                <li class="page-item"><a class="page-link" href="{{ $category->url(1) }}">1</a></li>
                @if ($category->currentPage() > 3)
                    <li class="page-item disabled"><a class="page-link">...</a></li>
                @endif
            @endif

            {{-- Page Links Around Current Page --}}
            @for ($i = max($category->currentPage() - 1, 1); $i <= min($category->currentPage() + 1, $category->lastPage()); $i++)
                @if ($i == $category->currentPage())
                    <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $category->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            {{-- Last Page Link --}}
            @if ($category->currentPage() < $category->lastPage() - 1)
                @if ($category->currentPage() < $category->lastPage() - 2)
                    <li class="page-item disabled"><a class="page-link">...</a></li>
                @endif
                <li class="page-item"><a class="page-link" href="{{ $category->url($category->lastPage()) }}">{{ $category->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($category->hasMorePages())
                <li class="page-item mx-1"><a class="page-link" href="{{ $category->nextPageUrl() }}">التالي</a></li>
            @else
                <li class="page-item disabled mx-1"><a class="page-link">التالي</a></li>
            @endif

        </ul>
    </nav>
</div>
