<div id="menu" role="navigation">
    
    <style>
.barrr {
    background: rgb(255, 255, 255);
    display: flex;
    border-radius: 10px;
    box-shadow: rgb(221, 221, 221) 0px 0px 4px 2px;
    height: 82vh !important;
    flex-direction: column;
    padding: 24px 6px !important;
    gap: 10px;
    scrollbar-width: none;
    overflow-y: scroll !important;
    top: 55px;
    margin: 5px;
}
    .barr2 {
        background: rgb(255, 255, 255);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 0px 4px 2px #dddddd;
        margin: auto 4px;
        padding: 14px 7px 4px 9px !important;
    }
    .barr3 {
        background: rgb(255, 255, 255)!important;
    }
    .barr4 {
        margin-left: 24px;
        background: rgb(255, 255, 255)!important;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0px 0px 4px 2px #dddddd;
        margin-top: 5px;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }
    </style>
    <ul class="navigation list-unstyled barrr" id="demo">
        <li><span class="close-icon d-xl-none d-lg-block"><img src="{{asset('img/images/input-disabled.png')}}"
                    alt="image missing"></span></li>
        <li {!! (Request::is('/*') ? 'class="active"' : '' ) !!}>
            <a href="{{ URL::to('') }}" class="barr2">
                <span class="mm-text ">Dashboard</span>
                <span class="menu-icon"><i class="im im-icon-Home"></i></span>
            </a>
        </li>
        @include("layouts/menu")
    </ul>
    <!-- / .navigation -->
</div>
