<div class="tab-pane" id="compliance" role="tabpanel">
    <!-- Start -->
    <div class="col-md-10">
        <!-- Start Content -->
        <form method="post" id="add_product_compliance">
            @csrf
            <div class="row">
                <input type="hidden" name="product_compliance_id" id="product_compliance_id"
                    @if($productInfo) value="{{$productInfo->id}}" @else value="-1"
                    @endif />
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Battery Cell Type</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <select name="battery_cell_type" id="battery_cell_type"
                        class="form-select">
                        <option value="">Select Option</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Polymer
                            Lithium Ion') selected @endif value="Polymer Lithium
                            Ion">Polymer Lithium Ion</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Ion') selected @endif value="Lithium Ion">Lithium Ion</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Alkaline')
                            selected @endif value="Alkaline">Alkaline</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Manganese Dioxide') selected @endif value="Lithium Manganese
                            Dioxide">Lithium Manganese Dioxide</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Manganese')
                            selected @endif value="Manganese">Manganese</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Sealed Lead
                            Acid') selected @endif value="Sealed Lead Acid">Sealed Lead Acid
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Polymer') selected @endif value="Lithium Polymer">Lithium
                            Polymer</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Nicad')
                            selected @endif value="Nicad">Nicad</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Metal') selected @endif value="Lithium Metal">Lithium Metal
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Nimh')
                            selected @endif value="Nimh">Nimh</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lead
                            Calcium') selected @endif value="Lead Calcium">Lead Calcium
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Aluminium
                            Oxygen') selected @endif value="Aluminium Oxygen">Aluminium
                            Oxygen</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Zinc')
                            selected @endif value="Zinc">Zinc</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lead Acid')
                            selected @endif value="Lead Acid">Lead Acid</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Silver
                            Zinc') selected @endif value="Silver Zinc">Silver Zinc</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Zinc
                            Chloride') selected @endif value="Zinc Chloride">Zinc Chloride
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Cobalt') selected @endif value="Lithium Cobalt">Lithium Cobalt
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Phosphate') selected @endif value="Lithium Phosphate">Lithium
                            Phosphate</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lead Acid
                            Agm') selected @endif value="Lead Acid Agm">Lead Acid Agm
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Thionyl Chloride') selected @endif value="Lithium Thionyl
                            Chloride">Lithium Thionyl Chloride</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium')
                            selected @endif value="Lithium">Lithium</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Nickel Cobalt Aluminum') selected @endif value="Lithium Nickel
                            Cobalt Aluminum">Lithium Nickel Cobalt Aluminum</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Nickel Manganese Cobalt') selected @endif value="Lithium Nickel
                            Manganese Cobalt">Lithium Nickel Manganese Cobalt</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Mercury
                            Oxide') selected @endif value="Mercury Oxide">Mercury Oxide
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Nickel
                            Iron') selected @endif value="Nickel Iron">Nickel Iron</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Air') selected @endif value="Lithium Air">Lithium Air</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Nickel
                            Oxyhydroxide') selected @endif value="Nickel
                            Oxyhydroxide">Nickel Oxyhydroxide</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Zinc
                            Carbon') selected @endif value="Zinc Carbon">Zinc Carbon
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Nickel
                            Zinc') selected @endif value="Nickel Zinc">Nickel Zinc</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Lithium
                            Titanate') selected @endif value="Lithium Titanate">Lithium
                            Titanate</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Silver
                            Calcium') selected @endif value="Silver Calcium">Silver Calcium
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_cell_type=='Zinc Air')
                            selected @endif value="Zinc Air">Zinc Air</option>
                    </select>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Battery Type</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <select name="battery_type" id="battery_type" class="form-select">
                        <option value="">Select Option</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Aa') selected
                            @endif value="Aa">Aa</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Aaa') selected
                            @endif value="Aaa">Aaa</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Lithium Ion')
                            selected @endif value="Lithium Ion">Lithium Ion</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='A') selected
                            @endif value="A">A</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Cr2') selected
                            @endif value="Cr2">Cr2</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='C') selected
                            @endif value="C">C</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='D') selected
                            @endif value="D">D</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Cr5') selected
                            @endif value="Cr5">Cr5</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Aaaa') selected
                            @endif value="Aaaa">Aaaa</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='P76') selected
                            @endif value="P76">P76</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Product
                            Specific') selected @endif value="Product Specific">Product
                            Specific</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Lithium Metal')
                            selected @endif value="Lithium Metal">Lithium Metal</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='Cr123A')
                            selected @endif value="Cr123A">Cr123A</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='12V') selected
                            @endif value="12V">12V</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='9V') selected
                            @endif value="9V">9V</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='CR2032')
                            selected @endif value="CR2032">CR2032</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_type=='CR2430')
                            selected @endif value="CR2430">CR2430</option>
                    </select>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Number
                        of Batteries Required</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <input name="number_of_battery_require" id="number_of_battery_require"
                        @if($productInfo && $productInfo->ProductCompliance)
                    value="{{$productInfo->ProductCompliance->number_of_battery_require}}"
                    @endif class="form-control" placeholder="Number of Batteries Required"
                    />
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Lithium Battery Energy Content</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input name="lithium_battery_energy_content"
                                id="lithium_battery_energy_content" @if($productInfo &&
                                $productInfo->ProductCompliance)
                            value="{{$productInfo->ProductCompliance->lithium_battery_energy_content}}"
                            @endif class="form-control" placeholder="1, 2, 3" />
                        </div>
                        <div class="col-md-6">
                            <select name="lithium_battery_energy_content_unit"
                                id="lithium_battery_energy_content_unit"
                                class="form-select">
                                <option value="">Select Option</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Kilowatt
                                    Hours') selected @endif value="Kilowatt Hours">Kilowatt
                                    Hours</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Joules')
                                    selected @endif value="Joules">Joules</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Cubic
                                    Feet') selected @endif value="Cubic Feet">Cubic Feet
                                </option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Watt
                                    Hours') selected @endif value="Watt Hours">Watt Hours
                                </option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Milliampere
                                    Hour (mAh)') selected @endif value="Milliampere Hour
                                    (mAh)">Milliampere Hour (mAh)</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Cubic
                                    Meters') selected @endif value="Cubic Meters">Cubic
                                    Meters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Milliamp
                                    Hours (mAh)') selected @endif value="Milliamp Hours
                                    (mAh)">Milliamp Hours (mAh)</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='Milliampere
                                    Second (mAs)') selected @endif value="Milliampere Second
                                    (mAs)">Milliampere Second (mAs)</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_energy_content_unit=='British
                                    Thermal Units (BTUs)') selected @endif value="British
                                    Thermal Units (BTUs)">British Thermal Units (BTUs)
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Lithium Battery Packaging</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <select name="lithium_battery_packaging" id="lithium_battery_packaging"
                        class="form-select">
                        <option value="">Select Option</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->lithium_battery_packaging==1)
                            selected @endif value="1">Batteries Packed With Equipment
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->lithium_battery_packaging==2)
                            selected @endif value="2">Batteries Contained In Equipment
                        </option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->lithium_battery_packaging==3)
                            selected @endif value="3">Batteries Only</option>
                    </select>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Batteries are Included</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <select name="battery_include" id="battery_include" class="form-select">
                        <option value="">Select Option</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_include==1) selected
                            @endif value="1">Yes</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_include==0) selected
                            @endif value="0">No</option>
                    </select>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Are
                        Batteries Required</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <select name="battery_require" id="battery_require" class="form-select">
                        <option value="">Select Option</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_include==1) selected
                            @endif value="1">Yes</option>
                        <option @if($productInfo && $productInfo->ProductCompliance &&
                            $productInfo->ProductCompliance->battery_include==0) selected
                            @endif value="0">No</option>
                    </select>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Battery Weight</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input name="battery_weight" id="battery_weight"
                                @if($productInfo && $productInfo->ProductCompliance)
                            value="{{$productInfo->ProductCompliance->battery_weight}}"
                            @endif class="form-control" placeholder="150" />
                        </div>
                        <div class="col-md-6">
                            <select name="battery_weight_unit" id="battery_weight_unit"
                                class="form-select">
                                <option value="">Select Option</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->battery_weight_unit=="Pounds")
                                    selected @endif value="Pounds">Pounds</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->battery_weight_unit=="Kilograms")
                                    selected @endif value="Kilograms">Kilograms</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->battery_weight_unit=="Grams")
                                    selected @endif value="Grams">Grams</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->battery_weight_unit=="Hundredths")
                                    selected @endif value="Hundredths Pounds">Hundredths
                                    Pounds</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->battery_weight_unit=="Milligrams")
                                    selected @endif value="Milligrams">Milligrams</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->battery_weight_unit=="Tons")
                                    selected @endif value="Tons">Tons</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->battery_weight_unit=="Ounces")
                                    selected @endif value="Ounces">Ounces</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Number
                        of Lithium Metal Cells</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <input name="number_of_lithium_metal_cell"
                        id="number_of_lithium_metal_cell" @if($productInfo &&
                        $productInfo->ProductCompliance)
                    value="{{$productInfo->ProductCompliance->number_of_lithium_metal_cell}}"
                    @endif class="form-control" placeholder="1, 2, 3" />
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Number
                        of Lithium-ion Cells</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <input name="number_of_lithium_ion_cell" id="number_of_lithium_ion_cell"
                        @if($productInfo && $productInfo->ProductCompliance)
                    value="{{$productInfo->ProductCompliance->number_of_lithium_ion_cell}}"
                    @endif class="form-control" placeholder="1, 2, 3" />
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Lithium Battery Weight</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input name="lithium_battery_weight" id="lithium_battery_weight"
                                @if($productInfo && $productInfo->ProductCompliance)
                            value="{{$productInfo->ProductCompliance->lithium_battery_weight}}"
                            @endif class="form-control" placeholder="0.9" />
                        </div>
                        <div class="col-md-6">
                            <select name="lithium_battery_weight_unit"
                                id="lithium_battery_weight_unit" class="form-select">
                                <option value="">Select Option</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_weight_unit=="Pounds")
                                    selected @endif value="Pounds">Pounds</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_weight_unit=="Kilograms")
                                    selected @endif value="Kilograms">Kilograms</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_weight_unit=="Grams")
                                    selected @endif value="Grams">Grams</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_weight_unit=="Hundredths")
                                    selected @endif value="Hundredths Pounds">Hundredths
                                    Pounds</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_weight_unit=="Milligrams")
                                    selected @endif value="Milligrams">Milligrams</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_weight_unit=="Tons")
                                    selected @endif value="Tons">Tons</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->lithium_battery_weight_unit=="Ounces")
                                    selected @endif value="Ounces">Ounces</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Hazmat
                        United Nations Regulatory Id</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <input name="regulatory_id" id="regulatory_id" @if($productInfo &&
                        $productInfo->ProductCompliance)
                    value="{{$productInfo->ProductCompliance->regulatory_id}}" @endif
                    class="form-control" placeholder="UN1950" />
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Safety
                        Data Sheet URL</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <input name="safety_data_sheet_url" id="safety_data_sheet_url"
                        @if($productInfo && $productInfo->ProductCompliance)
                    value="{{$productInfo->ProductCompliance->safety_data_sheet_url}}"
                    @endif class="form-control" placeholder="https://www.facebook.com/" />
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Volume</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input name="volume" id="volume" @if($productInfo &&
                                $productInfo->ProductCompliance)
                            value="{{$productInfo->ProductCompliance->volume}}" @endif
                            class="form-control" placeholder="34.78" />
                        </div>
                        <div class="col-md-6">
                            <select name="volume_unit" id="volume_unit" class="form-select">
                                <option value="">Select Option</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    && $productInfo->ProductCompliance->volume_unit=="Cups")
                                    selected @endif value="Cups">Cups</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Microliters")
                                    selected @endif value="Microliters">Microliters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    && $productInfo->ProductCompliance->volume_unit=="Cubic
                                    Feet") selected @endif value="Cubic Feet">Cubic Feet
                                </option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Centiliters")
                                    selected @endif value="Centiliters">Centiliters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Gallons")
                                    selected @endif value="Gallons">Gallons</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Quarts")
                                    selected @endif value="Quarts">Quarts</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Nanoliters")
                                    selected @endif value="Nanoliters">Nanoliters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Liters")
                                    selected @endif value="Liters">Liters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Picoliters")
                                    selected @endif value="Picoliters">Picoliters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    && $productInfo->ProductCompliance->volume_unit=="Fluid
                                    Ounces") selected @endif value="Fluid Ounces">Fluid
                                    Ounces</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    && $productInfo->ProductCompliance->volume_unit=="Cubic
                                    Meters") selected @endif value="Cubic Meters">Cubic
                                    Meters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Pints")
                                    selected @endif value="Pints">Pints</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    && $productInfo->ProductCompliance->volume_unit=="Cubic
                                    Yards") selected @endif value="Cubic Yards">Cubic Yards
                                </option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    && $productInfo->ProductCompliance->volume_unit=="Cubic
                                    Inches") selected @endif value="Cubic Inches">Cubic
                                    Inches</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Imperial
                                    Gallons") selected @endif value="Imperial
                                    Gallons">Imperial Gallons</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Milliliters")
                                    selected @endif value="Milliliters">Milliliters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    && $productInfo->ProductCompliance->volume_unit=="Cubic
                                    Centimeters") selected @endif value="Cubic
                                    Centimeters">Cubic Centimeters</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->volume_unit=="Deciliters")
                                    selected @endif value="Deciliters">Deciliters</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Flash
                        Point</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <input name="flash_point" id="flash_point" @if($productInfo &&
                        $productInfo->ProductCompliance)
                    value="{{$productInfo->ProductCompliance->flash_point}}" @endif
                    class="form-control" placeholder="180" />
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Item
                        Weight</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input name="item_weight" id="item_weight" @if($productInfo &&
                                $productInfo->ProductCompliance)
                            value="{{$productInfo->ProductCompliance->item_weight}}" @endif
                            class="form-control" placeholder="2.33, 20.75, 10000.00" />
                        </div>
                        <div class="col-md-6">
                            <select name="item_weight_unit" id="item_weight_unit"
                                class="form-select">
                                <option value="">Select Option</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->item_weight_unit=="Pounds")
                                    selected @endif value="Pounds">Pounds</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->item_weight_unit=="Kilograms")
                                    selected @endif value="Kilograms">Kilograms</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->item_weight_unit=="Grams")
                                    selected @endif value="Grams">Grams</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->item_weight_unit=="Hundredths")
                                    selected @endif value="Hundredths Pounds">Hundredths
                                    Pounds</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->item_weight_unit=="Milligrams")
                                    selected @endif value="Milligrams">Milligrams</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->item_weight_unit=="Tons")
                                    selected @endif value="Tons">Tons</option>
                                <option @if($productInfo && $productInfo->ProductCompliance
                                    &&
                                    $productInfo->ProductCompliance->item_weight_unit=="Ounces")
                                    selected @endif value="Ounces">Ounces</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">GHS
                        Classification</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <select class="form-select">
                        <option value="">Select Option</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <!-- End -->
                <div class="col-md-4 mt-md-3">
                    <label class="col-form-label float-md-right"
                        style="font-size: 14px;">Applicable Dangerous Goods
                        Regulations</label>
                </div>
                <div class="col-md-8 mt-md-3">
                    <select class="form-select">
                        <option value="">Select Option</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <!-- End -->
                <div class="col-md-12 mt-3 text-right">
                    <button type="submit" class="prev-btn btn-warning float-left">Previous</button>
                    <button type="submit" class="next-btn  btn-success float-right">Next</button>
                </div>
                <!-- End -->
            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
    <!-- End -->
</div>
