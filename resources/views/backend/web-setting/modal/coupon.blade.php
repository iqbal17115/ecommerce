      <!-- sample modal content -->
      <div id="couponModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myCouponLabel" aria-hidden="true">
          <form method="post" id="addCoupon">
              @csrf
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myCouponLabel">Coupon</h5>
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
                                      <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                      <span class="text-danger err_name"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="type">Discount Type</label>
                                      <select name="type" id="type" class="form-control discount_content" onchange="discountType()">
                                          <option value="1">Discount Amount</option>
                                          <option value="0">Discount Percentage</option>
                                      </select>
                                      <span class="text-danger err_style"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                <div class="row" id="discount_content">
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for='discount_amount'>Discount Amount</label>
                                        <input type='number' name='discount_amount' id='discount_amount' class='form-control' placeholder="Discount Amount">
                                    </div>
                                </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="start_date">Start Date</label>
                                      <input type="date" name="start_date" id="start_date" class="form-control">
                                      <span class="text-danger err_start_date"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="end_date">End Date</label>
                                      <input type="date" name="end_date" id="end_date" class="form-control">
                                      <span class="text-danger err_end_date"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="is_active">Status</label>
                                      <select name="is_active" id="is_active" class="form-control">
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