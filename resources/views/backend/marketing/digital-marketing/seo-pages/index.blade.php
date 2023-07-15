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
                                    <a href="{{ route('seo_pages_create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Create
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="row">
                        <div class="col-12">
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                    <strong>Error:</strong> {{ Session::get('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="table-responsive">
                                {{-- Table --}}
                                @include('backend.marketing.digital-marketing.seo-pages._seo_pages', [
                                    'seoPages' => $seoPages,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    // Auto close success and error messages after 5 seconds
    setTimeout(function () {
        $('.alert').alert('close');
    }, 5000);
</script>
@endpush
