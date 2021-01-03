@extends('app-layout.master')
@section('content')
<div class="container-fluid mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/cell-phones">Cell Phones</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add New Cell Phone</li>
        </ol>
      </nav>
</div>
<div class="container">
    <div class="card mt-3 ">
        <div class="card-header">
            <h5 class="card-title">
                Cell Phone information
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('cellphone.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input id="brand_name" class="form-control" value="{{ old('brand_name') }}" placeholder="Brand name" type="text" name="brand_name">
                            @error('brand_name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="model_name">Model Name</label>
                            <input id="model_name" class="form-control" value="{{ old('model_name') }}" placeholder="Model name" type="text" name="model_name">
                            @error('model_name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input id="image" class="form-control" value="{{ old('image') }}" placeholder="Upload Image" type="file" name="image">
                            @error('image')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input id="price" class="form-control" value="{{ old('price') }}" placeholder="Price" type="text" name="price">
                            @error('price')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ram_capacity">RAM Capacity</label>
                            <input id="ram_capacity" class="form-control" value="{{ old('ram_capacity') }}" placeholder="RAM Capacity" type="text" name="ram_capacity">
                            @error('ram_capacity')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rom_capacity">ROM Capacity</label>
                            <input id="rom_capacity" class="form-control" value="{{ old('rom_capacity') }}" placeholder="ROM Capacity" type="text" name="rom_capacity">
                            @error('rom_capacity')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="primary_camera">Primary Camera (In pixels)</label>
                            <input id="primary_camera" class="form-control" value="{{ old('primary_camera') }}" placeholder="ex. 8, 12, 48" type="text" name="primary_camera">
                            @error('primary_camera')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_camera">Secondary Camera (In pixels)</label>
                            <input id="secondary_camera" class="form-control" value="{{ old('secondary_camera') }}" placeholder="ex. 8, 12 " type="text" name="secondary_camera">
                            @error('secondary_camera')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="screen_size">Screen Size (In Inches)</label>
                            <input id="screen_size" class="form-control" value="{{ old('screen_size') }}" placeholder="ex. 8, 12 " type="text" name="screen_size">
                            @error('screen_size')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <a href="{{ route('cellphone.index') }}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
