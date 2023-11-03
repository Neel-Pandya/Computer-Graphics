@extends('pages.master')

@section('title')

Rating

@endsection

@section('title')
Products
@endsection
@section('content')

<div class="table-responsive">
    <table class="table  table-striped  table-bordered">

        <thead class="table-dark text-center ">
            <th>Id</th>
            <th>user email</th>
            <th>rating</th>
            <th>review</th>
        </thead>
        <tbody class="text-center">


        </tbody>
    </table>
</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {

        function loadAllRate() {
            $.ajax({
                type: "GET",
                url: "{{ URL::to('/') }}/admin/rating/get-rating-review",
                success: function (response) {
                    $.each(response.rating, function (indexInArray, valueOfElement) { 
                        let rating = ""
                        for(let i = 0; i<valueOfElement.rating; i++){
                            rating+= "<span style='color:'>&starf;</span>"
                        }
                         $("tbody").append(`
                            <tr> 
                                <td>${valueOfElement.id}</td>
                                <td>${valueOfElement.user_email}</td>
                                <td>${rating}</td>
                                <td>${valueOfElement.review}</td>
                            </tr>
                         
                         `)
                    });
                }
            });
        }
        loadAllRate()
            
        });
</script>
@endsection