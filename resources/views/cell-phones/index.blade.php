@extends('app-layout.master')
@section('content')
<div class="container-fluid mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cell Phones</li>
        </ol>
      </nav>
</div>
<div class="container">
    @if (Session::has('msg'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{ Session::get('msg') }}
    </div>
    @endif
    <div class="card mt-3 border-0">
        <div class="card-header">
            @auth
            <a href="{{ route('cellphone.create') }}" class="btn btn-primary float-right">Add New</a>
            @endauth
            <h5 class="card-title">List of available Cell Phones</h5>
        </div>
        <div class="card-body px-0">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="search">Search by Brand</label>
                        <input id="search" data-id="" placeholder="Search..." class="form-control" type="text" name="">
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="result">
                <table class="table table-striped table-hover table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Sr. No</th>
                            <th>Image</th>
                            <th>Brand Name</th>
                            <th>Model Name</th>
                            <th>RAM</th>
                            <th>Storage</th>
                            <th>Primary Camera</th>
                            <th>Secondary Camera</th>
                            <th>Price</th>
                            <th>Created By</th>
                            @auth
                            <th>Action</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $x = 1;
                        @endphp
                        @foreach ($phones as $phone)
                        <tr>
                            <td>{{ $x++ }}</td>
                            <td>
                                <img src="{{ Storage::url( $phone->image) }}" alt="" style="width: 40px;">
                            </td>
                            <td>{{ $phone->brand_name }}</td>
                            <td>{{ $phone->model_name }}</td>
                            <td>{{ $phone->ram_capacity ?? '--' }} GB</td>
                            <td>{{ $phone->rom_capacity }} GB</td>
                            <td>{{ $phone->primary_camera }} MP</td>
                            <td>{{ $phone->secondary_camera }} MP</td>
                            <td>{{ $phone->price }}</td>
                            <td>{{ $phone->owner['name'] }}</td>
                            @auth
                            <td>
                                <a href="{{ route('cellphone.edit', $phone->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('cellphone.delete', $phone->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                            @endauth
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $phones->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        $("#search").autocomplete({
        highlightClass: "bold",
        source: function( request, response ) {

            var regex = new RegExp(request.term, 'i');

            $.ajax({
                url: "search-cell-phone",
                dataType: "json",
                data: {term: request.term},
                success: function(data) {
                    response($.map(data.suggetions, function(item) {
                        if(regex.test(item.brand_name)){
                            return {
                                id: item.id,
                                value: item.brand_name
                            };
                        }
                    }));
                }
            });
        },
        minlength:3,
        select: function (event, ui) {
            $("#search").val(ui.item.value);
            $("#search").attr('data-id', ui.item.id);
            console.log(ui.item.id);
            getSearchResult(ui.item.value);
        }
        });

        function getSearchResult(term){
            $.ajax({
                url:'/get-search-result',
                type:"GET",
                data: {'term': term},
                success:function(result){
                    $('#result').html(result);
                },
                error:function(err){
                    console.log(err);
                }
            });
        }

    });
</script>
@endsection
