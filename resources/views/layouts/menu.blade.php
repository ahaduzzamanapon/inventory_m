







<li {!! (Request::is('categories*') || Request::is('subCategories*') || Request::is('brands*') || Request::is('units*') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  style="background: rgb(255, 255, 255);border-radius: 10px;overflow: hidden;">
        <span class="mm-text ">Item Management</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled" style="margin-left: 24px;background: rgb(255, 255, 255);overflow: hidden;border-radius: 0px 0px 14px 14px;">
        <li class="{!! (Request::is('categories*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('categories.index') }}">
                <span class="mm-text "> </span> Categories</span>
            </a>
        </li>
        <li class="{!! (Request::is('subCategories*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('subCategories.index') }}">
                <span class="mm-text ">Sub Categories</span>
            </a>
        </li>
        <li class="{!! (Request::is('brands*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('brands.index') }}">
                <span class="mm-text ">Brands</span>
            </a>
        </li>
        <li class="{!! (Request::is('units*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('units.index') }}">
                <span class="mm-text ">Units</span>
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('pettyCashes*') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  style="background: rgb(255, 255, 255);border-radius: 10px;overflow: hidden;">
        <span class="mm-text ">Account</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled" style="margin-left: 24px;background: rgb(255, 255, 255);overflow: hidden;border-radius: 0px 0px 14px 14px;">
        <li class="{!! (Request::is('pettyCashes*') ? 'active' : '' ) !!}">
            <a href="{{ route('pettyCashes.index') }}">
                <span class="mm-text ">Petty Cash</span>
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('siteSettings*') || Request::is('locations*') || Request::is('accountLedgers*') || Request::is('customers*') || Request::is('suppliers*') || Request::is('paymentMethods*')  ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  style="background: rgb(255, 255, 255);border-radius: 10px;overflow: hidden;">
        <span class="mm-text ">Settings</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled" style="margin-left: 24px;background: rgb(255, 255, 255);overflow: hidden;border-radius: 0px 0px 14px 14px;">
        <li class="{!! (Request::is('siteSettings*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('siteSettings.index') }}">
                <span class="mm-text ">Site Settings</span>
            </a>
        </li>
        <li class="{!! (Request::is('customers*') ? 'active' : '' ) !!}">
            <a href="{{ route('customers.index') }}">
                <span class="mm-text ">Customers</span>
            </a>
        </li>
        <li class="{!! (Request::is('suppliers*') ? 'active' : '' ) !!}">
            <a href="{{ route('suppliers.index') }}">
                <span class="mm-text ">Suppliers</span>
            </a>
        </li>
        <li class="{!! (Request::is('paymentMethods*') ? 'active' : '' ) !!}">
            <a href="{{ route('paymentMethods.index') }}">
                <span class="mm-text ">Payment Methods</span>
            </a>
        </li>
        <li class="{!! (Request::is('accountLedgers*') ? 'active' : '' ) !!}">
            <a href="{{ route('accountLedgers.index') }}">
                <span class="mm-text ">Account Ledgers</span>
            </a>
        </li>
        <li class="{!! (Request::is('locations*') ? 'active' : '' ) !!}">
            <a href="{{ route('locations.index') }}">
                <span class="mm-text ">Locations</span>
            </a>
        </li>
    </ul>
</li>












