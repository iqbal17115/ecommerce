      <!-- sample modal content -->
      <div id="advertisementModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myAdvertisementLabel" aria-hidden="true">
          <form action="" method="post" id="addAdvertisement" enctype="multipart/form-data">
              @csrf
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myAdvertisementLabel">Advertisement</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="add_page">Add Page</label>
                                      <select name="add_page" id="add_page" class="form-control">
                                          <option value="">Select Option</option>
                                          <option value="Home">Home</option>
                                          <option value="Category">Category</option>
                                          <option value="Details">Details</option>
                                      </select>
                                      <span class="text-danger err_add_page"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="position">Ads Position</label>
                                      <input type="text" name="position" id="position" class="form-control" placeholder="Enter Ads Position">
                                      <span class="text-danger err_position"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="ads_style">Ads Style</label>
                                      <select name="ads_style" id="ads_style" class="form-control">
                                          <option value="1">Style One</option>
                                          <option value="2">Style Two</option>
                                          <option value="3">Style Three</option>
                                      </select>
                                      <span class="text-danger err_ads_style"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="ads_type">Ads Type</label>
                                      <select name="ads_type" id="ads_type" class="form-control">
                                          <option value="">Select Option</option>
                                          <option value="1">Embed Code</option>
                                          <option value="2">Image Ads</option>
                                      </select>
                                      <span class="text-danger err_ads_type"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                <div class="row" id="ads_content">
                                    
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