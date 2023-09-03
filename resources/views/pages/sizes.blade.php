@extends('pages.master')

@section('title')
    Product Sizes
@endsection


@section('content')
    <div class="table-responsive">
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
        <table class="table  table-striped  table-bordered table-hover">

            <caption class="mt-4"><a href="{{ route('sizes.add') }}"><button class="btn btn-info">Add Size</button></a>
            </caption>
            <thead class="text-center bg-dark text-light">
                <th>Id</th>
                <th>Size name</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody class="text-center">
                @php $count = 1; @endphp

                @forelse ($sizeData as $data)
                    <tr>
                        <td>{{ $sizeData->firstItem() + $loop->index }}</td>
                        <td>{{ $data->size_name }}</td>
                        @if ($data->status == 'Active')
                            <td><a href="{{ route('sizes.deactivate', ['size_name' => $data->size_name]) }}"><button
                                        class="btn btn-danger">Deactivate</button></a></td>
                        @elseif($data->status == 'Deactive')
                            <td><a href="{{ route('sizes.activate', ['size_name' => $data->size_name]) }}"><button
                                        class="btn btn-success">Activate</button></a></td>
                        @elseif($data->status == 'Deleted')
                            <td><a href="{{ route('sizes.reactivate', ['size_name' => $data->size_name]) }}"><button
                                        class="btn btn-danger">Reactivate</button></a></td>
                        @endif




                        <td><a href="{{ route('sizes.delete', ['size_name' => $data->size_name]) }}"><button
                                    class="btn btn-danger">Delete</button></a></td>
                    </tr>

                @empty

                    <td colspan="4">

                        <h4>there is no sizes</h4>
                    </td>
                @endforelse
            </tbody>
            {{ $sizeData->links() }}
        </table>
    </div>
    </div>
@endsection
