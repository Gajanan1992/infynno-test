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
            <td>{{ $phone->ram_capacity }} GB</td>
            <td>{{ $phone->rom_capacity }} GB</td>
            <td>{{ $phone->primary_camera }} MP</td>
            <td>{{ $phone->secondary_camera }} MP</td>
            <td>{{ $phone->price }}</td>
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
