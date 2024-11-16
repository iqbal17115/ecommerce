<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
           <img src="{{ asset('du_logo.png') }}" alt="DU Logo" class="logo" style="width: 46px; height: 46px;">

    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('group_feeds.view') }}">
                Groups
            </a>
        </li>

        @can("manage_groups.view")
            <li class="nav-item">
                <a class="nav-link" href="{{ route('manage_groups.view') }}">
                    Manage Groups
                </a>
            </li>
        @endcan



        @canany(["companies.view", "departments.view", "institutes.view", "roles.view", "users.view"])
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    Settings
                </a>
                <ul class="nav-group-items">
                    @can("users.view")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.view') }}">
                                Users
                            </a>
                        </li>
                    @endcan

                    @can("companies.view")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('companies.view') }}">
                                <span class="nav-icon"></span>
                                Company
                            </a>
                        </li>
                    @endcan

                    @can("departments.view")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('departments.view') }}">
                                Department
                            </a>
                        </li>
                    @endcan

                    @can("institutes.view")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('institutes.view') }}">
                                Institute
                            </a>
                        </li>
                    @endcan

                    @can("roles.view")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('roles.view') }}">
                                Roles
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
