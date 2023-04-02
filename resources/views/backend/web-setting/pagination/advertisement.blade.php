<table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Page</th>
                            <th scope="col">Ads</th>
                            <th scope="col">After</th>
                            <th scope="col">Position</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($advertisements as $advertisement)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>
                                {{$advertisement->page}}
                            </td>
                            <td>
                                @if($advertisement->ads)
                                <img src="{{ asset('storage/'.$advertisement->ads) }}" class="rounded" style="width: 55px; height: 40px;" />
                                @endif
                            </td>
                            <td>
                                @if($advertisement && $advertisement->ProductFeature)
                                    {{$advertisement->ProductFeature->name}}
                                @endif
                            </td>
                            <td>
                                {{$advertisement->position}}
                            </td>
                            <td>{{$advertisement->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#advertisementModal" 
                                data-id="{{$advertisement->id}}" 
                                data-page="{{$advertisement->page}}" 
                                data-position="{{$advertisement->position}}"
                                data-product_feature_id="{{$advertisement->product_feature_id}}" 
                                data-is_active="{{$advertisement->is_active}}"
                                >
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_advertisement" data-id="{{$advertisement->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $advertisements->links() !!}