@php
$mainMenu = session('mainMenu') == 'tahun-ajaran' ? true : false;
@endphp

<li class="nav-item {{ $mainMenu ? 'active' : '' }}">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTahunAjaran"
        aria-expanded="{{ $mainMenu ? 'true' : 'false' }}" aria-controls="collapseTahunAjaran">
        <i class="fas fa-fw fa-cog"></i>
        <span>Tahun Ajaran</span>
    </a>
    <div id="collapseTahunAjaran" class="collapse {{ $mainMenu ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'index' ? 'active' : '' }}" href="{{ route('tahun-ajaran.index') }}">Daftar Data</a>
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'create' ? 'active' : '' }}" href="{{ route('tahun-ajaran.create') }}">Buat Data</a>
        </div>
    </div>
</li>