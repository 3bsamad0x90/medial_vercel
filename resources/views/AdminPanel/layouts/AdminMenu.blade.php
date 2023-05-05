<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <img src="{{getSettingImageLink('logo')}}" width="90%" />
            <!-- <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li> -->
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if(isset($active) && $active == 'panelHome') active @endif nav-item" >
                <a class="d-flex align-items-center" href="{{route('admin.index')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.PanelHome')}}">
                       الرئيسية
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'setting') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.settings.general')}}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.setting')}}">
                        الإعدادات
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'testimonials') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.testimonials')}}">
                    <i data-feather='cpu'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.testimonials')}}">
                        {{trans('common.testimonials')}}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'blogs') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.blogs')}}">
                    <i data-feather='book'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.blog')}}">
                        {{ trans('common.blog') }}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'pages') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.pages')}}">
                    <i data-feather='columns'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.pages')}}">
                        {{trans('common.pages')}}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'contactMessages') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.contactmessages')}}">
                    <i data-feather='mail'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.contactMessages')}}">
                        {{trans('common.contactMessages')}}
                    </span>
                </a>
            </li>


        </ul>
    </div>
</div>
<!-- END: Main Menu-->
