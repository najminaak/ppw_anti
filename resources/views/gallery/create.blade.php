@extends('auth.layouts')
@section('content')
<form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: 30px auto 0; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
    @csrf
    <div class="mb-3 row">
        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="title" name="title" style="border-radius: 5px;">
            @error('title')
                <div class="alert alert-danger" style="margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
        <div class="col-md-6">
            <textarea class="form-control" id="description" rows="5" name="description" style="border-radius: 5px;"></textarea>
            @error('description')
                <div class="alert alert-danger" style="margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">File input</label>
        <div class="col-md-6">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-file" name="picture" style="border-radius: 5px;">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center" style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>
@endsection
