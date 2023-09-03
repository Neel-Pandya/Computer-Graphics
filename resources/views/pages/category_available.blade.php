@extends('pages.master')
@section('title')
    Products
@endsection
@section('content')
    <div class="table-responsive">
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
    <table class="table  table-striped  table-bordered table-hover">
        <caption class="mt-4"><a href="{{ route('category.add') }}"><button class="btn btn-info">Add
                    Category</button></a></caption>

        <thead class="bg-dark text-light text-center ">
            <th>Id</th>
            <th>Category name</th>
            <th>Category Status</th>
            <th colspan="2">Actions</th>

        </thead>
        <tbody class="text-center">
            @forelse($category_data as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->category_name }}</td>
                    <td>
                        @if ($data->status == 'Active')
                            <a href="{{ route('category.deactivate', ['category_name' => $data->category_name]) }}"><button
                                    class="btn btn-danger">Deactivate</button></a>
                        @elseif($data->status == 'Deactive')
                            <a href="{{ route('category.activate', ['category_name' => $data->category_name]) }}"><button
                                    class="btn btn-success">Active</button></a>
                        @elseif($data->status == 'Deleted')
                            <a href="{{ route('category.reactivate', ['category_name' => $data->category_name]) }}"><button class="btn btn-danger">Reactivate</button></a>
                        @endif
                    </td>
                    <td><a href=""><button class="btn btn-info">Edit</button></a></td>
                    <td><a href="{{ route('category.delete', ['category_name' => $data->category_name]) }}"><button class="btn btn-danger">Delete</button></a></td>
                </tr>
            @empty
            @endforelse
            {{ $category_data->links() }}
        </tbody>
    </table>
    </div>
    </div>
@endsection
