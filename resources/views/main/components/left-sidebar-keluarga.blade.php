<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/keluarga') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Anggota Keluarga</span></li>

                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('keluarga/member/manage') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Anggota Keluarga
                        </span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('keluarga/member/tambah') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Tambah Anggota
                        </span></a>
                </li>
              

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{url('/about')}}"
                        aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                            class="hide-menu">Documentation</span></a></li>
             
                {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i data-feather="power" class="svg-icon mr-2 ml-1"></i>Logout</a> --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
