@extends('layouts.main')

@section('title', 'التصنيفات')

@section('content')


<div class="category-section">
    <div class="d-flex justify-content-between mb-3 container">
        <h1 class="fw-bold py-2 my-3 fs-1">التصنيفات</h1>
        <div class="create">
            @admin
            <a class="text-center" href="{{route('category.create')}}">
                إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
            </a>
            @endadmin
        </div>
    </div>

    <!-- Filter Form -->
    <div class="filter container my-4">
        <hr>
        <h1 class="mt-3 fs-3 fw-bold">فلتر</h1>

        <form id="filter-form" class="container col mb-5">
            @csrf
            <div class="row d-flex justify-content-center align-items-center text-center">
                <input type="text" name="name" class="form-control rounded-2 mt-4 mx-5 px-3" placeholder="اسم التصنيف">
            </div>

            <div class="row d-flex justify-content-center align-items-center text-center mt-4 mx-5 px-3">
                <button type="submit" class="btn btn-info">تصفية</button>
            </div>
        </form>

    </div>


    <!-- category List -->
    <div id="category-list">
        @include('category.partials.category_list', ['category' => $category])
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
                url: "{{ route('category.index') }}", // Replace with your route URL
                type: 'GET',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // console.log('Request successful');  // Add this for debugging
                    // Replace the current category list with the new filtered list
                    $('#category-list').html(response);
                },
                error: function(xhr) {
                    // console.log('Error:', status, error);  // Add this for error checking

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
        url: "{{ route('category.index') }}?page=" + page + "&" + $('#filter-form').serialize(),
        success: function(response) {
            $('#category-list').html(response);
        }
    });
});
</script>

@endsection


