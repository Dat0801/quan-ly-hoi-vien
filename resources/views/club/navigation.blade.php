<ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist" style="border-bottom: 2px solid #FFE3CD;">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('club.business_customer.index') ? 'active' : '' }}" 
           href="{{ route('club.business_customer.index', $club->id) }}" 
           role="tab" 
           style="color: #803B03;">Khách hàng doanh nghiệp</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('club.individual_customer.index') ? 'active' : '' }}" 
           href="{{ route('club.individual_customer.index', $club->id) }}" 
           role="tab" 
           style="color: #803B03;">Khách hàng cá nhân</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('club.business_partner.index') ? 'active' : '' }}" 
           href="{{ route('club.business_partner.index', $club->id) }}" 
           role="tab" 
           style="color: #803B03;">Đối tác doanh nghiệp</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('club.individual_partner.index') ? 'active' : '' }}" 
           href="{{ route('club.individual_partner.index', $club->id) }}" 
           role="tab" 
           style="color: #803B03;">Đối tác cá nhân</a>
    </li>
</ul>