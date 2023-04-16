      <!-- sample modal content -->
      <div id="productFeatureModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myProductFeatureLabel"
          aria-hidden="true">
          <form method="post" id="addProductFeature">
              @csrf
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myProductFeatureLabel">Product Feature</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="name">Feature Name</label>
                                      <input type="text" name="name" id="name" class="form-control"
                                          placeholder="Enter Name" required>
                                          <span class="text-danger err_name"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="card_feature">Card Feature</label>
                                      <select name="card_feature" id="card_feature" class="form-control" required>
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="top_menu">Top Feature</label>
                                      <select name="top_menu" id="top_menu" class="form-control" required>
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="position">Position</label>
                                      <input type="number" name="position" id="position" class="form-control"
                                          placeholder="Enter Short Name" required>
                                          <span class="text-danger err_position"></span>
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
                          <button type="button" class="btn btn-secondary waves-effect"
                              data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary waves-effect waves-light add_product_feature">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->