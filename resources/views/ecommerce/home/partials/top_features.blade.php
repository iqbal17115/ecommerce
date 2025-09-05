<div class="row" style="margin-top: 18px;">
    <!-- Start Product Part -->
    <!-- Start Product Part -->
    @foreach ($top_features as $top_feature)
    @if ($top_feature->TopFeatureSetting)
    @if ($top_feature->TopFeatureSetting && count($top_feature->TopFeatureSetting->FeatureSettingDetail) >= 2)
    <div class="col-md-3 card">
        <div class="card-body">
            <div class="a-cardui-header">
                <h2 class="a-color-base headline truncate-2line ">
                    {{ $top_feature->name }}
                </h2>
            </div>
            <div class="row">
                @foreach ($top_feature->TopFeatureSetting->FeatureSettingDetail as $feature_setting_detail)
                <div class="col-6 p-0">
                    <a href="{{ route('catalog.show', ['name' => rawurlencode($feature_setting_detail->Category->name)]) }}"
                        style="text-decoration: none;">
                        <div class="card mb-0">
                            <img class="card-img-top lazy-load"
                                data-src="{{ asset('storage/' . $feature_setting_detail->Category->image) }}"
                                style="height: 150px;">
                            <div class="text-center text-dark">
                                <span>{{ $feature_setting_detail->Category->name }}</span>
                            </div>
                        </div>
                    </a>
                    <!-- End Product -->
                </div>
                @endforeach
            </div>
            <!-- End Feature -->
        </div>
    </div>
    @endif
    <!-- Start Ads -->
    @if (
    $top_feature->TopFeatureSetting->ProductFeature->Advertisement &&
    count($top_feature->TopFeatureSetting->ProductFeature->Advertisement) > 0)
    <div class="col-md-3 card">
        <div class="card-body">
            <div class="row">
                @foreach ($top_feature->TopFeatureSetting->ProductFeature->Advertisement as $advertisement)
                <div class="col-12 p-0">
                    <div class="card mb-0">
                        <img class="card-img-top lazy-load"
                            data-src="{{ asset('storage/' . $advertisement->ads) }}">
                    </div>
                    <!-- End Product -->
                </div>
                @endforeach
            </div>
            <!-- End Feature -->
        </div>
    </div>
    @endif
    <!-- End Ads -->
    @endif
    @endforeach
</div>