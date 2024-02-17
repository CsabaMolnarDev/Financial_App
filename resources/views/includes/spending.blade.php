{{-- here we can track our spendings --}}
@extends('layouts.app')

@section('content')
<img id="regFormPicture" src="../storage/pictures/spending.jpg" alt="background" title="background">

<h1 class="text-info ">spending PAGE</h1>
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Name</h3>
                <input type="text" name="name" id="name">
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Amount</h3>
                <input type="number">
                <select name="currency">
            
                </select>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Category</h3>
                <select name="category" id="categorySelect">
                    <option value="" selected disabled>Select a category</option>
                @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                        <option value="add_category">Add new Category</option>
                </select>

                <form action="{{ route('addCategory') }}" method="POST">
                    @csrf
                    <div id="newCategoryForm" style="display: none;">
                        <input type="text" id="newCategoryInput" name="new_category" placeholder="Enter new category">
                        <button id="addCategoryBtn" type="submit">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Currency</h3>
                <p class="card-text">Text</p>
            </div>
        </div>
    </div>
</div>


<div id="chart">
</div>
<script>
    document.getElementById('categorySelect').addEventListener('change', function() {
        var newCategoryForm = document.getElementById('newCategoryForm');
        if (this.value === 'add_category') {
            newCategoryForm.style.display = 'block';
        } else {
            newCategoryForm.style.display = 'none';
        }
    });
</script>


@endsection
