<li class="text-center h4" style="background-color: brown;">Aladdinne</li>
                <li id="category_content"><a style="font-weight: bold; font-size: 18px; color: black; "><i
                            id="category_back" class="fa fa-arrow-left" style="display: none;"></i> Shop By Department
                        <button id="minimizeSidebar" type="button"
                            style="font-weight: bold; font-size: 28px; color: red;" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></a></li>
                @foreach($sidebarMenuCategories as $sidebarMenuCategory)
                <li style="list-style: none;padding-bottom: 0px;" class="list-group-item"><a style="font-family: inherit;"
                        href="javascript:void(0);" @if($sidebarMenuCategory->SubCategory) class="parent_category"
                        data-id="{{$sidebarMenuCategory->id}}" @endif>{{$sidebarMenuCategory->name}}
                        @if(count($sidebarMenuCategory->SubCategory) > 0)<i class="arrow right float-right"></i> @endif</a></li>
                @endforeach