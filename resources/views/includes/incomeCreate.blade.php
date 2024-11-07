@extends('layouts.app')
@section('content')
    <div class="">
        <div class="">
            <div class=""></div>
            <div class="">
                <div class="">
                    <div class="">
                        <form id="categoryForm" action="{{ route('finances.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @if ($errors->has('name')) is-invalid @endif"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small class="">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="price" id="price"
                                        class="form-control @if ($errors->has('price')) is-invalid @endif"
                                        value="{{ old('price') }}">
                                    <span class="input-group-text">{{ $currency }}</span>
                                </div>
                                @error('price')
                                    <small class="">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="">
                                <label for="category_id" class="form-label">Category</label>
                                <select id="category_id" class="form-control" name="category_id" required>
                                    <option value="" selected disabled>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    <option value="add_category">Add new Category</option>
                                </select>
                                <div class="">
                                    <br>
                                    <div class="">
                                        <input type="checkbox" name="monthly" id="monthly" class="form-check-input">
                                        <label for="monthly" class="form-check-label">Monthly Income</label>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button id="add_new_btn" type="submit"
                                    class="form-control">Add new</button>
                                <div class="row">
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('addIncomeCategory') }}" method="POST">
                            @csrf
                            <div class="" id="newCategoryForm" style="display: none;">
                                <input class="form-control mb-3" type="text" id="newCategoryInput" name="new_category"
                                    placeholder="Enter new category">
                                <button id="addCategoryBtn" type="submit" class="">Add
                                    Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            var newCategoryForm = document.getElementById('newCategoryForm');
            var addNewBtn = document.getElementById('add_new_btn');
            if (this.value === 'add_category') {
                newCategoryForm.style.display = 'block';
                addNewBtn.disabled = true;
            } else {
                newCategoryForm.style.display = 'none';
                addNewBtn.disabled = false;
            }
        });
    </script>
@endsection
