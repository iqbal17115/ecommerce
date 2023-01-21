<table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Discount Percent</th>
                            <th scope="col">Discount Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($coupons as $coupon)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$coupon->name}}</td>
                            <td>{{$coupon->type}}</td>
                            <td>{{$coupon->amount}}</td>
                            <td>{{$coupon->amount}}</td>
                            <td>{{$coupon->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#couponModal" data-id="{{$coupon->id}}" data-type="{{$coupon->type}}" data-amount="{{$coupon->amount}}" data-start_date="{{$coupon->start_date}}" data-end_date="{{$coupon->end_date}}" data-is_active="{{$coupon->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_coupon" data-id="{{$coupon->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $coupons->links() !!}