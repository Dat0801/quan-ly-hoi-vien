<ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist" style="border-bottom: 2px solid #FFE3CD;">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('role.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('role.index') }}" 
           role="tab" 
           style="color: #803B03;">Quản lý vai trò</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('account.index') ? 'active' : '' }}" 
           id="fields-tab" 
           href="{{ route('account.index') }}" 
           role="tab" 
           style="color: #803B03;">Tài khoản quản trị</a>
    </li>
</ul>