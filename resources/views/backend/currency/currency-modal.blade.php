      <!-- sample modal content -->
      <div id="currencyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myCurrencyLabel" aria-hidden="true">
          <form method="post" id="addCurrency">
              @csrf
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myCurrencyLabel">Currency</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="name">Name</label>
                                      <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                                      <span class="text-danger err_name"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="icon">Icon</label>
                                      <input type="text" name="icon" id="icon" class="form-control" placeholder="Enter Icon" required>
                                      <span class="text-danger err_icon"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="position">Position</label>
                                      <select name="position" id="position" class="form-control" required>
                                          <option value="1">Left</option>
                                          <option value="0">Right</option>
                                      </select>
                                      <span class="text-danger err_position"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="conversion_rate">Conversion Rate</label>
                                      <input type="text" name="conversion_rate" id="conversion_rate" class="form-control" placeholder="Enter Vonversion Rate">
                                      <span class="text-danger err_conversion_rate"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                              <label for="conversion_rate">Default Status</label>
                                   <select name="is_default" id="is_default" class="form-select" required>
                                        <option value="">Select Option</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                  </select>
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