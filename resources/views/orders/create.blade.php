@extends('layouts.main')

@section('title', 'إضافة طلبية')

@section('content')
<div class="container">
    <h2 class="fw-bold fs-2 mt-2 mb-4">إضافة طلبية جديدة</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Order Form -->
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- User Selection -->
        {{-- <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" id="user_id" class="form-select">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div> --}}

        <!-- Hotel Selection -->
        <div class="mb-4">
            <label for="hotel_id" class="form-label">اسم الفندق</label>
            <select name="hotel_id" id="hotel_id" class="form-select" required>
                <option value="" selected disabled>اختر فندق</option>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Order Items -->
        <div id="order-items">
            <h4 class="fw-bold fs-4 my-4">العناصر</h4>
            <div class="order-item mb-3">
                <div class="mb-4">
                    <label for="goods_id" class="form-label">المنتج</label>
                    <select name="order_items[0][goods_id]" class="form-select" required>
                        @foreach($goods as $good)
                            <option value="{{ $good->id }}">{{ $good->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="count" class="form-label">الكمية / كيلو</label>
                    <input type="number" name="order_items[0][count]" class="form-control rounded-2" min="1" required>
                </div>

                {{-- <div class="mb-2">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="order_items[0][price]" class="form-control" step="0.01" min="0">
                </div> --}}
            </div>
        </div>

        <div class="row my-5">
            <div class="col text-center">
                <!-- Button to Add More Order Items -->
                <button type="button" class="btn btn-primary" id="add-order-item">إضافة عنصر جديد</button>
            </div>
            <div class="col">
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">تأكيد الطلبية</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let itemIndex = 1;

    // Add new order item fields dynamically
    document.getElementById('add-order-item').addEventListener('click', function() {
        const orderItemsDiv = document.getElementById('order-items');
        const newOrderItem = document.createElement('div');
        newOrderItem.classList.add('order-item', 'mb-3');
        newOrderItem.innerHTML = `
            <div class="mb-2">
                <label for="goods_id" class="form-label">المنتج</label>
                <select name="order_items[${itemIndex}][goods_id]" class="form-select" required>
                    @foreach($goods as $good)
                        <option value="{{ $good->id }}">{{ $good->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="count" class="form-label">الكمية / كيلو</label>
                <input type="number" name="order_items[${itemIndex}][count]" class="form-control" min="1" required>
            </div>
        `;

        orderItemsDiv.appendChild(newOrderItem);
        itemIndex++;
    });
</script>
@endsection
