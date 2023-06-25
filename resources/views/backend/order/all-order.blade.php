@extends('layouts.backend_app')

@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Orders</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="search-box mr-2 mb-2 d-inline-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Add New Order</button>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Seller</th>
                                <th>Payment Status</th>
                                <th>Fullfilment Status</th>
                                <th>Delivery Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    07 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2540</a> </td>
                                <td>Neal Matthews</td>
                                <td>
                                    $400
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-mastercard mr-1"></i> Mastercard
                                </td>
                                <td>
                                    <span class="badge badge-success font-size-10">Completed</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    07 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2541</a> </td>
                                <td>Jamal Burnett</td>
                                <td>
                                    $380
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-danger font-size-12">Chargeback</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-visa mr-1"></i> Visa
                                </td>
                                <td>
                                    <span class="badge badge-success font-size-10">Completed</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    06 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2542</a> </td>
                                <td>Juan Mitchell</td>
                                <td>
                                    $384
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-paypal mr-1"></i> Paypal
                                </td>
                                <td>
                                    <span class="badge badge-success font-size-10">Completed</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    05 Oct, 2019
                                </td>
                                
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2543</a> </td>
                                <td>Barry Dick</td>
                                <td>
                                    $412
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-mastercard mr-1"></i> Mastercard
                                </td>
                                <td>
                                    <span class="badge badge-success font-size-10">Completed</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    04 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2544</a> </td>
                                <td>Ronald Taylor</td>
                                <td>
                                    $404
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-warning font-size-12">Refund</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-visa mr-1"></i> Visa
                                </td>
                                <td>
                                    <span class="badge badge-warning font-size-10">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    04 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2545</a> </td>
                                <td>Jacob Hunter</td>
                                <td>
                                    $392
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-paypal mr-1"></i> Paypal
                                </td>
                                <td>
                                    <span class="badge badge-warning font-size-10">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    03 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2546</a> </td>
                                <td>William Cruz</td>
                                <td>
                                    $374
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                </td>
                                <td>
                                    <i class="fas fa-money-bill-alt mr-1"></i> COD
                                </td>
                                <td>
                                    <span class="badge badge-danger font-size-10">Failed</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    02 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2547</a> </td>
                                <td>Dustin Moser</td>
                                <td>
                                    $350
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-mastercard mr-1"></i> Mastercard
                                </td>
                                <td>
                                    <span class="badge badge-success font-size-10">Completed</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    01 Oct, 2019
                                </td>
                                <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2548</a> </td>
                                <td>Clark Benson</td>
                                <td>
                                    $345
                                </td>
                                <td>
                                    Aladdinne
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-warning font-size-12">Refund</span>
                                </td>
                                <td>
                                    <i class="fab fa-cc-visa mr-1"></i> Visa
                                </td>
                                <td>
                                    <span class="badge badge-warning font-size-10">Pending</span>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <ul class="pagination pagination-rounded justify-content-end mb-2">
                    <li class="page-item disabled">
                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                            <i class="mdi mdi-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
