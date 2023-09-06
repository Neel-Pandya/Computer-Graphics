    @extends('pages.master')
    @section('title')
        Products
    @endsection

    @section('content')
        <div class="alertMessages">
            @if (session()->has('Success'))
                <div class="alert alert-success  d-flex align-items-center" role="alert">
                    <strong>
                        {{ session('Success') }}
                    </strong>

                    <script>
                        setTimeout(() => {
                            $('.alert').alert('close');
                        }, 5000);
                    </script>
                    @php session()->forget('Success');  @endphp
                </div>
            @elseif(session()->has('Error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    {{ session('Error') }}
                    <script>
                        setTimeout(() => {
                            $('.alert').alert('close');
                        }, 5000);
                    </script>
                    @php session()->forget('Error'); @endphp


                </div>
            @endif


        </div>
        <div class="table-container">
            <div class="search mb-3 d-flex justify-content-end align-items-end text-center">
                <form action="{{ route('products.available') }}">

                    <input type="search" name="search" class="form-search" id="">
                    <input type="submit" value="Search" class="btn btn-success btn-sm mx-2">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover  text-center  table-bordered ">

                    <thead class="bg-dark text-light text-center">
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Category</th>
                        <th>Product For</th>
                        <th>Product Size</th>
                        <th>Product Image</th>
                        <th>Product Status</th>
                        <th colspan="2">Actions</th>
                    </thead>
                    <tbody class="">
                        @forelse ($getProductsRecord as $record)
                            <tr>
                                <td>{{ $record->Product_id }}</td>
                                <td>{{ $record->Product_name }}</td>
                                <td>{{ $record->Product_price }} Rs</td>
                                <td>{{ $record->Product_category }}</td>
                                <td>{{ $record->Product_for }}</td>
                                <td>{{ $record->Product_size }}</td>
                                <td><img src="{{ URL::to('/') }}/images/products/{{ $record->Product_image }}"
                                        alt="" class="img-fluid img-sm"></td>
                                <td>
                                    @if ($record->Product_status == 'Active')
                                        <a
                                            href="{{ route('products.deactivate', ['product_name' => $record->Product_name, 'product_size' => $record->Product_size, 'product_for' => $record->Product_for]) }}"><button
                                                class="btn btn-danger">Deactivate</button></a>
                                    @elseif($record->Product_status == 'Inactive')
                                        <a
                                            href="{{ route('products.activate', ['product_name' => $record->Product_name, 'product_size' => $record->Product_size, 'product_for' => $record->Product_for]) }}"><button
                                                class="btn btn-success">Activate</button></a>
                                    @elseif($record->Product_status == 'Deleted')
                                        <a
                                            href="{{ route('products.reactivate', ['product_name' => $record->Product_name, 'product_size' => $record->Product_size, 'product_for' => $record->Product_for]) }}"><button
                                                class="btn btn-danger">Reactivate</button></a>
                                    @endif
                                </td>
                                <td><a
                                        href="{{ route('products.edit', ['product_name' => $record->Product_name, 'product_size' => $record->Product_size, 'product_for' => $record->Product_for]) }}"><button
                                            class="btn btn-primary">Edit</button></a></td>

                                <td><a
                                        href="{{ route('products.delete', ['product_name' => $record->Product_name, 'product_size' => $record->Product_size, 'product_for' => $record->Product_for]) }}"><button
                                            class="btn btn-danger">Delete</button></a></td>

                            </tr>
                        @empty
                            <td colspan="10" class="text-center">
                                <h4>Product not found</h4>
                            </td>
                        @endforelse
                    </tbody>
                    {{ $getProductsRecord->links() }}

                </table>
            </div>
            <a href="{{ route('products.add') }}"><button class="btn btn-primary mt-3">Add Product</button></a>

        </div>
        </div>
    @endsection
