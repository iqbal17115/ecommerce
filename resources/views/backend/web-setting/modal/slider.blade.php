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
                                      <label for="link">Slider Link</label>
                                      <input type="text" name="link" id="link" class="form-control" placeholder="Enter Slider Link">
                                      <span class="text-danger err_link"></span>
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
                                  <label for="category_id">Select Category</label>
                                  <select class="form-select category_id" name="category_id" id="category_id" style="width: 100%;">
                                      <option value="">Select Option</option>
                                      @foreach($categories as $category)
                                      <option value="{{$category->id}}">
                                          {{$category->name}}
                                      </option>
                                      <!-- Start Sub-Category -->
                                      @if($category->SubCategory)
                                      @foreach($category->SubCategory as $subCategory)
                                      <option value="{{$subCategory->id}}">
                                          --{{$subCategory->name}}
                                      </option>
                                      <!-- Start sub-Sub-Category -->
                                      @if($subCategory->SubCategory)
                                      @foreach($subCategory->SubCategory as $subSubCategory)
                                      <option value="{{$subSubCategory->id}}">
                                          ----{{$subSubCategory->name}}
                                      </option>
                                      <!-- Start sub-Sub-Sub-Category -->
                                      @if($subSubCategory->SubCategory)
                                      @foreach($subSubCategory->SubCategory as $subSubSubCategory)
                                      <option value="{{$subSubSubCategory->id}}">
                                          ------{{$subSubSubCategory->name}}
                                      </option>
                                      <!-- Start sub-Sub-Sub-Sub-Category -->
                                      @if($subSubSubCategory->SubCategory)
                                      @foreach($subSubSubCategory->SubCategory as $subSubSubSubCategory)
                                      <option value="{{$subSubSubSubCategory->id}}">
                                          --------{{$subSubSubSubCategory->name}}
                                      </option>
                                      @endforeach
                                      @endif
                                      <!-- End sub-Sub-Sub-Sub-Category -->
                                      @endforeach
                                      @endif
                                      <!-- End sub-Sub-Sub-Category -->
                                      @endforeach
                                      @endif
                                      <!-- End sub-Sub-Category -->
                                      @endforeach
                                      @endif
                                      <!-- End Sub Category -->
                                      @endforeach
                                  </select>
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