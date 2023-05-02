@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Feature Setting List</span>
            </div>
            <div class="col-md-12 feature_setting_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Feature</th>
                            <th scope="col">Offer</th>
                            <th scope="col">Coupon</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($feature_settings as $feature_setting)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>
                                @if($feature_setting->ProductFeature)
                                {{$feature_setting->ProductFeature->name}}
                                @endif
                            </td>
                            <td>{{$feature_setting->apply_for_offer == 1? 'Yes' : 'No'}}</td>
                            <td>{{$feature_setting->apply_for_coupon == 1? 'Yes' : 'No'}}</td>
                            <td>
                                <a class="btn btn-info text-light btn-sm" href="{{ route('feature-setting', ['id'=>$feature_setting->id]) }}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>


@endsection
@section('script')

@include('backend.web-setting.js.feature-setting-js')

@endsection