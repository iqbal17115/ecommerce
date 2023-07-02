@extends('layouts.backend_app')

@section('content')

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Customers</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                    <li class="breadcrumb-item active">Manage Customers</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content p-3">
                    <div class="tab-pane active" id="all-order" role="tabpanel">
                        <form>
                            <div class="row">

                                <div class="col-xl col-md-2">
                                    <div class="form-group mt-3 mb-0">
                                        <label>Country</label>
                                        <select class="form-control select2-search-disable">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl col-md-2">
                                    <div class="form-group mt-3 mb-0">
                                        <label>City</label>
                                        <select class="form-control select2-search-disable">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl col-md-2">
                                    <div class="form-group mt-3 mb-0">
                                        <label>Gender</label>
                                        <select class="form-control select2-search-disable">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl col-md-2 align-self-end">
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-primary w-md">Add Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive mt-5">
                            <table class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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

                                <tbody>
                                    @php
                                      $i = 0;
                                    @endphp
                                    @foreach ($customers as $customer)
                                     <tr>
                                         <td>{{ ++$i }}</td>
                                         <td>{{$customer->name}}</td>
                                         <td>{{$customer->email}}</td>
                                         <td>{{$customer->mobile}}</td>
                                         <td>{{ $customer->Contact?->Order->count() ?? 0 }}</td>
                                         <td>{{ $customer->Contact?->Order->count() > 0 ? $customer->Contact?->Order->max('created_at')->diffForHumans() : 'No orders' }}</td>
                                         <td>
                                            {{$customer->address}}
                                         </td>
                                         <td>
                                            <span class="badge badge-success font-size-10">Completed</span>
                                         </td>
                                         <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
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
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
