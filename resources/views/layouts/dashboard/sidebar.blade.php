<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.html">
            <img src="images/logo-A.png" class="img-fluid" alt="">
            <span>Anaisme</span>
        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="
                @if (request()->url() == route('dashboard')) active @endif
                ">
                    <a href="{{ route('dashboard') }}" class="iq-waves-effect"><i
                            class="ri-home-4-line"></i><span>Dashboard</span></a>
                </li>

                <li class="
                @if (request()->url() == route('sensor')) active @endif
                ">
                    <a href="{{ route('sensor') }}" class="iq-waves-effect"><i
                            class="ri-temp-cold-line"></i><span>Sensor</span></a>
                </li>

                <li class="
                @if (request()->url() == route('leds.index')) active @endif
                ">
                    <a href="{{ route('leds.index') }}" class="iq-waves-effect"><i
                            class="ri-lightbulb-line"></i><span>LED Control</span></a>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li class="
                @if (request()->url() == route('users.index')) active @endif
                ">
                        <a href="{{ route('users.index') }}" class="iq-waves-effect"><i
                                class="ri-user-2-line"></i><span>Pengguna</span></a>
                    </li>
                @endif
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
