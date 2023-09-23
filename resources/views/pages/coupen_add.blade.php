@extends('pages.master')

@section('title')
    Coupens
@endsection


@section('content')
    <div class="table-responsive">
        <table class="table  table-striped  table-bordered">
            <caption class="mt-4">
                <!-- Button trigger modal -->
            </caption>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Add Coupens</h4>

                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form id="formSubmit" method="POST">

                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="error-message alert-danger">

                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <label for="" class="form-label">Coupen Name</label>
                                            <input type="text" name="coupen" id="coupen" class="form-control">
                                            <span class="text-danger nm"></span>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <label for="" class="form-label">Quantity</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control">
                                            <span class="text-danger quantity"></span>
                                        </div>
                                        @php
                                            $arr = [];
                                            for ($i = 1; $i <= 100; $i++) {
                                                if ($i % 3 == 0) {
                                                    $arr[$i] = $i . '%';
                                                }
                                        } @endphp
                                        <div class="col-12 mt-4">
                                            <label for="" class="form-label">Discount</label>
                                            <select name="discount" id="discount" class="form-control form-select">
                                                <option value="">Select the discount</option>
                                                @foreach ($arr as $a)
                                                    <option value="{{ $a }}">{{ $a }}</option>
                                                @endforeach
                                            </select>

                                            <span class="text-danger discount-msg"></span>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <label for="" class="form-label">Expire Date</label>
                                            <input type="date" name="expire" id="expire" class="form-control">
                                            <span class="text-danger date-msg"></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close_modal"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary button-submit">Save changes</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            </caption>
            <thead class="table-dark text-center ">
                <th>Id</th>
                <th>Coupen name</th>
                <th>Quantity</th>

                <th>Coupen Expire Date</th>
                <th>Coupen Discount</th>

                <th colspan="2">Actions</th>

            </thead>
            <tbody class="text-center">

            </tbody>

        </table>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Coupen
    </button>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Edit Coupens</h4>

                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="editForm" method="POST">

                            <div class="row">
                                <div class="col-12">
                                    <ul class="edit-error-message alert-danger">

                                    </ul>
                                </div>

                                <input type="hidden" name="id" class="ID">
                                <div class="col-12">
                                    <label for="" class="form-label">Coupen Name</label>
                                    <input type="text" name="coupen" class="form-control coupens">
                                    <span class="text-danger nm"></span>
                                </div>
                                <div class="col-12 mt-4">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control qty">
                                    
                                </div>
                                @php
                                    $arr = [];
                                    for ($i = 1; $i <= 100; $i++) {
                                        if ($i % 3 == 0) {
                                            $arr[$i] = $i . '%';
                                        }
                                } @endphp <div class="col-12 mt-4">
                                    <label for="" class="form-label">Discount</label>
                                    <select name="discount" id="discount" class="form-control form-select discount">
                                        <option value="">Select the discount</option>
                                        @foreach ($arr as $a)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger discount-msg"></span>
                                </div>
                                <div class="col-12 mt-4">
                                    <label for="" class="form-label">Expire Date</label>
                                    <input type="date" name="expire" id="expire" class="form-control expire">
                                    <span class="text-danger date-msg"></span>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary button-submit">Save changes</button>
                </div>
            </div>
        </div>
    @endsection


    {{-- Backend Code --}}
    @section('scripts')
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/coupens.js') }}"></script>
    @endsection
