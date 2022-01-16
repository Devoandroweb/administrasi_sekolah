<div class="sidebar-wrapper">
    <ul class="nav ">
        <li class="nav-item @if ($active == 1) active @endif ">
            <a class="nav-link " href="{{url('dashboard')}}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item" style="margin: 10px 15px 0; ">
            <div id="dropdownMenu" class="nav-link  @if ($active == 5) active-purple @endif " style="border-radius: 3px;">
                <span class="link-menu pb-2">
                    <i class="material-icons">face</i>
                    <p id="arrow">Data Siswa <i class="material-icons float-right mr-0 @if ($active == 5) arrow-hidden @endif">keyboard_arrow_right</i></p>
                </span>

                <div class="card menu-dropdown @if ($active == 5) show-menu-dropdown @endif ">
                    <div class="card-body p-2" style="line-height: 3rem;">
                        <a class="link-menu-dropdown" href="siswa">Siswa Aktif</a>
                        <a class="link-menu-dropdown" href="alumni">Siswa Alumni</a>
                    </div>
                </div>
            </div>

        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{url('user-management')}}">
                <i class="material-icons">
                    manage_accounts
                </i>
                <p>User Management</p>
            </a>
        </li>

        <!-- your sidebar here -->
    </ul>
</div>