@extends('layouts.main')

@section('title', $order->id)

@section('content')

<div class="container">
    <div class="goods-section">
        <div class="d-flex justify-content-between mb-3 container">
            <h1 class="fw-bold py-2 my-3 fs-1">طلبية {{$order->id}}</h1>
            <div class="create">
                {{-- <a class="text-center" href="{{route('hotels.create')}}">
                    إضافة<i class="fa-solid fa-plus text-white bg-success mx-4 mt-4  p-2 rounded-1 text-center"></i>
                </a> --}}
            </div>
        </div>
        {{-- order details --}}
        <div class="p-2">
            <div class="d-flex justify-between p-2 fw-bold">
                <div class="px-2">
                    اسم الفندق :
                </div>
                <div class="px-2 mx-2">
                    @if ($order->hotel)
                        {{$order->hotel->name}}
                    @else
                        لايوجد
                    @endif
                </div>
            </div>
            <hr>
            <div class="d-flex justify-between p-2 fw-bold">
                <div class="px-2">
                    الموظف :
                </div>
                <div class="px-2 mx-2">
                    @if ($order->user)
                        {{$order->user->name}}
                    @else
                        لا يوجد
                    @endif
                </div>
            </div>
            <hr>
            <div class="d-flex justify-between p-2 fw-bold">
                <div class="px-2">
                    ثمن :
                </div>
                <div class="px-2 mx-2">
                    {{$order->price}} جنية
                </div>
            </div>
            <hr>
            <div class="d-flex justify-between p-2 fw-bold">
                <div class="px-2">
                    تم دفعه :
                </div>
                <div class="px-2 mx-2 d-flex justify-content-center align-items-center">
                    {{-- <span id="paid-display">{{$order->paid}} جنية</span> --}}

                    <!-- Input field to update paid amount -->
                    <form class="d-flex justify-content-center align-items-center" action="{{route('orders.updatePaid', $order->id)}}" method="post">
                    @csrf
                    @method('PUT')
                        <input class="form-control rounded-2 text-center my-0 mx-2 {{ $errors->has('paid') ? 'is-invalid' : '' }}"
                            type="number"
                            id="paid-input"
                            name="paid"
                            value="{{ old('paid', $order->paid) }}"
                            step="1"
                            min="0"
                            style="min-width: 100px;">

                        @if ($errors->has('paid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('paid') }} <!-- Display the first error message -->
                            </div>
                        @endif
                            <span class="">جنية</span>
                        </form>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-between p-2 fw-bold">
                <div class="px-2">
                    التاريخ :
                </div>
                <div class="px-2 mx-2">
                    @if ($order->created_at)
                    {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                    @else
                        لا يوجد تاريخ
                    @endif
                </div>
            </div>
            <hr>
            <div class="d-flex justify-between p-2 fw-bold">
                <div class="px-2">
                    اخر تعديل :
                </div>
                <div class="px-2 mx-2">
                    @if ($order->updated_at)
                    {{ \Carbon\Carbon::parse($order->updated_at)->diffForHumans() }}
                    @else
                        لا يوجد تاريخ
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- order items --}}

    <div class="row mt-5 p-2">
        <div class="col text-center fw-bold">
            الاسم
        </div>
        <div class="col p-0 text-center fw-bold">
            الكمية
        </div>
        <div class="col text-center fw-bold">
            السعر
        </div>
        <div class="col text-center fw-bold">
            الاجمالي
        </div>
        <div class="col-1 text-center fw-bold">

        </div>
    </div>
    @foreach ($orderItems as $item)
    <hr>
    <div class="row p-2">
        <div class="col d-flex justify-content-center align-items-center fw-bold text-center">
            {{$item->goods->name}}
        </div>
        <div class="col p-0 d-flex justify-content-center align-items-center">
            <form id="count-form-{{ $item->id }}" class="text-center">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input style="max-width: 80px;" type="number" class="form-control rounded-2 text-center count-input"
                           id="count-{{ $item->id }}" name="count" value="{{ old('count', $item->count) }}" step="1"
                           data-item-id="{{ $item->id }}">
                </div>
            </form>
            {{-- {{$item->count}} كيلو --}}
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            {{$item->price}} جنية
        </div>
        <div class="col d-flex justify-content-center align-items-center text-center">
            {{$item->total}} جنية
        </div>


        <div class="col-1 p-0 d-flex justify-content-center align-items-center text-center">
            <!-- Form to trigger DELETE request -->
            <form class="p-2" action="{{ route('orders.destroyItem', ['orderId' => $order->id, 'itemId' => $item->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="border: none; background: none;" onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="fa-solid fa-trash text-danger"></i>
                </button>
            </form>
        </div>
    </div>
    @endforeach

    {{-- add item --}}
    <!-- Button to show new item form -->
    <div class="text-center my-4">
        <button type="button" id="add-new-item-btn" class="btn btn-primary">إضافة عنصر جديد</button>
    </div>

    <!-- Form for adding new item (initially hidden) -->
    <div id="new-item-form" style="display:none;">
        <h4 class="fw-bold fs-4">إضافة عنصر جديد</h4>
        <div class="row">
            <div class="col">
                <label for="new-item-goods" class="form-label">المنتج</label>
                <select id="new-item-goods" class="form-select">
                    @foreach($goods as $good)
                        <option value="{{ $good->id }}">{{ $good->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="new-item-count" class="form-label">الكمية / كيلو</label>
                <input type="number" id="new-item-count" class="form-control" min="1">
            </div>
        </div>
        <div class="text-center my-3">
            <button type="button" id="save-new-item" class="btn btn-success">حفظ العنصر</button>
        </div>
    </div>


</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Listen for changes in the input field
        $('.count-input').on('change', function() {
            var itemId = $(this).data('item-id'); // Get the order item ID
            var newCount = $(this).val();         // Get the new count value

            // Send the AJAX request
            $.ajax({
                url: '/orderItems/update/' + itemId,
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}", // Include CSRF token for security
                    count: newCount,
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // You can show a success message
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + xhr.responseText); // Handle the error if something goes wrong
                }
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#paid-input').on('change', function() {
        var orderId = {{$order->id}}; // Get the order ID
        var paidAmount = $(this).val(); // Get the input value

        // Send the AJAX request
        $.ajax({
            url: '/orders/' + orderId + '/update-paid', // Adjust the URL to your route
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}", // Include CSRF token for security
                paid: paidAmount,
            },
            success: function(response) {
                if (response.success) {
                    $('#paid-display').text(paidAmount + ' جنية'); // Update the displayed amount
                    alert(response.message); // Show a success message
                } else {
                    alert('Failed to update paid amount.');
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + xhr.responseText); // Handle the error if something goes wrong
            }
        });
    });
});
</script>

