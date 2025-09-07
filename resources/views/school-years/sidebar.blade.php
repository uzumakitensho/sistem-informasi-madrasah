@php
$mainMenu = session('mainMenu') == 'school-years' ? true : false;
@endphp

<li class="nav-item {{ $mainMenu ? 'active' : '' }}">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="{{ $mainMenu ? 'true' : 'false' }}" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>School Years</span>
    </a>
    <div id="collapseTwo" class="collapse {{ $mainMenu ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'index' ? 'active' : '' }}" href="{{ route('school-years.index') }}">List</a>
            <a class="collapse-item {{ $mainMenu && session('subMenu') == 'create' ? 'active' : '' }}" href="{{ route('school-years.create') }}">Create</a>
        </div>
    </div>
</li>