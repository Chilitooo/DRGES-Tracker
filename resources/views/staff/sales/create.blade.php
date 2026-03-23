@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">New Sale</h4>

    <form method="POST" action="{{ route('staff.sales.store') }}">
        @csrf

        {{-- Product --}}
        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" id="product" class="form-select" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option 
                        value="{{ $product->id }}"
                        data-price="{{ $product->selling_price }}"
                        data-stock="{{ $product->current_stock }}">
                        {{ $product->name }} (Stock: {{ $product->current_stock }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label>Unit Price</label>
            <input type="text" id="price" class="form-control" readonly>
        </div>

        {{-- Quantity --}}
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        {{-- Discount --}}
        <div class="mb-3">
            <label>Discount (%)</label>
            <input type="number" name="discount" id="discount" value="0" class="form-control">
        </div>

        {{-- Subtotal --}}
        <div class="mb-3">
            <label>Subtotal</label>
            <input type="text" id="subtotal" class="form-control" readonly>
        </div>

        {{-- Payment Method --}}
        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="cash">Cash</option>
                <option value="gcash">GCash</option>
                <option value="paymaya">PayMaya</option>
            </select>
        </div>

        {{-- Reference Number (Hidden by Default) --}}
        <div class="mb-3 d-none" id="referenceDiv">
            <label>Reference Number</label>
            <input type="text" name="reference_number" class="form-control">
        </div>

        <button class="btn btn-success w-100">Complete Sale</button>
    </form>
</div>

<script>
const product = document.getElementById('product');
const price = document.getElementById('price');
const qty = document.getElementById('quantity');
const discount = document.getElementById('discount');
const subtotal = document.getElementById('subtotal');
const payment = document.getElementById('payment_method');
const refDiv = document.getElementById('referenceDiv');

function calculate() {
    let p = parseFloat(price.value) || 0;
    let q = parseInt(qty.value) || 0;
    let d = parseFloat(discount.value) || 0;

    let total = p * q;
    total = total - (total * d / 100);

    subtotal.value = total.toFixed(2);
}

product.addEventListener('change', function(){
    let selected = this.options[this.selectedIndex];
    price.value = selected.getAttribute('data-price');
    calculate();
});

qty.addEventListener('input', calculate);
discount.addEventListener('input', calculate);

payment.addEventListener('change', function(){
    if(this.value !== 'cash'){
        refDiv.classList.remove('d-none');
    } else {
        refDiv.classList.add('d-none');
    }
});
</script>
@endsection