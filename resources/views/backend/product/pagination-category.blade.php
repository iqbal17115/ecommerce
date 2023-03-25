<table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Parent Category</th>
                            <th scope="col">Category Icon</th>
                            <th scope="col">Category Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$category->name}}</td>
                            <td>
                                @if($category->Parent)
                                {{$category->Parent->name}}
                                @endif
                            </td>
                            <td>
                                @if($category->icon)
                                <img src="{{ asset('storage/'.$category->icon) }}" class="rounded"
                                    style="width: 55px; height: 40px;" />
                                @endif
                            </td>
                            <td>
                                @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}" class="rounded"
                                    style="width: 55px; height: 40px;" />
                                @endif
                            </td>
                            <td>{{$category->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form"
                                    data-toggle="modal" data-target="#categoryModal" data-id="{{$category->id}}"
                                    data-name="{{$category->name}}"
                                    data-parent_category_id="{{$category->parent_category_id}}"
                                    data-top_menu="{{$category->top_menu}}" 
                                    data-sidebar_menu="{{$category->sidebar_menu}}"
                                    data-position="{{$category->position}}"
                                    data-sidebar_menu_position="{{$category->sidebar_menu_position}}"
                                    data-icon1="{{$category->icon}}" data-image="{{$category->icon}}"
                                    data-icon1="{{$category->image}}" data-image="{{$category->image}}"
                                    data-icon1="{{$category->variation_type}}" data-variation_type="{{$category->variation_type}}"
                                    data-vendor_commission_percentage="{{$category->vendor_commission_percentage}}"
                                    data-is_active="{{$category->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_category"
                                    data-id="{{$category->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $categories->links() !!}