<script>
    $(document).ready(function() {
        // Show the new item form when the button is clicked
        $('#add-new-item-btn').click(function() {
            $('#new-item-form').toggle(); // Toggle visibility of the form
        });

        // Handle saving the new item
        $('#save-new-item').click(function() {
            var goodsId = $('#new-item-goods').val(); // Get the selected product
            var count = $('#new-item-count').val(); // Get the entered quantity

            // Send AJAX request to add the new item
            $.ajax({
                url: '/orderItems/add/{{ $order->id }}', // Adjust route to match your controller
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}", // Include CSRF token
                    goods_id: goodsId,
                    count: count,
                },
                success: function(response) {
                    if (response.success) {
                        // Update the order items list in the UI
                        var newItemHtml = `
                            <hr>
                            <div class="row p-2">
                                <div class="col text-center fw-bold">
                                    ${response.goods.name}
                                </div>
                                <div class="col p-0 text-center">
                                    ${response.item.count} كيلو
                                </div>
                                <div class="col text-center">
                                    ${response.item.price} جنية
                                </div>
                                <div class="col text-center">
                                    ${response.item.total} جنية
                                </div>
                            </div>
                        `;
                        $('#new-item-form').hide(); // Hide the form after submission
                        $('#new-item-form').after(newItemHtml); // Add the new item to the list
                    } else {
                        alert('Error adding item.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>


@endsection
