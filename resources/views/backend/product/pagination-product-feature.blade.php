<table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($product_features as $product_feature)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td><a href="{{ route('feature-setting', ['id'=>$product_feature->id]) }}">{{$product_feature->name}}</a></td>
                            <td>{{$product_feature->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form"
                                    data-toggle="modal" data-target="#productFeatureModal" data-id="{{$product_feature->id}}"
                                    data-name="{{$product_feature->name}}" 
                                    data-card_feature="{{$product_feature->card_feature}}" 
                                    data-top_menu="{{$product_feature->top_menu}}" data-position="{{$product_feature->position}}"
                                    data-is_active="{{$product_feature->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_product_feature"
                                    data-id="{{$product_feature->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
               {!! $product_features->links() !!}