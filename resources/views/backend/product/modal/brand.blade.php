      <!-- sample modal content -->
      <div id="brandModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myBrandLabel"
          aria-hidden="true">
          <form action="" method="post" id="addBrand" enctype="multipart/form-data">
              @csrf
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myBrandLabel">Brand</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="name">Brand Name</label>
                                      <input type="text" name="name" id="name" class="form-control"
                                          placeholder="Enter Brand Name">
                                          <span class="text-danger err_name"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="image">Image</label>
                                      <input type="file" name="image" id="image" class="form-control"
                                          placeholder="Enter Short Name">
                                          <span class="text-danger err_image"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="website">Website</label>
                                      <input type="text" name="website" id="website" class="form-control"
                                          placeholder="Enter Website">
                                          <span class="text-danger err_website"></span>
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
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->