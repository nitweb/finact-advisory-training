@extends('backend.admin.master')

@section('admin_title', $title)

@section('admin_content')

    <div class="main-content">

        <section class="section">

            <div class="section-body">

                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ $title }}</h4>
                                <h4>
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark"> <i class="fas fa-arrow-left"></i> Back</a>
                                </h4>
                            </div>

                            <div class="card-body">

                                @include('widgets.errors')

                                <form id="form" action="{{ route('admin.book.update') }}" method="post" enctype="multipart/form-data" data-parsley-validate>

                                    @csrf
                                    <input type="hidden" name="id" value="{{ $book->id }}">

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $book->title) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Author</label>
                                            <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author', $book->author) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-4">
                                            <label class="col-form-label">Price (৳)</label>
                                            <input type="number" min="0" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $book->price) }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-form-label">Stock</label>
                                            <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $book->stock) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Cover Image</label>
                                            @if ($book->cover_image)
                                                <div class="mb-2"><img src="{{ asset($book->cover_image) }}" style="width:80px;"></div>
                                            @endif
                                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Sample PDF (for readers to preview)</label>
                                            @if ($book->sample_pdf)
                                                <div class="mb-2"><a href="{{ asset($book->sample_pdf) }}" target="_blank"><i class="fas fa-file-pdf"></i> View Current Sample</a></div>
                                            @endif
                                            <input type="file" class="form-control @error('sample_pdf') is-invalid @enderror" name="sample_pdf" accept="application/pdf">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ old('description', $book->description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-4">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                                <option value="active" {{ $book->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $book->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-8">
                                            <label class="col-form-label"></label>
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

@endsection
