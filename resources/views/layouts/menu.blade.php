







{{-- Sales Management --}}
<li {!! (Request::is('new_sales') || Request::is('sales_list') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Sales Management</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('new_sales') ? 'active' : '' ) !!}">
            <a href="{{route('sales.new_sales')}}">
                <span class="mm-text ">New Sales</span>
                <span class="menu-icon"><i class="im im-icon-Add"></i></span>

            </a>
        </li>
        <li class="barr4 {!! (Request::is('sales_list') ? 'active' : '' ) !!}">
            <a href="{{route('sales.sales_list')}}">
                <span class="mm-text ">Sales List</span>
                <span class="menu-icon"><i class="im im-icon-Add-Bag"></i></span>
            </a>
        </li>
    </ul>
</li>
{{-- purchas Management --}}
<li {!! (Request::is('new_purchas') || Request::is('purchas_list') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Purchase Management</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('new_purchas') ? 'active' : '' ) !!}">
            <a href="{{route('purchas.new_purchas')}}">
                <span class="mm-text ">New Purchase</span>
                <span class="menu-icon"><i class="im im-icon-Add-Basket"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('purchas_list') ? 'active' : '' ) !!}">
            <a href="{{route('purchas.purchas_list')}}">
                <span class="mm-text ">Purchase List</span>
                <span class="menu-icon"><i class="im im-icon-Add-File"></i></span>
            </a>
        </li>
    </ul>
</li>
{{-- //Inventory Management --}}
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
                <span class="menu-icon"><i class="im im-icon-Bag-Items"></i></span>
            </a>
        </li>



        <li class="barr4 {!! (Request::is('categories*') ? 'active li_active' : '' ) !!}" >
            <a href="{{ route('categories.index') }}">
                <span class="mm-text "> </span> Categories</span>
                <span class="menu-icon"><i class="im im-icon-Aa"></i></span>

            </a>
        </li>

        <li class="barr4 {!! (Request::is('subCategories*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('subCategories.index') }}">
                <span class="mm-text ">Sub Categories</span>
                <span class="menu-icon"><i class="im im-icon-Address-Book2"></i></span>

            </a>
        </li>
        <li class="barr4 {!! (Request::is('brands*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('brands.index') }}">
                <span class="mm-text ">Brands</span>
                <span class="menu-icon"><i class="im im-icon-Brain"></i></span>

            </a>
        </li>
        <li class="barr4 {!! (Request::is('units*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('units.index') }}">
                <span class="mm-text ">Units</span>
                <span class="menu-icon"><i class="im im-icon-Address-Book"></i></span>

            </a>
        </li>
    </ul>
</li>
{{-- Settings --}}

{{-- Account --}}
<li {!! (Request::is('pettyCashes*') || Request::is('advancedCashes*')|| Request::is('salary*') || Request::is('logisticBills*') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Account</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('pettyCashes*') ? 'active' : '' ) !!}">
            <a href="{{ route('pettyCashes.index') }}">
                <span class="mm-text ">Petty Cash</span>
                <span class="menu-icon"><i class="im im-icon-Calculator"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('advancedCashes*') ? 'active' : '' ) !!}">
            <a href="{{ route('advancedCashes.index') }}">
                <span class="mm-text ">Advanced Cashes</span>
                <span class="menu-icon"><i class="im im-icon-Money"></i></span>
            </a>
        </li>

        <li class="barr4 {!! (Request::is('logisticBills*') ? 'active' : '' ) !!}">
            <a href="{{ route('logisticBills.index') }}">
                <span class="mm-text ">Logistic Bills</span>
                <span class="menu-icon"><i class="im im-icon-Cable-Car"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('salary*') ? 'active' : '' ) !!}">
            <a href="{{ route('salary') }}">
                <span class="mm-text ">Salary</span>
                <span class="menu-icon"><i class="im im-icon-Money-2"></i></span>
            </a>
        </li>
    </ul>
</li>

{{-- uSER mANAMENT --}}
<li {!! (Request::is('users*') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Users Management</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('users*') ? 'active' : '' ) !!}">
            <a href="{{ route('users.index') }}">
                <span class="mm-text ">Users</span>
                <span class="menu-icon"><i class="im im-icon-Man"></i></span>
            </a>
        </li>
    </ul>
</li>
{{-- HRM --}}
<li {!! (Request::is('attendences*') ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">HRM</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('attendences*') ? 'active' : '' ) !!}">
            <a href="{{ route('attendences.index') }}">
                <span class="mm-text ">Attendences</span>
                <span class="menu-icon"><i class="im im-icon-Calendar"></i></span>
            </a>
        </li>
    </ul>
</li>


<li {!! (Request::is('siteSettings*')|| Request::is('termAndConditions*') || Request::is('companies*') || Request::is('locations*') || Request::is('accountLedgers*') || Request::is('customers*') || Request::is('suppliers*') || Request::is('paymentMethods*')  ? 'class="menu-dropdown mm-active active"': "class='menu-dropdown'" ) !!}>
    <a href="#"  class="barr2">
        <span class="mm-text ">Settings</span>
        <span class="menu-icon "><i class="align-self-center fa-1x fas fa-diagnoses"></i></span>
        <span class="im im-icon-Arrow-Right imicon"></span>
    </a>
    <ul class="sub-menu list-unstyled barr3">
        <li class="barr4 {!! (Request::is('siteSettings*') ? 'active li_active' : '' ) !!}">
            <a href="{{ route('siteSettings.index') }}">
                <span class="mm-text ">Site Settings</span>
                <span class="menu-icon"><i class="im im-icon-Settings-Window"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('customers*') ? 'active' : '' ) !!}">
            <a href="{{ route('customers.index') }}">
                <span class="mm-text ">Customers</span>
                <span class="menu-icon"><i class="im im-icon-Man-Sign"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('suppliers*') ? 'active' : '' ) !!}">
            <a href="{{ route('suppliers.index') }}">
                <span class="mm-text ">Suppliers</span>
                <span class="menu-icon"><i class="im im-icon-Man-Sign"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('paymentMethods*') ? 'active' : '' ) !!}">
            <a href="{{ route('paymentMethods.index') }}">
                <span class="mm-text ">Payment Methods</span>
                <span class="menu-icon"><i class="im im-icon-Paypal"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('accountLedgers*') ? 'active' : '' ) !!}">
            <a href="{{ route('accountLedgers.index') }}">
                <span class="mm-text ">Account Ledgers</span>
                <span class="menu-icon"><i class="im im-icon-Teacher"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('locations*') ? 'active' : '' ) !!}">
            <a href="{{ route('locations.index') }}">
                <span class="mm-text ">Locations</span>
                <span class="menu-icon"><i class="im im-icon-Map"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('companies*') ? 'active' : '' ) !!}">
            <a href="{{ route('companies.index') }}">
                <span class="mm-text ">Companies</span>
                <span class="menu-icon"><i class="im im-icon-Factory"></i></span>
            </a>
        </li>
        <li class="barr4 {!! (Request::is('termAndConditions*') ? 'active' : '' ) !!}">
            <a href="{{ route('termAndConditions.index') }}">
                <span class="mm-text ">Term And Conditions</span>
                <span class="menu-icon"><i class="im im-icon-document`"></i></span>
            </a>
        </li>
    </ul>
</li>



















