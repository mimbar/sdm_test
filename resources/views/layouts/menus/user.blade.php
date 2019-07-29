<div class="navbar navbar-expand-md navbar-light">
    <div class="text-center d-md-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                data-target="#navbar-navigation">
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

            <li class="nav-item">
                <a href="{{ route('soal.read') }}" class="navbar-nav-link">
                    <i class="icon-database mr-2"></i>
                    Manajemen Soal
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('periode.read') }}" class="navbar-nav-link">
                    <i class="icon-calendar3 mr-2"></i>
                    Manajemen Periode
                </a>
            </li>
        </ul>
    </div>
</div>