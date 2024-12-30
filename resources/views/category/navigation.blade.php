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
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('market.index') ? 'active' : '' }}" 
           id="market-tab" 
           href="{{ route('market.index') }}" 
           role="tab" 
           style="color: #803B03;">Thị trường</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('target_customer_group.index') ? 'active' : '' }}" 
           id="market-tab" 
           href="{{ route('target_customer_group.index') }}" 
           role="tab" 
           style="color: #803B03;">Khách hàng mục tiêu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('certificate.index') ? 'active' : '' }}" 
           id="market-tab" 
           href="{{ route('certificate.index') }}" 
           role="tab" 
           style="color: #803B03;">Chứng chỉ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('organization.index') ? 'active' : '' }}" 
           id="market-tab" 
           href="{{ route('organization.index') }}" 
           role="tab" 
           style="color: #803B03;">Tổ chức</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('business.index') ? 'active' : '' }}" 
           id="market-tab" 
           href="{{ route('business.index') }}" 
           role="tab" 
           style="color: #803B03;">Doanh nghiệp</a>
    </li>
</ul>