<ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist" style="border-bottom: 2px solid #FFE3CD;">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('club.board_customer.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('club.board_customer.index', $club->id) }}" 
           role="tab" 
           style="color: #803B03;">Ban chấp hành</a>
    </li>
</ul>