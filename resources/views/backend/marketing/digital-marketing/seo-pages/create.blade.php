@extends('layouts.backend_app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">SEO Page</h4>
                                <div class="page-title-right">
                                    <a href="{{ route('seo-pages.index') }}"><i class="fas fa-list"></i> List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('seo-pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-heading"></i> Title <span class="mandatory">*</span>
                                        </h5>
                                        <div class="form-group">
                                            <input type="text" name="title" id="title" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-link"></i> URL <span class="mandatory">*</span>
                                        </h5>
                                        <div class="form-group">
                                            <input type="text" name="url" id="url" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-link"></i> Image <span class="mandatory">*</span>
                                        </h5>
                                        <div class="form-group">
                                            <input type="file" name="image" id="image" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-file-alt"></i> Description <span class="mandatory">*</span>
                                        </h5>
                                        <div class="form-group">
                                            <textarea name="description" id="description" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-key"></i> Keyword <span class="mandatory">*</span>
                                        </h5>
                                        <div class="form-group">
                                            <textarea name="keyword" id="keyword" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-icons"></i> Icon Active</h5>
                                        <div class="form-group">
                                            <select name="is_icon_active" id="is_icon_active" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-image"></i> Image Active</h5>
                                        <div class="form-group">
                                            <select name="is_image_active" id="is_image_active" class="form-control" required>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-calendar"></i> Date Active</h5>
                                        <div class="form-group">
                                            <select name="is_date_active" id="is_date_active" class="form-control" required>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary float-right">
                                            <i class="fas fa-plus"></i> Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $('#description').summernote({
            height: 120
        });
        $('#keyword').summernote({
            height: 120
        });
    </script>
@endpush
