<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3  bg-gradient-info"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="{{ asset('admin/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">QUẢN LÝ TIÊM CHỦNG</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href={{ route('childrent.index') }}>
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('schedule.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Lịch tiêm</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vaccine.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-shield-virus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Vắc-xin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vaccinationdetails.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý mũi tiêm</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseTables">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-table" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Các bảng</span>
                </a>
            </li>
            <div class="collapse ms-3" id="collapseTables">
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('childrent.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-baby"></i>
                        </div>
                        <span class="nav-link-text ms-1">Trẻ em</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('parentadmin.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="nav-link-text ms-1">Phụ huynh</span>
                    </a>
                </li>
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('medicalstaff.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <span class="nav-link-text ms-1">Nhân viên y tế</span>
                        </a>
                    </li>
                @endif

            </div>

            <li class="nav-item">
                <a class="nav-link text-white " href="../pages/notifications.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý thông báo</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Quản lý tài khoản
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="../pages/profile.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Thông tin người dùng</span>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a onclick="document.getElementById('logout').submit();" class="nav-link text-white "
                        href="javascript:{}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>
                        <span class="nav-link-text ms-1">Đăng xuất</span>


                    </a>
                </form>
            </li>
            {{-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/sign-up.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li> --}}
        </ul>
    </div>
</aside>
