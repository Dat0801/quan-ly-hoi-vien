<ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist" style="border-bottom: 2px solid #FFE3CD;">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('industry.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('industry.index') }}" 
           role="tab" 
           style="color: #803B03;">Ngành</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('field.index') ? 'active' : '' }}" 
           id="fields-tab" 
           href="{{ route('field.index') }}" 
           role="tab" 
           style="color: #803B03;">Lĩnh vực</a>
    </li>
</ul>