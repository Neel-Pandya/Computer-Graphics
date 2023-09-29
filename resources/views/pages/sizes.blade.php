@extends('pages.master')

@section('title')
    Product Sizes
@endsection


@section('content')
    <div class="table-responsive">
        <table class="table  table-striped  table-bordered table-hover">

            
            <thead class="text-center bg-dark text-light">
                <th>Id</th>
                <th>Size name</th>
                <th>Status</th>
                <th colspan="2">Actions</th>
            </thead>
            <tbody class="text-center">
            </tbody>

        </table>
        

        {{-- Add Size Modal --}}
        <div class="modal fade" id="addSizesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Add Size</h3>

                    </div>
                    <div class="modal-body">
                        <form id="addSizesForm" >
                            <div class="row">
                                <div class="col-12">
                                    <ul class="size-errors alert-danger">

                                    </ul>
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Enter the size name</label>
                                    <input type="text" name="" id="size-name" class="form-control">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Size Modal --}}
        <div class="modal fade" id="editSizesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Size</h3>
            
                        </div>
                        <div class="modal-body">
                            <form id="editSizesForm" method="POST">
                                <div class="row">
                                    <input type="hidden" name="" id="size_id">
                                    <div class="col-12">
                                        <ul class="edit-size-errors alert-danger">
            
                                        </ul>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label">Enter the size name</label>
                                        <input type="text" name="" id="edit-size-name" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <button class="btn btn-primary button-add-size mt-4">
        Add Sizes
    </button>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/sizes.js') }}"></script>
@endsection
