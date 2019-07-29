<div class="navbar navbar-expand-md navbar-light">
    <div class="text-center d-md-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
            <i class="icon-unfold mr-2"></i>
            Menu
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-navigation">
        <ul class="navbar-nav navbar-nav-highlight">
            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="navbar-nav-link">
                    <i class="icon-home4 mr-2"></i>
                    Beranda
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-users4 mr-2"></i>
                    User
                </a>

                <div class="dropdown-menu">
                    <a href="{{ route('users.index') }}" class="dropdown-item"><i class="icon-user mr-2"></i> User Management</a>
                </div>
            </li>
        </ul>

    </div>
</div>