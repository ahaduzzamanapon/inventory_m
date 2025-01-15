<div id="menu" role="navigation">
    <style>
        /* Main menu container */
        .barrr {
            background: #f1f1f1;
            display: flex;
            flex-direction: column;
            padding: 20px 15px !important;
            gap: 15px;
            border-radius: 15px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
            height: 80vh;
            overflow-y: auto;
            top: 55px;
            margin: 20px;
            scrollbar-width: thin;
            scroll-behavior: smooth;
            transition: all 0.3s ease;
            width: 280px;
            /* padding: 13px; */
        }
        @media (max-width: 767px) {
            .barrr {
                margin-left: -27px;
            }
        }

        /* Main menu item */
        .barr2 {
            background: #ffffff;
            border-radius: 12px;
            padding: 18px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        /* Hover effect for menu items */
        .barr2:hover {
            background-color: #e1f5e1;
            transform: translateX(8px);
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.2);
        }

        .barr2 .menu-icon {
            font-size: 22px;
            color: #38cb87;
            transition: color 0.3s ease;
        }

        .barr2 .mm-text {
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        /* Dropdown arrow icon */
        .imicon {
            font-size: 20px;
            color: #38cb87;
            transition: transform 0.4s ease, color 0.3s ease;
        }

        .menu-dropdown:hover .imicon {
            transform: rotate(90deg);
            color: #2d9c6a;
        }

        /* Sub-menu items */
        .barr3 {
            background: #ffffff;
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-left: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            width: 97%;
        }

        /* Expand dropdown on hover */
        .menu-dropdown.mm-active .barr3 {
            max-height: 500px;
            opacity: 1;
        }

        /* Sub-menu item styling */
        .barr4 {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #ddd;
            padding: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .barr4:hover {
            background-color: #e9f9f1;
            transform: scale(1.05);
        }

        /* Active state styling */
        .barr4.active {
            background-color: #e9f9f1;
            color: white;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .barr4.active a {
            color: #000000!important;
            font-weight: bolder;
        }

        .barr4 a {
            text-decoration: none;
            font-size: 15px;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .barr4 a:hover {
            color: #38cb87;
            transform: translateX(4px);
        }

        /* Close icon styling */
        .close-icon img {
            width: 22px;
            height: 22px;
            opacity: 0.8;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .close-icon img:hover {
            opacity: 1;
            transform: scale(1.2);
        }

        /* Icon animations */
        .menu-icon, .imicon, .close-icon img {
            transition: transform 0.3s ease, color 0.3s ease, opacity 0.3s ease;
        }
        .barrr_res {
            margin-left: 301px!important;
        }
        @media (min-width: 767px) {
            .barrr_res {
            margin-left: 0!important
        }
        }
    </style>

    <ul class="navigation list-unstyled barrr" id="demo">
        <!-- Dashboard menu item -->
        <li {!! Request::is('/*') ? 'class="active"' : '' !!}>
            <a href="{{ URL::to('') }}" class="barr2">
                <span class="mm-text">Dashboard</span>
                <span class="menu-icon"><i class="im im-icon-Home"></i></span>
            </a>
        </li>

        @include('layouts/menu')

    </ul>
</div>
