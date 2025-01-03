<ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist" style="border-bottom: 2px solid #FFE3CD;">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('board_customer.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('board_customer.index') }}" 
           role="tab" 
           style="color: #803B03;">Ban chấp hành</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('business_customer.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('business_customer.index') }}" 
           role="tab" 
           style="color: #803B03;">Khách hàng doanh nghiệp</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('individual_customer.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('individual_customer.index') }}" 
           role="tab" 
           style="color: #803B03;">Khách hàng cá nhân</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('business_partner.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('business_partner.index') }}" 
           role="tab" 
           style="color: #803B03;">Đối tác doanh nghiệp</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('individual_partner.index') ? 'active' : '' }}" 
           id="industry-tab" 
           href="{{ route('individual_partner.index') }}" 
           role="tab" 
           style="color: #803B03;">Đối tác cá nhân</a>
    </li>
</ul>