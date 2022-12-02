      <!-- sample modal content -->
      <div id="sliderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySliderLabel" aria-hidden="true">
          <form action="" method="post" id="addSlider" enctype="multipart/form-data">
              @csrf
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="mySliderLabel">Slider</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="is_active">Add Page</label>
                                      <select name="is_active" id="is_active" class="form-control">
                                          <option value="">Select Option</option>
                                          <option value="Home">Home</option>
                                          <option value="Category">Category</option>
                                          <option value="Details">Details</option>
                                      </select>
                                      <span class="text-danger err_is_active"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="position">Ads Position</label>
                                      <input type="text" name="position" id="position" class="form-control" placeholder="Enter Ads Position">
                                      <span class="text-danger err_position"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="is_active">Add Page</label>
                                      <select name="is_active" id="is_active" class="form-control">
                                          <option value="">Select Option</option>
                                          <option value="1">Style One</option>
                                          <option value="2">Style Two</option>
                                          <option value="3">Style Three</option>
                                      </select>
                                      <span class="text-danger err_is_active"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="image">Slider Image</label>
                                      <input type="file" name="image" id="image" class="form-control">
                                      <span class="text-danger err_image"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="position">Slider Position</label>
                                      <input type="text" name="position" id="position" class="form-control" placeholder="Enter Slider Position">
                                      <span class="text-danger err_position"></span>
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
                          <center>
                              <img id="imgPreview" class="rounded" src="#" alt="" style="width: 30px; height: 30px;" />
                          </center>
                          <span style="width: 200px;"></span>
                          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->