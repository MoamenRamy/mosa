@extends('layouts.main')

@section('title', $supplierOrder->id)

@section('content')

<div class="container">
    <div class="goods-section">
        <div class="d-flex justify-content-between mb-3 container">
            <h1 class="fw-bold py-2 my-3 fs-1">طلبية {{$supplierOrder->id}}</h1>
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
                    اسم المورد :
                </div>
                <div class="px-2 mx-2">
                    @if ($supplierOrder->supplier)
                        {{$supplierOrder->supplier->name}}
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
                    @if ($supplierOrder->user)
                        {{$supplierOrder->user->name}}
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
                    {{$supplierOrder->price}} جنية
                </div>
            </div>
            <hr>
            <div class="d-flex justify-between p-2 fw-bold">
                <div class="px-2">
                    تم دفعه :
                </div>
                <div class="px-2 mx-2 d-flex justify-content-center align-items-center">
                    {{-- <span id="paid-display">{{$supplierOrder->paid}} جنية</span> --}}

                    <!-- Input field to update paid amount -->
                    <form class="d-flex justify-content-center align-items-center" action="{{route('supplierOrders.updatePaid', $supplierOrder->id)}}" method="post">
                    @csrf
                    @method('POST')
                        <input class="form-control rounded-2 text-center my-0 mx-2 {{ $errors->has('paid') ? 'is-invalid' : '' }}"
                            type="number"
                            id="paid-input"
                            name="paid"
                            value="{{ old('paid', $supplierOrder->paid) }}"
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
                    @if ($supplierOrder->created_at)
                    {{ \Carbon\Carbon::parse($supplierOrder->created_at)->diffForHumans() }}
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
                    @if ($supplierOrder->updated_at)
                    {{ \Carbon\Carbon::parse($supplierOrder->updated_at)->diffForHumans() }}
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
        <div class="col-1 p-0 text-center fw-bold">

        </div>
    </div>
    @foreach ($supplierOrderItems as $item)
    <hr>
    <div class="row p-2">
        <div class="col d-flex justify-content-center align-items-center fw-bold text-center">
            {{$item->goods->name}}
        </div>
        <div class="col p-0 d-flex justify-content-center align-items-center">
            <form action="{{route('supplierOrderItems.update', $item->id)}}" id="count-form-{{ $item->id }}" class="text-center">
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
            <form class="p-2" action="{{ route('supplierOrders.destroyItem', ['orderId' => $supplierOrder->id, 'itemId' => $item->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="border: none; background: none;" onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="fa-solid fa-trash text-danger"></i>
                </button>
            </form>
        </div>
    </div>
    @endforeach

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
                url: '/supplierOrderItems/update/' + itemId,
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
            var orderId = {{$supplierOrder->id}}; // Get the order ID
            var paidAmount = $(this).val(); // Get the input value

            // Send the AJAX request
            $.ajax({
                url: '/supplierOrders/' + orderId + '/update-paid', // Adjust the URL to your route
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

@endsection
