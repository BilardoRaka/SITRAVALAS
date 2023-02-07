    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        @can('isAdmin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-muted">
          <span>ADMINISTRATOR</span>
        </h6>
        @endcan
        @can('isCabang')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-muted">
          <span>CABANG {{ auth()->user()->user->wilayah }}</span>
        </h6>
        @endcan
        @can('isPimpinan')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-muted">
          <span>PIMPINAN PERUSAHAAN</span>
        </h6>
        @endcan
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          @can('isAdmin')
          <li class="nav-item ">
            <a class="nav-link {{ Request::is('dashboard/account*') ? 'active' : '' }}" href="/dashboard/accounts">
              <span data-feather="smile" class="align-text-bottom"></span>
              Data Akun
            </a>
          </li>
          @endcan
          @cannot('isCabang')
          <li class="nav-item ">
            <a class="nav-link {{ Request::is('dashboard/forex*') ? 'active' : '' }}" href="/dashboard/forexes">
              <span data-feather="dollar-sign" class="align-text-bottom"></span>
              Data Forex
            </a>
          </li>
          @endcannot
          <li class="nav-item ">
            <a class="nav-link {{ Request::is('dashboard/customer*') ? 'active' : '' }}" href="/dashboard/customers">
              <span data-feather="users" class="align-text-bottom"></span>
              Data Customer
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ Request::is('dashboard/transaction*') ? 'active' : '' }}" href="/dashboard/transactions">
              <span data-feather="archive" class="align-text-bottom"></span>
              Data Transaksi
            </a>
          </li>
          @can('isCabang')
          <li class="nav-item ">
            <a class="nav-link {{ Request::is('dashboard/deteksiLokasi*') ? 'active' : '' }}" href="/dashboard/deteksiLokasi">
              <span data-feather="map-pin" class="align-text-bottom"></span>
              Koordinat Kios
            </a>
          </li>
          @endcan
        </ul> 
      </div>
    </nav>