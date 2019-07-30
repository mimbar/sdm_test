<div class="navbar navbar-dark bg-success-800 navbar-expand-md">
    <div class="navbar-brand wmin-0 mr-5">
        <a href="index.html" class="d-inline-block">
            <img src="{{ asset('assets/batagor/global_assets/images/logo_light.png') }}" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">


        <span class="badge bg-success-400 ml-3 mr-2">{{ Auth::user()->username }}</span>
        @foreach(\Illuminate\Support\Facades\Auth::user()->roles as $data)
            <span class="badge bg-violet-400 mr-md-auto" data-popup="tooltip" title="{{ session('prodi') }}" data-placement="bottom">{{ $data->name }}</span>
        @endforeach

        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('assets/batagor/global_assets/images/placeholders/placeholder.jpg') }}"
                         class="rounded-circle mr-2" height="34" alt="">
                    <span>{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="" class="dropdown-item"><i class="icon-user-plus"></i> Profil</a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
