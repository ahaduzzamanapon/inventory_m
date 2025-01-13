<li class="{!! (Request::is('categories*') ? 'active' : '' ) !!}">
    <a href="{{ route('categories.index') }}">
        <span class="mm-text ">Categories</span>
        <span class="menu-icon"><i class="im im-icon-Structure"></i></span>
    </a>
</li>

<li class="{!! (Request::is('subCategories*') ? 'active' : '' ) !!}">
    <a href="{{ route('subCategories.index') }}">
        <span class="mm-text ">Sub Categories</span>
        <span class="menu-icon"><i class="im im-icon-Structure"></i></span>
    </a>
</li>

