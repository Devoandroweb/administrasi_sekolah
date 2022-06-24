<div class="sidebar-wrapper" style="width:270px;">
    <ul class="nav w-100">
        <li class="nav-item @if ($active == 1) active @endif ">
            <a class="nav-link " href="{{url('dashboard')}}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>

        </li>
        <li class="nav-item" style="margin: 10px 15px 0; ">
            <div id="dropdownMenu" class="nav-link dropdownMenu" style="border-radius: 3px;">
                <span class="link-menu pb-2">
                    <i class="material-icons">dns</i>
                    <p id="arrow">Data Master <i class="material-icons float-right mr-0 ">keyboard_arrow_right</i></p>
                </span>

                <div class="card menu-dropdown ">
                    <div class="card-body p-2" style="line-height: 3rem;">
                        {{--<a class="link-menu-dropdown" href="{{url('admin/guru')}}">Data Guru</a>--}}
                        <a class="link-menu-dropdown" href="{{url('admin/jurusan')}}">Data Jurusan</a>
                        <a class="link-menu-dropdown" href="{{url('admin/kelas')}}">Data Kelas</a>
                        {{--<a class="link-menu-dropdown" href="{{url('admin/mapel')}}">Data Mata Pelajaran</a>--}}
                        <a class="link-menu-dropdown" href="{{url('jenis-administrasi')}}">Jenis Administrasi</a>
                    </div>
                </div>
            </div>
        </li>
        {{--<li class="nav-item @if ($active == 8) active @endif ">
            <a class="nav-link" href="{{url('tanggungan_lalu')}}">
                <i class="material-icons">low_priority</i>
                <p>Tanggungan Lalu</p>
            </a>
        </li>--}}
        <li class="nav-item @if ($active == 8) active @endif ">
            <a class="nav-link" href="{{url('administrasi')}}">
                <i class="material-icons">toys</i>
                <p id="arrowAdministrasi">Administrasi</p>
            </a>
        </li>
        <li class="nav-item" style="margin: 10px 15px 0; ">
            <div id="dropdownMenu" class="nav-link dropdownMenu" style="border-radius: 3px;">
                <span class="link-menu pb-2">
                    <i class="material-icons">paid</i>
                    <p id="arrow">Riwayat Pembayaran<i class="material-icons float-right mr-0 ">keyboard_arrow_right</i></p>
                </span>

                <div class="card menu-dropdown ">
                    <div class="card-body p-2" style="line-height: 3rem;">
                        <a class="link-menu-dropdown" href="{{url('pemasukan')}}">Ajaran Sekarang</a>
                        <a class="link-menu-dropdown" href="{{url('pengeluaran')}}">Semua Ajaran</a>
                    </div>
                </div>
            </div>

        </li>
        
        <!-- <li class="nav-item" style="margin: 10px 15px 0; ">
            <div id="dropdownMenuAdministrasi" class="nav-link  @if ($active == 4) active-purple @endif " style="border-radius: 3px;">
                <span class="link-menu-administrasi pb-2">
                    <i class="material-icons">toys</i>
                    <p id="arrowAdministrasi">Administrasi <i class="material-icons float-right mr-0 @if ($active == 4) arrow-hidden @endif">keyboard_arrow_right</i></p>
                </span>

                <div class="card menu-dropdownAdministrasi @if ($active == 4) show-menu-dropdown @endif ">
                    <div class="card-body p-2" style="line-height: 3rem;">
                        <a class="link-menu-dropdown" href="{{url('administrasi')}}">Dasar</a>
                        <a class="link-menu-dropdown" href="tanggungan_ijazah">Ijazah</a>
                    </div>
                </div>
            </div>
        </li> -->
        {{--<li class="nav-item" style="margin: 10px 15px 0; ">
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

        </li>--}}


        {{--<li class="nav-item @if ($active == 7) active @endif ">
            <a class="nav-link" href="cetak_rekapitulasi" target="_blank">
                <i class="material-icons">history_edu</i>
                <p>Rekapitulasi</p>
            </a>
        </li>--}}
        <li class="nav-item @if ($active == 7) active @endif ">
            <a class="nav-link" href="{{url('setting')}}">
                <i class="material-icons">history_edu</i>
                <p>Setting</p>
            </a>
        </li>
        
        <!-- your sidebar here -->
    </ul>
</div>