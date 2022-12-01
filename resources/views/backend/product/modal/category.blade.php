      <!-- sample modal content -->
      <div id="categoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myCategoryLabel"
          aria-hidden="true">
          <form action="" method="post" id="addCategory" enctype="multipart/form-data">
              @csrf
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myCategoryLabel">Category</h5>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="name">Category Name</label>
                                      <input type="text" name="name" id="name" class="form-control"
                                          placeholder="Enter Category Name">
                                      <span class="text-danger err_name"></span>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group category_load">
                                      <label for="id">Select Category</label>
                                      <select name="id" id="id" class="form-control category_id" style="width: 100%;">
                                          <option value="">Select Option</option>
                                          @foreach($parent_categories as $category)
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
                                                    <option value="{{$subCategory->id}}">
                                                        ----{{$subSubCategory->name}}
                                                    </option>
                                                    <!-- Start sub-Sub-Sub-Category -->
                                                    @if($subSubCategory->SubCategory)
                                                    @foreach($subSubCategory->SubCategory as $subSubSubCategory)
                                                    <option value="{{$subCategory->id}}">
                                                        ------{{$subSubSubCategory->name}}
                                                    </option>
                                                    <!-- Start sub-Sub-Sub-Sub-Category -->
                                                    @if($subSubSubCategory->SubCategory)
                                                    @foreach($subSubSubCategory->SubCategory as $subSubSubSubCategory)
                                                    <option value="{{$subCategory->id}}">
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
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="top_menu">Top Menu</label>
                                      <select name="top_menu" id="top_menu" class="form-control">
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="position">Menu Position</label>
                                      <input type="number" name="position" id="position" class="form-control"
                                          placeholder="Menu Position">
                                      <span class="text-danger err_position"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="image">Category Icon</label>
                                      <input type="file" name="icon" id="icon" class="form-control">
                                      <span class="text-danger err_icon"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="image">Category Image</label>
                                      <input type="file" name="image" id="image" class="form-control">
                                      <span class="text-danger err_image"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="vendor_commission_percentage">Vendor Commission(%)</label>
                                      <input type="number" name="vendor_commission_percentage"
                                          id="vendor_commission_percentage" class="form-control"
                                          placeholder="Vendor Commission">
                                      <span class="text-danger err_vendor_commission_percentage"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="is_active">Status</label>
                                      <select name="is_active" id="is_active" class="form-control">
                                          <option value="">Select Option</option>
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
                              <img id="imgPreviewIcon" class="rounded" src="#" alt=""
                                  style="width: 30px; height: 30px;" />
                          </center>
                          <center>
                              <img id="imgPreview" class="rounded" src="#" alt="" style="width: 30px; height: 30px;" />
                          </center>
                          <span style="width: 200px;"></span>
                          <button type="button" class="btn btn-secondary waves-effect"
                              data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->