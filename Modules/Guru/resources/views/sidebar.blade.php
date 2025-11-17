@php
$mainMenu = session('mainMenu') == 'guru' ? true : false;
@endphp

<li class="nav-item {{ $mainMenu ? 'active' : '' }}">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseGuru"
        aria-expanded="{{ $mainMenu ? 'true' : 'false' }}" aria-controls="collapseGuru">
        <i class="fas fa-fw fa-cog"></i>
        <span>Guru</span>
    </a>
    <div id="collapseGuru" class="collapse {{ $mainMenu ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'index' ? 'active' : '' }}" href="{{ route('guru.index') }}">Daftar Data</a>
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'create' ? 'active' : '' }}" href="{{ route('guru.create') }}">Buat Data</a>
        </div>
    </div>
</li>