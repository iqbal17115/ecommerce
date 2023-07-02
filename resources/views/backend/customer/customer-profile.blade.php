@extends('layouts.backend_app')
@push('links')
    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-7">
            <div class="card">
               
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                            class="img-thumbnail rounded-circle">
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <h5 class="font-size-15 text-truncate">{{ $user->name }}</h5>
                                    <p class="text-muted mb-0 text-truncate">Joined {{ $user->created_at->diffForHumans() }}</p>
                                    <p class="text-muted mb-0 text-truncate">Joined Date: {{ date('d-M-Y H:i', strtotime($user->created_at)) }}</p>
                                    <p class="text-muted mb-0 text-truncate">Status: {{ ucwords($user->status) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <hr>
                        </div>

                        <div class="col-sm-12">
                            <div class="pt-4">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="text-muted mb-0">Total Spent</p>
                                        <h5 class="font-size-18">125</h5>
                                    </div>

                                    <div class="col-sm-4">
                                        <p class="text-muted mb-0">Last Order</p>
                                        <h5 class="font-size-18">1 week ago</h5>
                                    </div>

                                    <div class="col-sm-4">
                                        <p class="text-muted mb-0">Total Orders</p>
                                        <h5 class="font-size-18">$1245</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->


        </div>

        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Default Address</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile :</th>
                                    <td>{{ $user->mobile }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail :</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">My Projects</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Projects</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Deadline</th>
                                    <th scope="col">Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Skote admin UI</td>
                                    <td>2 Sep, 2019</td>
                                    <td>20 Oct, 2019</td>
                                    <td>$506</td>
                                </tr>

                                <tr>
                                    <th scope="row">2</th>
                                    <td>Skote admin Logo</td>
                                    <td>1 Sep, 2019</td>
                                    <td>2 Sep, 2019</td>
                                    <td>$94</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Redesign - Landing page</td>
                                    <td>21 Sep, 2019</td>
                                    <td>29 Sep, 2019</td>
                                    <td>$156</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>App Landing UI</td>
                                    <td>29 Sep, 2019</td>
                                    <td>04 Oct, 2019</td>
                                    <td>$122</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Blog Template</td>
                                    <td>05 Oct, 2019</td>
                                    <td>16 Oct, 2019</td>
                                    <td>$164</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Redesign - Multipurpose Landing</td>
                                    <td>17 Oct, 2019</td>
                                    <td>05 Nov, 2019</td>
                                    <td>$192</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Logo Branding</td>
                                    <td>04 Nov, 2019</td>
                                    <td>05 Nov, 2019</td>
                                    <td>$94</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
