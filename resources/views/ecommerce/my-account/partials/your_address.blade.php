<div class="tab-pane fade" id="address">
    <h6 class="tab-title">Your Address</h6>
    <!-- Address form fields go here -->
    <div class="row" id="address_content">

    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="userAddressModal" tabindex="-1" role="dialog" aria-labelledby="userAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userAddressModalLabel">Your Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input name="user_id" id="user_id_val" value="{{ $user->id }}" hidden />
                <form id="targeted_form">
                    <div class="modal-body">
                        <input name="row_id" id="row_id" value="" hidden />
                        <input name="user_id" id="user_id" value="{{ $user->id }}" hidden />
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select class="form-control form-control-sm" id="country_id" name="country_id" required>
                                <option> -- Select --</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter mobile number" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="optional_mobile">Optional Mobile</label>
                            <input type="text" class="form-control" id="optional_mobile" name="optional_mobile"
                                placeholder="Enter optional mobile number">
                        </div>

                        <div class="form-group">
                            <label for="division_id">City/Province</label>
                            <select class="form-control form-control-sm" id="division_id" name="division_id" required>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district_id">District/Area</label>
                            <select class="form-control form-control-sm" id="district_id" name="district_id" required>
                                <option> -- Select --</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="street_address">Street Address</label>
                            <input type="text" class="form-control" id="street_address" name="street_address"
                                placeholder="Enter street address" required>
                        </div>

                        <div class="form-group">
                            <label for="building_name">Building Name</label>
                            <input type="text" class="form-control" id="building_name" name="building_name"
                                placeholder="Enter building name" required>
                        </div>

                        <div class="form-group">
                            <label for="nearest_landmark">Nearest Landmark</label>
                            <input type="text" class="form-control" id="nearest_landmark" name="nearest_landmark"
                                placeholder="Enter nearest landmark">
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="home" name="type"
                                            value="home" checked>
                                        <label class="form-check-label ml-2" for="home"> Home</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="office" name="type"
                                        value="office">
                                    <label class="form-check-label ml-2" for="office"> Office</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close_button"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Start Instruction Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Add Delivery Instructions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h3>Property Type</h3>
                            </div>
                            <div class="properties-selector">
                                <input type="radio" id="proprty_house" name="property" class="weekday" />
                                <label for="proprty_house">House</label>
                                <input type="radio" id="proprty_apartment" name="property" class="weekday" />
                                <label for="proprty_apartment">Apartment</label>
                                <input type="radio" id="proprty_business" name="property" class="weekday" />
                                <label for="proprty_business">Business</label>
                                <input type="radio" id="proprty_other" name="property" class="weekday" />
                                <label for="proprty_other">Other</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                <div class="card m-0">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Is this address closed for deliveries on below days?
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($day_of_weeks as $index => $day_of_week)
                                                    <div class="col-md-3 mb-4">
                                                        <div class="weekDays-selector">
                                                            <div class="font-weight-bold">{{ $day_of_week }}</div>
                                                            <input type="radio"
                                                                id="weekday_{{ $index }}_closed"
                                                                name="{{ $index }}"
                                                                class="{{ $index }}" value="closed" />
                                                            <label
                                                                for="weekday_{{ $index }}_closed">Closed</label>
                                                            <input type="radio"
                                                                id="weekday_{{ $index }}_open"
                                                                name="{{ $index }}"
                                                                class="{{ $index }}" value="open" />
                                                            <label for="weekday_{{ $index }}_open">Open</label>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Where should we leave your packages at this address?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="ml-2 form-check-label" for="flexRadioDefault1">
                                                            Front door
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="ml-2 form-check-label" for="flexRadioDefault1">
                                                            Building Receiption
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="ml-2 form-check-label" for="flexRadioDefault1">
                                                            With a security Guard
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="ml-2 form-check-label" for="flexRadioDefault1">
                                                            No preference
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" cols="2" placeholder="For example navigations, Provide Details such as building description, or nearby landmark" style="height: 50px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Instruction Modal --}}
</div>
