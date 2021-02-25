<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-key"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AMANAH</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item{{ request()->is('home') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Kelola User -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#toggleUser" aria-expanded="true"
            aria-controls="toggleUser">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola User</span>
        </a>
        <div id="toggleUser" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola User</h6>
                <a class="collapse-item{{ request()->is('karyawan') ? ' active' : '' }}"
                    href="{{ route('user.index') }}">Daftar karyawan</a>
                <a class="collapse-item{{ request()->is('member') ? ' active' : '' }}"
                    href="{{ route('member.index') }}">Daftar member</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Kelola Sampah -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#toggleSampah" aria-expanded="true"
            aria-controls="toggleSampah">
            <i class="fas fa-fw fa-warehouse"></i>
            <span>Kelola Produk</span>
        </a>
        <div id="toggleSampah" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Produk</h6>
                <a class="collapse-item{{ request()->is('sampah') ? ' active' : '' }}"
                    href="{{ route('product.index') }}">Produk</a>
                <a class="collapse-item{{ request()->is('gudang') ? ' active' : '' }}"
                    href="{{ route('supplier.index') }}">Supplier</a>
                <a class="collapse-item{{ request()->is('gudang') ? ' active' : '' }}"
                    href="{{ route('category.index') }}">Kategori</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kasir
    </div>


    <!-- Nav Item - Keuangan -->
    <li class="nav-item{{ request()->is('keuangan') ? ' active' : '' }}"">
        <a class=" nav-link" href="{{ route('keuangan.index') }}">
        <i class="fas fa-fw fa-chart-line"></i>
        <span>Keuangan</span></a>
    </li>

    <!-- Nav Item - penjualan -->
    <li class="nav-item{{ request()->is('penjualan') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('penjualan.index') }}">
            <i class="fas fa-fw fa-hand-holding-water"></i>
            <span>Penjualan</span></a>
    </li>

    <!-- Nav Item - pembelian -->
    <li class="nav-item{{ request()->is('pembelian') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pembelian.index') }}">
            <i class="fas fa-fw fa-water"></i>
            <span>Pembelian</span></a>
    </li>
     {{-- Nav item pemgeluaran --}}
    <li class="nav-item{{ request()->is('pengeluaran') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pengeluaran.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Pengeluaran</span></a>
    </li>
    {{-- Nav item  kasir --}}
    <li class="nav-item{{ request()->is('kasir') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.index') }}">
            <i class="fas fa-fw fa-fire"></i>
            <span>Kasir</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
