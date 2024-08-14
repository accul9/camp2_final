{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-dropdown title="Add-ons" icon="la la-puzzle-piece">
    <x-backpack::menu-dropdown-header title="Authentication" />
    <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url('user')" />
    <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" />
    <x-backpack::menu-dropdown-item title="Permissions" icon="la la-key" :link="backpack_url('permission')" />
</x-backpack::menu-dropdown>

<x-backpack::menu-item title="Tags" icon="la la-question" :link="backpack_url('tag')" />
<x-backpack::menu-item title="食材分類" icon="la la-question" :link="backpack_url('category')" />

<x-backpack::menu-item title="商品" icon="la la-question" :link="backpack_url('item')" />

<x-backpack::menu-item title="Sets" icon="la la-question" :link="backpack_url('set')" />
<x-backpack::menu-item title="Recipes" icon="la la-question" :link="backpack_url('recipe')" />
<x-backpack::menu-item title="Used items" icon="la la-question" :link="backpack_url('used-items')" />
<x-backpack::menu-item title="Coupons" icon="la la-question" :link="backpack_url('coupons')" />
<x-backpack::menu-item title="Coupon details" icon="la la-question" :link="backpack_url('coupon-details')" />
<x-backpack::menu-item title="Discounts" icon="la la-question" :link="backpack_url('discounts')" />
<x-backpack::menu-item title='Pages' icon='la la-file-o' :link="backpack_url('page')" />