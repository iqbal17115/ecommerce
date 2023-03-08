      <!-- sample modal content -->
      <div id="blockModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myBlockLabel" aria-hidden="true">
          <form action="" method="post" id="addShippingCharge" enctype="multipart/form-data">
              @csrf
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myBlockLabel">Shipping Charge</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <input type="hidden" value="{{$dimension_type}}" name="dimension_type" id="dimension_type"/>
                      <div class="modal-body">
                          <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                          <div class="col-md-6">
                                  <label for="type">Shipping Type</label>
                                  <select class="form-select" name="dimension_type" id="dimension_type" style="width: 100%;">
                                      <option value="">Select Option</option>
                                      <option value="PerUnit">PerUnit</option>
                                      <option value="Range">Range</option>
                                  </select>
                            </div>
                          <div class="col-md-6">
                                  <label for="type">Type</label>
                                  <select class="form-select" name="type" id="type" style="width: 100%;" onchange="changeType(this)" required>
                                      <option value="">Select Option</option>
                                      <option value="Weight">Weight</option>
                                      <option value="Area">Area</option>
                                      <option value="Default">Default</option>
                                  </select>
                            </div>
                              <div class="col-md-6 shipping-charge-style">
                                  <div class="form-group">
                                      <label id="from_range" for="start">Start</label>
                                      <input type="number" name="start" id="start" class="form-control" placeholder="Start">
                                      <span class="text-danger err_start"></span>
                                  </div>
                              </div>
                              <div class="col-md-6 shipping-charge-style">
                                  <div class="form-group">
                                      <label id="to_range" for="end">End</label>
                                      <input type="number" name="end" id="end" class="form-control" placeholder="End">
                                      <span class="text-danger err_end"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="inside_amount">Inside</label>
                                      <input type="number" name="inside_amount" id="inside_amount" class="form-control" placeholder="Inside Amount" required>
                                      <span class="text-danger err_inside_amount"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="outside_amount">Outside</label>
                                      <input type="number" name="outside_amount" id="outside_amount" class="form-control" placeholder="Outside Amount" required>
                                      <span class="text-danger err_outside_amount"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="is_active">Status</label>
                                      <select name="is_active" id="is_active" class="form-control" required>
                                          <option value="">Select Status</option>
                                          <option value="1">Active</option>
                                          <option value="0">Inactive</option>
                                      </select>
                                      <span class="text-danger err_is_active"></span>
                                  </div>
                              </div>

                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->