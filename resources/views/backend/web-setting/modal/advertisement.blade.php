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
                                      <label for="page">Add Page</label>
                                      <select name="page" id="page" class="form-control" required>
                                          <option value="">Select Option</option>
                                          <option value="Home">Home</option>
                                          <option value="Category">Category</option>
                                          <option value="Details">Details</option>
                                      </select>
                                      <span class="text-danger err_page"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="position">Ads Position</label>
                                      <input type="text" name="position" id="position" class="form-control" placeholder="Enter Ads Position" required>
                                      <span class="text-danger err_position"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="ads">Ads</label>
                                      <input type="file" name="ads" id="ads" class="form-control">
                                      <span class="text-danger err_ads"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="style">After</label>
                                      <select name="product_feature_id" id="product_feature_id" class="form-select product_feature_id" required>
                                                        <option value=""></option>
                                                        @foreach($product_features as $product_feature)
                                                        <option value="{{$product_feature->id}}">{{$product_feature->name}}
                                                        </option>
                                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="width">Width</label>
                                      <select name="width" id="width" class="form-control ads_content" required>
                                          <option value="Full">Full</option>
                                          <option value="Half">Half</option>
                                          <option value="One Third">One Third</option>
                                      </select>
                                      <span class="text-danger err_width"></span>
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
                          <center>
                              <img id="imgPreview1" class="rounded" src="#" alt="" style="width: 30px; height: 30px;" />
                          </center>
                          <span style="width: 200px;"></span>
                          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->