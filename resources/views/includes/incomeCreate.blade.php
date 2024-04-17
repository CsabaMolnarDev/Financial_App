{{-- here we can track our spendings --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <form id="categoryForm" action="{{ route('finances.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <input type="number" min="0" name="price" id="price"
                                class="form-control @if ($errors->has('price')) is-invalid @endif"
                                value="{{ old('price') }}">
                            <span class="input-group-text">{{ $currency }}</span>
                        </div>
                        @error('price')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" class="form-control" name="category_id">
                            <option value="" selected disabled>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            <option value="add_category">Add new Category</option>
                        </select>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-danger w-75">Add new</button>
                        <input type="checkbox" name="monthly" id="monthly">
                    </div>
                </form>
                <form action="{{ route('addCategory') }}" method="POST">
                    @csrf
                    <div class="mb-3 text-center" id="newCategoryForm" style="display: none;">
                        <input type="text" id="newCategoryInput" name="new_category" placeholder="Enter new category">
                        <button id="addCategoryBtn" type="submit" class="btn btn-outline-danger">Add Category</button>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <script>
        document.body.style.backgroundImage = "url('../storage/pictures/incomeCreate.jpg')";
        document.getElementById('category_id').addEventListener('change', function() {
            var newCategoryForm = document.getElementById('newCategoryForm');
            if (this.value === 'add_category') {
                newCategoryForm.style.display = 'block';
            } else {
                newCategoryForm.style.display = 'none';
            }
        });
    </script>
@endsection
