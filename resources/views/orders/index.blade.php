@extends('layouts.main')

@section('title', 'طلبيات الفنادق')

@section('content')

<div class="goods-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">طلبيات الفنادق</h1>
        <div class="create">
            <a class="text-center no-hover" href="{{ route('orders.create') }}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4 p-2 rounded-1 text-center"></i>
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="filter container my-4">
        <hr>
        <h1 class="mt-3 fs-3 fw-bold">فلتر</h1>
        {{-- <div class="row mb-3">
            <div class="col d-flex justify-content-center align-items-center text-center">الاسم</div>
            <div class="col d-flex justify-content-center align-items-center text-center">سعر الطلبية</div>
            <div class="col d-flex justify-content-center align-items-center text-center"></div>
        </div> --}}
        <form id="filter-form" class="container col mb-5">
            @csrf
            <div class="row d-flex justify-content-center align-items-center text-center">
                <input type="text" name="hotel_name" class="form-control rounded-2 mt-4 mx-5 px-3" placeholder="اسم الفندق">
            </div>
            <div class="row d-flex justify-content-center align-items-center text-center">
                <input type="number" name="min_price" class="form-control rounded-2 mt-4 mx-5 px-3" placeholder="ثمن من">
                {{-- <i class="fa-solid fa-arrow-left mt-2 mx-5 px-3" style="color: #74C0FC;"></i> --}}
                <i class="fa-solid fa-arrow-down mt-2 mx-5 px-3 text-info"></i>
                <input type="number" name="max_price" class="form-control rounded-2 mt-2 mx-5 px-3" placeholder="ثمن إلى">
            </div>
            {{-- <div class="col">
            </div> --}}
            {{-- <div class="col-md-3">
                <select name="paid_status" class="form-control">
                    <option value="">كل الحالات</option>
                    <option value="paid">مدفوع</option>
                    <option value="not_paid">لم يدفع</option>
                </select>
            </div> --}}
            <div class="row d-flex justify-content-center align-items-center text-center mt-4 mx-5 px-3">
                <button type="submit" class="btn btn-info">تصفية</button>
            </div>
        </form>

    </div>

    <!-- Orders List -->
    <div id="orders-list">
        @include('orders.partials.orders_list', ['orders' => $orders])
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('orders.index') }}", // Replace with your route URL
                type: 'GET',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Replace the current orders list with the new filtered list
                    $('#orders-list').html(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>


@endsection

@section('script')

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('orders.index') }}", // Replace with your route URL
                type: 'GET',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Replace the current orders list with the new filtered list
                    $('#orders-list').html(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];

    $.ajax({
        url: "{{ route('orders.index') }}?page=" + page + "&" + $('#filter-form').serialize(),
        success: function(response) {
            $('#orders-list').html(response);
        }
    });
});
</script>

@endsection
