@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <div class="row">
                    @if(count($galleries) > 0)
                        @foreach($galleries as $gallery)
                            <div class="col-sm-2">
                                <div class="position-relative">
                                    <a class="example-image-link" href="{{ asset('storage/posts_image/' . $gallery->picture) }}" data-lightbox="roadtrip" data-title="{{ $gallery->description }}">
                                        <img class="example-image img-fluid mb-2" src="{{ asset('storage/posts_image/' . $gallery->picture) }}" alt="image-1" />
                                    </a>

                                    <!-- Edit and Delete Buttons -->
                                    <div class="text-center mt-2">
                                        <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3>Tidak ada data.</h3>
                    @endif
                    <div class="d-flex">
                        {{ $galleries->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <a href="{{ route('gallery.create') }}" class="btn btn-primary" style="margin: 30px auto 0;">Add Photo</a>
        </div>
    </div>
</div>
@endsection
