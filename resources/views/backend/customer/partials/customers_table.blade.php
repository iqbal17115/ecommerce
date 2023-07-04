<table class="table table-hover datatable dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Orders</th>
                                            <th scope="col">Last Order</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>

                                    </thead>

                                    <tbody id="main-content">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->mobile }}</td>
                                                <td>{{ $customer->Contact?->Order->count() ?? 0 }}</td>
                                                <td>{{ $customer->Contact?->Order->count() > 0 ? $customer->Contact?->Order->max('created_at')->diffForHumans() : 'No orders' }}
                                                </td>
                                                <td>
                                                    {{ $customer->address }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-success font-size-10">Completed</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle card-drop"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#" class="dropdown-item">Details</a></li>
                                                            <li><a href="#" class="dropdown-item">Edit</a></li>
                                                            <li><a href="#" class="dropdown-item">Active</a></li>
                                                            <li><a href="#" class="dropdown-item">Inactive</a></li>
                                                            <li><a href="#" class="dropdown-item">Make Vendor</a></li>
                                                            <li><a href="#" class="dropdown-item">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>