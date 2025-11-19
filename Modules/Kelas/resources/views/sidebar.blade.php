@php
$mainMenu = session('mainMenu') == 'kelas' ? true : false;
@endphp

<li class="nav-item {{ $mainMenu ? 'active' : '' }}">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseKelas"
        aria-expanded="{{ $mainMenu ? 'true' : 'false' }}" aria-controls="collapseKelas">
        <i class="fas fa-fw fa-cog"></i>
        <span>Kelas</span>
    </a>
    <div id="collapseKelas" class="collapse {{ $mainMenu ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'index' ? 'active' : '' }}" href="{{ route('kelas.index') }}">Daftar Data</a>
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'create' ? 'active' : '' }}" href="{{ route('kelas.create') }}">Buat Data</a>
        </div>
    </div>
</li>