<div id="menu" role="navigation">
    <div style="text-align: -webkit-center;border-bottom: 2px solid #686868;margin-bottom: 13px;">
        <a href="{{ URL::to('index') }}" class="logo navbar-brand mr-0">
            @php
                $setting = DB::table('sitesettings')->first();
            @endphp
            <h1 class="text-center" style="display: inline;"><img style="height: 60px;"  src="{{Storage::url((!empty($setting))?$setting->logo:'')}}" alt=""></h1>
        </a>
    </div>
    <ul class="navigation list-unstyled" id="demo">
        <li><span class="close-icon d-xl-none d-lg-block"><img src="{{asset('img/images/input-disabled.png')}}"
                    alt="image missing"></span></li>
        <li {!! (Request::is('') ? 'class="active"' : '' ) !!}>
            <a href="{{ URL::to('') }}">
                <span class="mm-text ">Dashboard</span>
                <span class="menu-icon"><i class="im im-icon-Home"></i></span>
            </a>
        </li>
        @include("layouts/menu")
    </ul>
    <!-- / .navigation -->
</div>
