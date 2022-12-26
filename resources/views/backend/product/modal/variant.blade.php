      <!-- sample modal content -->
      <div id="variantModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myVariantLabel"
          aria-hidden="true">
          <form action="" method="post" id="addVariant">
              @csrf
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myVariantLabel">Variant</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="type">Variant Type</label>
                                      <select class="form-control type" name="type" id="type">
                                          <option value="">Select Option</option>
                                          <option value="Size">Size</option>
                                          <option value="Color">Color</option>
                                          <option value="Material_Type">Material Type</option>
                                      </select>
                                      <span class="text-danger err_type"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="name">Variant Name</label>
                                      <input type="text" name="name" id="name" class="form-control"
                                          placeholder="Enter Variant Name">
                                      <span class="text-danger err_name"></span>
                                  </div>
                              </div>
                              <div class="col-md-12 color_code_content">
                                  <div class="form-group">
                                      <label for="color_code">Color Code</label>
                                      <input type="color" name="color_code" id="color_code" class="form-control">
                                      <span class="text-danger err_color_code"></span>
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
                          <button type="button" class="btn btn-secondary waves-effect"
                              data-dismiss="modal">Close</button>
                          <button type="button"
                              class="btn btn-primary waves-effect waves-light add_variant">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->