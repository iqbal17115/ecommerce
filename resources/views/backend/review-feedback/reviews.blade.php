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
                    <table id="reviews-table" class="table table-striped">
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
                            @foreach ($content['pending_lists'] as $review)
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>
                                        <button type="button" data-review_id="{{ $review->id }}"
                                            class="btn btn-sm btn-success change-status">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" data-review_id="{{ $review->id }}"
                                            class="btn btn-sm btn-danger change-status">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" data-review_id="{{ $review->id }}"
                                            class="btn btn-sm btn-primary reply-review">
                                            Reply
                                        </button>
                                    </td>
                                </tr>
                                @foreach ($review->replies as $reply)
                                    <tr>
                                        <td colspan="3"></td>
                                        <td style="font-size: 18px; color:blueviolet">{{ $reply->reply }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {!! $currencies->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for reply -->
    <div class="modal" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="parentReviewId">
                    <div class="form-group">
                        <label for="replyComment">Reply Comment:</label>
                        <textarea class="form-control" id="replyComment" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="replySubmit">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.change-status').click(function() {
                var reviewId = $(this).data('review_id');
                var status = $(this).hasClass('btn-success') ? 'approve' : 'deny';
                var $element = $(this);
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
                        $element.closest('tr').remove();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error case
                        console.log(error);
                    }
                });
            });

            $('.reply-review').click(function() {
                var reviewId = $(this).data('review_id');
                $('#parentReviewId').val(reviewId); // Set the parent review id in the hidden input field
                $('#replyModal').modal('show'); // Show the reply modal
            });

            // Attach event listener to the reply submit button
            $('#replySubmit').click(function() {
                var parentReviewId = $('#parentReviewId').val();
                var replyComment = $('#replyComment').val();

                // Send an AJAX request to submit the reply
                $.ajax({
                    url: '/reviews/submitReply',
                    type: 'POST',
                    data: {
                        parent_review_id: parentReviewId,
                        reply_comment: replyComment
                    },
                    success: function(response) {
                        // Handle the success response here
                        console.log(response);
                        $('#replyModal').modal('hide'); // Hide the reply modal
                        // Perform any other necessary actions, such as updating the UI
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response here
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
