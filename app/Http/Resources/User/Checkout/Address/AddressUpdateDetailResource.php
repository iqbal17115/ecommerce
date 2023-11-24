<?php

namespace App\Http\Resources\User\Checkout\Address;

use App\Models\Address\Country;
use App\Models\Address\District;
use App\Models\Address\Division;
use App\Models\Address\Upazila;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressUpdateDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'optional_mobile' => $this->optional_mobile,
            'street_address' => $this->street_address,
            'building_name' => $this->building_name,
            'nearest_landmark' => $this->nearest_landmark,
            'type' => $this->type,
            'is_default' => $this->is_default,
            'country_id' => $this->country_id,
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'countries' => $this->getCountries(),
            'divisions' => $this->getDivisions($this->country_id),
            'districts' => $this->getDistricts($this->division_id),
            'upazilas' => $this->getUpazilas($this->district_id),
        ];
        if ($this->country_id) {
            $data['divisions'] = $this->getDivisions($this->country_id);
        }

        // Load districts if division_id is present
        if ($this->division_id) {
            $data['districts'] = $this->getDistricts($this->division_id);
        }

        // Load upazilas if district_id is present
        if ($this->district_id) {
            $data['upazilas'] = $this->getUpazilas($this->district_id);
        }

        return $data;
    }

    protected function getCountries()
    {
        return Country::get();
    }
    protected function getDivisions($country_id)
    {
        // Replace 'Division' with your actual model name for divisions
        return Division::where('country_id', $country_id)->select('id', 'name')->get();
    }

    protected function getDistricts($division_id)
    {
        // Replace 'District' with your actual model name for districts
        return District::where('division_id', $division_id)->select('id', 'name')->get();
    }

    protected function getUpazilas($district_id)
    {
        // Replace 'Upazila' with your actual model name for upazilas
        return Upazila::where('district_id', $district_id)->select('id', 'name')->get();
    }
}
