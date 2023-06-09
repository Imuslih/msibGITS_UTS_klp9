    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link">
        <img
          src="{{ asset('/template/dist/img/AdminLTELogo.png') }}"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">E-Kasir</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        
        <!-- Sidebar user panel (optional) -->
        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                src="{{ asset('img/avatar5.png') }}"
                class="img-circle elevation-2"
                alt="User Image"
              />
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            {{-- <li class="nav-item">
              <a
                 href="{{ route('dashboard') }}"
                class="nav-link {{ $menu == 'dashboard' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li> --}}

            {{-- <li class="nav-item">
              <a
                 href="{{ route('kirimWA') }}"
                 href="{{ route('index_transaction') }}"
                class="nav-link {{ $menu == 'transaction' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Cart</p>
              </a>
            </li> --}}

            <li class="nav-item {{ $menu == 'master' ? 'menu-open' : '' }} ">
              <a href="#" class="nav-link {{ $menu == 'master' ? 'active' : '' }} ">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Master Data
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a
                    href="{{ route('category') }}"
                    class="nav-link {{ $sub_menu == 'kategori' ? 'active' : '' }}"
                  >
                    <i
                     class="{{ $sub_menu == 'kategori' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Kategori</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a
                    href="{{ route('products') }}"
                    class="nav-link {{ $sub_menu == 'produk' ? 'active' : '' }}"
                  >
                    <i
                      class="{{ $sub_menu == 'produk' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Produk</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a
                 href="{{ route('transaction') }}"
                class="nav-link {{ $menu == 'transaction' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Penjualan</p>
              </a>
            </li>

             <li class="nav-item">
              <a
                href="{{ route('list_transaction') }}"
                class="nav-link {{ $menu == 'list_transaction' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Riwayat Transaksi</p>
              </a>
            </li>

        
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
