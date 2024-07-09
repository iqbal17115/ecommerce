      <!-- sample modal content -->
      <div id="attributeValueModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myAttributeValueLabel"
          aria-hidden="true">
          <form action="" method="post" id="addAttributeValue" enctype="multipart/form-data">
              @csrf
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title mt-0" id="myAttributeValueLabel">Attribute Value</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="cu_id" id="cu_id" value="-1">
                          <div class="row">
                              <div class="col-md-12">
                                  <label for="attribute_id">Select Attribute</label>
                                  <select class="form-select attribute_id" name="attribute_id" id="attribute_id"
                                      style="width: 100%;">
                                      <option value="">Select Option</option>
                                      @foreach ($attributes as $attribute)
                                          <option value="{{ $attribute->id }}">
                                              {{ $attribute->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="value">Attribute Value</label>
                                      <input type="text" name="value" id="value" class="form-control"
                                          placeholder="Enter Attribute Value">
                                      <span class="text-danger err_value"></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <span style="width: 200px;"></span>
                          <button type="button" class="btn btn-secondary waves-effect"
                              data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </form>
      </div><!-- /.modal -->
