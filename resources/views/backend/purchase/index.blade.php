@extends('layouts.backend_app')

@section('content')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card px-5">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Create New Purchase</h4>
                            <form>
                                <div class="form-group row mb-1">
                                    <label for="projectname" class="col-form-label col-lg-2">Supplier </label>
                                    <div class="col-lg-4 ajax-select">
                                        <select class="form-control form-control-sm select2 select2-ajax"></select>
                                    </div>

                                    <label for="projectname" class="col-form-label col-lg-2">Date </label>
                                    <div class="col-lg-4 ajax-select">
                                        <input type="date" class="form-control form-control-sm" id="orderid-input" placeholder="Select date" data-date-format="dd M, yyyy" data-date-orientation="bottom auto" data-provide="datepicker" data-date-autoclose="true">
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="projectbudget" class="col-form-label col-lg-2">Invoice No</label>
                                    <div class="col-lg-4">
                                        <input id="projectbudget" name="projectbudget" type="text" placeholder="Invoice No" class="form-control form-control-sm">
                                    </div>

                                    <label for="projectdesc" class="col-form-label col-lg-2 form-control-sm">Details</label>
                                    <div class="col-lg-4">
                                        <textarea class="form-control form-control-sm" id="projectdesc" rows="1" placeholder="Details..."></textarea>
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
                                <table id="datatable" class="table repeater" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Item Information</th>
                                        <th class="text-center">Batch No.</th>
                                        <th class="text-center">Ava. Qnty</th>
                                        <th class="text-center">Qnty</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Dis/ Pcs (%)</th>
                                        <th class="text-center">Vat (%)</th>
                                        <th class="text-center">Product vat</th>
                                        <th class="text-center">total</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                    </thead>


                                    <tbody data-repeater-list="group-a">
                                    <tr data-repeater-item>
                                        <td style="text-align: center; vertical-align: middle;">
                                                <input type="text" style="width: 120px;">
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">55775381</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                                 <input id="" type="text" value="0" name="" style="width: 120px;" readonly>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                                <input id="" type="text" value="0" name="" style="width: 120px;">
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                                <input id="" type="text" value="0" name="" style="width: 120px;">
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                                <input id="" type="text" value="0" name="" style="width: 120px;">
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                                <input id="" type="text" value="0" name="" style="width: 120px;">
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                                <input id="" type="text" value="0" name="" style="width: 120px;" readonly>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                                <input id="" type="text" value="0" name="" style="width: 120px;" readonly>
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
