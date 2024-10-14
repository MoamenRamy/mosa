@extends('layouts.main')

@section('title', 'الموردين')

@section('content')


<div class="suppliers-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">الموردين</h1>
        <div class="create">
            <a class="text-center" href="{{route('suppliers.create')}}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
            </a>
        </div>
    </div>

        <!-- Filter Form -->
        <div class="filter container my-4">
            <hr>
            <h1 class="mt-3 fs-3 fw-bold">فلتر</h1>

            <form id="filter-form" class="container col mb-5">
                @csrf
                <div class="row d-flex justify-content-center align-items-center text-center">
                    <input type="text" name="name" class="form-control rounded-2 mt-4 mx-5 px-3" placeholder="اسم المورد">
                </div>

                <div class="row d-flex justify-content-center align-items-center text-center mt-4 mx-5 px-3">
                    <button type="submit" class="btn btn-info">تصفية</button>
                </div>
            </form>

        </div>


    <!-- suppliers List -->
    <div id="suppliers-list">
        @include('suppliers.partials.suppliers_list', ['suppliers' => $suppliers])
    </div>
</div>

@endsection

@section('script')

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('suppliers.index') }}", // Replace with your route URL
                type: 'GET',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Replace the current suppliers list with the new filtered list
                    $('#suppliers-list').html(response);
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
        url: "{{ route('suppliers.index') }}?page=" + page + "&" + $('#filter-form').serialize(),
        success: function(response) {
            $('#suppliers-list').html(response);
        }
    });
});
</script>

@endsection
