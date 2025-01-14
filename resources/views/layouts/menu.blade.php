







<li {!! (Request::is('categories*')|| Request::is('items*') || Request::is('subCategories*') || Request::is('brands*') || Request::is('units*') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Inventory Management</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('items*') ? 'active' : '' ) !!}">
            <a href="{{ route('items.index') }}">
                <span class="mm-text ">Items</span>
            </a>
        </li>



        <li class="barr4 {!! (Request::is('categories*') ? 'active li_active' : '' ) !!}" >
            <a href="{{ route('categories.index') }}">
                <span class="mm-text "> </span> Categories</span>
            </a>
        </li>

        <li class="barr4 {!! (Request::is('subCategories*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('subCategories.index') }}">
                <span class="mm-text ">Sub Categories</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('brands*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('brands.index') }}">
                <span class="mm-text ">Brands</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('units*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('units.index') }}">
                <span class="mm-text ">Units</span>
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('pettyCashes*') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Account</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('pettyCashes*') ? 'active' : '' ) !!}">
            <a href="{{ route('pettyCashes.index') }}">
                <span class="mm-text ">Petty Cash</span>
            </a>
        </li>
    </ul>
</li>


<li class='menu-dropdown'>
    <a href="#"  class="barr2">
        <span class="mm-text ">Sales Management</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4">
            <a href="#">
                <span class="mm-text ">New Sales</span>
            </a>
        </li>
    </ul>
</li>
<li class='menu-dropdown'>
    <a href="#"  class="barr2">
        <span class="mm-text ">Purchase Management</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4">
            <a href="#">
                <span class="mm-text ">New Purchase</span>
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('siteSettings*')|| Request::is('companies*') || Request::is('locations*') || Request::is('accountLedgers*') || Request::is('customers*') || Request::is('suppliers*') || Request::is('paymentMethods*')  ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Settings</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('siteSettings*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('siteSettings.index') }}">
                <span class="mm-text ">Site Settings</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('customers*') ? 'active' : '' ) !!}">
            <a href="{{ route('customers.index') }}">
                <span class="mm-text ">Customers</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('suppliers*') ? 'active' : '' ) !!}">
            <a href="{{ route('suppliers.index') }}">
                <span class="mm-text ">Suppliers</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('paymentMethods*') ? 'active' : '' ) !!}">
            <a href="{{ route('paymentMethods.index') }}">
                <span class="mm-text ">Payment Methods</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('accountLedgers*') ? 'active' : '' ) !!}">
            <a href="{{ route('accountLedgers.index') }}">
                <span class="mm-text ">Account Ledgers</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('locations*') ? 'active' : '' ) !!}">
            <a href="{{ route('locations.index') }}">
                <span class="mm-text ">Locations</span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('companies*') ? 'active' : '' ) !!}">
            <a href="{{ route('companies.index') }}">
                <span class="mm-text ">Companies</span>
            </a>
        </li>
    </ul>
</li>













