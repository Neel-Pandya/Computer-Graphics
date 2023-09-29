@extends('pages.master')
@section('title')
    Products
@endsection
@section('content')
    <div class="table-responsive">
        <table class="table  table-striped  table-bordered table-hover">


            <thead class="bg-dark text-light text-center ">
                <th>Id</th>
                <th>Category name</th>
                <th>Category Status</th>
                <th colspan="2">Actions</th>

            </thead>
            <tbody class="text-center">
          
            </tbody>
        </table>
    </div>
    <a><button class="btn btn-info mt-4 add-category-button">Add
            Category</button></a>
    </div>
    </div>
    {{-- Add Category Modal --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-6" id="exampleModalLabel">Add Category</h3>

                </div>
                <div class="modal-body">
                    <ul class="category-error-messages alert-danger">

                    </ul>
                    <form method="POST" id="addCategoryForm">
                        <label for="" class="form-label">Enter Category Name</label>
                        <input type="text" id="category_name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Edit Category Modal --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-6" id="exampleModalLabel">Edit Category</h3>
    
                </div>
                <div class="modal-body">
                    <ul class="edit-category-error-messages alert-danger">
    
                    </ul>
                    <form method="POST" id="editCategoryForm">
                        <input type="hidden" name="" id="edit-id">
                        <label for="" class="form-label">Enter Category Name</label>
                        <input type="text" id="edit_category_name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/category.js') }}"></script>
@endsection
