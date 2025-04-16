@php
    $isEdit = isset($product);
@endphp

<div class="mb-3">
    <label for="name">Tên sản phẩm</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="originalPrice">Giá gốc</label>
    <input type="number" step="0.01" name="originalPrice" class="form-control" value="{{ old('originalPrice', $product->originalPrice ?? '') }}">
</div>

<div class="mb-3">
    <label for="salePrice">Giá khuyến mãi</label>
    <input type="number" step="0.01" name="salePrice" class="form-control" value="{{ old('salePrice', $product->salePrice ?? '') }}">
</div>

<div class="mb-3">
    <label for="category_id">Danh mục</label>
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="quantity">Số lượng</label>
    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity ?? 0) }}">
</div>

<div class="mb-3">
    <label for="image">Ảnh sản phẩm</label>
    <input type="file" name="image" class="form-control">
    @if($isEdit && $product->image)
        <img src="{{ asset('images/products/' . $product->image) }}" width="100" class="mt-2">
    @endif
</div>
