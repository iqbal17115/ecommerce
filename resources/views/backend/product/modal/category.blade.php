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
                          @foreach (Config::get('languages') as $lang => $language)
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="name_{{ $lang }}">{{ ucfirst($lang) }} Name</label>
                                      <input type="text" class="form-control" id="name_{{ $lang }}"
                                          name="translations[{{ $lang }}][name]" placeholder="Enter {{ $language }}" required>
                                  </div>
                              </div>
                          @endforeach
                              <div class="col-md-6">
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
                                          <!-- Start sub-Sub-Sub-Sub-Sub-Category -->
                                          @if($subSubSubSubCategory->SubCategory)
                                          @foreach($subSubSubSubCategory->SubCategory as
                                          $subSubSubSubSubCategory)
                                          <option value="{{$subSubSubSubSubCategory->id}}">
                                              ----------{{$subSubSubSubSubCategory->name}}
                                          </option>
                                          <!-- Start sub-Sub-Sub-Sub-Sub-Sub-Category -->
                                          @if($subSubSubSubSubCategory->SubCategory)
                                          @foreach($subSubSubSubSubCategory->SubCategory as
                                          $subSubSubSubSubSubCategory)
                                          <option value="{{$subSubSubSubSubSubCategory->id}}">
                                              ----------{{$subSubSubSubSubSubCategory->name}}
                                          </option>
                                          @endforeach
                                          @endif
                                          <!-- End sub-Sub-Sub-Sub-Sub-Sub-Category -->
                                          @endforeach
                                          @endif
                                          <!-- End sub-Sub-Sub-Sub-Sub-Category -->
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
                                  <div class="form-group category_load">
                                      <label for="product_feature_id">Select Feature</label>
                                      <select name="product_feature_id" id="product_feature_id"
                                          class="form-control product_feature_id" style="width: 100%;">
                                          <option value="">Select Option</option>
                                          @foreach($product_features as $product_feature)
                                          <option value="{{$product_feature->id}}">
                                              {{$product_feature->name}}
                                          </option>
                                          <!-- End Sub Category -->
                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="sidebar_menu">Sidebar Menu</label>
                                      <select name="sidebar_menu" id="sidebar_menu" class="form-control" required>
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="sidebar_menu_position">Sidebar Menu Position</label>
                                      <input type="number" name="sidebar_menu_position" id="sidebar_menu_position"
                                          class="form-control" placeholder="Menu Position">
                                      <span class="text-danger err_sidebar_menu_position"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="top_menu">Top Menu</label>
                                      <select name="top_menu" id="top_menu" class="form-control" required>
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="position">Top Menu Position</label>
                                      <input type="number" name="position" id="position" class="form-control"
                                          placeholder="Menu Position">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="header_menu">Header Menu</label>
                                      <select name="header_menu" id="header_menu" class="form-control" required>
                                          <option value="">Select Option</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="header_menu_position">Header Menu Position</label>
                                      <input type="number" name="header_menu_position" id="header_menu_position"
                                          class="form-control" placeholder="Menu Position">
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
                              <div class="form-group variation_load">
                                  <label for="variation_type">Variation Type</label>
                                  <select name="variation_type[]" id="variation_type"
                                      class="form-control variation_type" multiple="multiple" style="width: 100%;">
                                      <option value="1">Size</option>
                                      <option value="2">Color</option>
                                      <option value="3">Package Qty</option>
                                      <option value="4">Material Type</option>
                                      <option value="5">Wattage</option>
                                      <option value="6">Number Of Items</option>
                                      <option value="7">Style Name</option>
                                  </select>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="vendor_commission_percentage">Vendor Commission(%)</label>
                                      <input type="number" step="any" name="vendor_commission_percentage"
                                          id="vendor_commission_percentage" class="form-control"
                                          placeholder="Vendor Commission">
                                      <span class="text-danger err_vendor_commission_percentage"></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="is_active">Status</label>
                                      <select name="is_active" id="is_active" class="form-control" required>
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