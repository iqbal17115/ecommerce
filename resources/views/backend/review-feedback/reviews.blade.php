@extends('layouts.backend_app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                    <span class="h4">Review List</span>
                    <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal"
                        data-target="#currencyModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
                </div>
                <div class="col-md-12 currency_content">
                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th scope="col">SL.</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($content['deny_lists'] as $review)
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success change-status"> <i
                                                class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger change-status"> <i
                                                class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{-- {!! $currencies->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.change-status').click(function() {
                alert(true);
                var reviewId = $(this).data('review-id');
                var status = $(this).hasClass('btn-success') ? 'approve' : 'deny';

                $.ajax({
                    url: '/review-status',
                    type: 'POST',
                    data: {
                        review_id: reviewId,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Remove the table row of the clicked button
                        $(this).closest('tr').remove();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error case
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
