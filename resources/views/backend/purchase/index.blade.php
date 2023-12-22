@extends('layouts.backend_app')

@section('content')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Create New Purchase</h4>
                            <form>
                                <div class="form-group row mb-1">
                                    <label for="projectname" class="col-form-label col-lg-2">Supplier </label>
                                    <div class="col-lg-4 ajax-select">
                                        <select class="form-control select2 select2-ajax"></select>
                                    </div>

                                    <label for="projectname" class="col-form-label col-lg-2">Date </label>
                                    <div class="col-lg-4 ajax-select">
                                        <input type="date" class="form-control" id="orderid-input" placeholder="Select date" data-date-format="dd M, yyyy" data-date-orientation="bottom auto" data-provide="datepicker" data-date-autoclose="true">
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="projectbudget" class="col-form-label col-lg-2">Invoice No</label>
                                    <div class="col-lg-4">
                                        <input id="projectbudget" name="projectbudget" type="text" placeholder="Invoice No" class="form-control">
                                    </div>

                                    <label for="projectdesc" class="col-form-label col-lg-2">Details</label>
                                    <div class="col-lg-4">
                                        <textarea class="form-control" id="projectdesc" rows="1" placeholder="Details..."></textarea>
                                    </div>
                                </div>
                            </form>
                            <div class="row justify-content-end">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap repeater" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Item Information</th>
                                        <th>Batch No.</th>
                                        <th>Ava. Qnty</th>
                                        <th>Qnty</th>
                                        <th>Rate</th>
                                        <th>Dis/ Pcs (%)</th>
                                        <th>Vat (%)</th>
                                        <th>Product vat</th>
                                        <th>total</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>


                                    <tbody data-repeater-list="group-a">
                                    <tr data-repeater-item>
                                        <td>
                                                <input type="text">
                                        </td>
                                        <td>55775381</td>
                                        <td>
                                                 <input id="" type="text" value="0" name="" readonly>
                                        </td>
                                        <td>
                                                <input id="" type="text" value="0" name="">
                                        </td>
                                        <td>
                                                <input id="" type="text" value="0" name="">
                                        </td>
                                        <td>
                                                <input id="" type="text" value="0" name="">
                                        </td>
                                        <td>
                                                <input id="" type="text" value="0" name="">
                                        </td>
                                        <td>
                                                <input id="" type="text" value="0" name="" readonly>
                                        </td>
                                        <td>
                                                <input id="" type="text" value="0" name="" readonly>
                                        </td>
                                        <td>
                                            <input data-repeater-delete type="button" class="btn btn-primary btn-block btn-sm" value="Delete"/>
                                    </td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <td><input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add New Item"/></td>
                                    </tr>
                                </tfoot>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
@endsection
@push('script')
    <script src="{{ asset('backend_js/order_product/advance_edit.js') }}"></script>
    <script></script>
@endpush
