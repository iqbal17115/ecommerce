<div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <svg class="icon icon-lg">
            <use xlink:href="{{ URL::asset('admin_src/') }}/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
    </button>
   {{-- <a class="header-brand d-md-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
    </a>--}}
    <ul class="header-nav d-none d-md-flex">
        <li class="nav-item">
            @php
                $roles = auth()->user()->roles;
                $selectedRoleId = session('selected_role_id_'.auth()->user()->id)
            @endphp
            @if(count($roles) >  1)
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="roleSelect">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $selectedRoleId == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            @endif
        </li>
    </ul>
    <ul class="header-nav ms-3">
        <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                                         aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md">
                    <img class="avatar-img"
                         src="{{ URL::asset('admin_src/') }}/assets/img/avatars/8.jpg"
                         alt="user@email.com">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <a class="dropdown-item text-primary" href="{{ route('my_profile.index') }}">
                    Profile
                </a>

                <a class="dropdown-item text-primary" href="{{ route('change_password') }}">
                    Change Password
                </a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item text-danger">
                    Log Out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const roleSelect = document.getElementById("roleSelect");

            if (roleSelect) {
                roleSelect.addEventListener("change", function () {
                    const selectedRoleId = roleSelect.value;

                    // Send the selected role ID to the server using AJAX
                    formRequest(
                        '{{ route('roles.set_selected_role') }}',
                        'POST',
                        {
                            "selected_role_id": selectedRoleId
                        }
                    )
                        .done(function (data) {
                            window.location.href = '/group-feeds';
                        })
                        .fail(function (error) {
                            console.log("error", error)
                        });
                });
            }
        });
    </script>
@endpush
