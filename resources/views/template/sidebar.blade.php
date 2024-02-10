<nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-1 sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{  Request::is('home') ? 'active' : '' }}" aria-current="page" href="/home">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{  Request::is('transaksi*') ? 'active' : '' }}" href="/transaksi">
          <span data-feather="file" class="align-text-bottom"></span>
          Transaksi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{  Request::is('order*') ? 'active' : '' }}" href="/order">
          <span data-feather="shopping-cart" class="align-text-bottom"></span>
          Order
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{  Request::is('kategori*','produk*','satuan*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#collapseExample">
          <span data-feather="hard-drive" class="align-text-bottom"></span>
          Master
          <span data-feather="chevrons-down" class="align-text-bottom"></span>
        </a>
        <div class="collapse" id="collapseExample">
          <a class="nav-link ml-3 {{  Request::is('kategori*') ? 'active' : '' }}" href="/kategori">
            <span data-feather="layers" class="align-text-bottom"></span>
            Kategori
          </a>
        </div>
        <div class="collapse" id="collapseExample">
          <a class="nav-link ml-3 {{  Request::is('satuan*') ? 'active' : '' }}" href="/satuan">
            <span data-feather="at-sign" class="align-text-bottom"></span>
            Satuan
          </a>
        </div>
        <div class="collapse" id="collapseExample">
          <a class="nav-link ml-3 {{  Request::is('produk*') ? 'active' : '' }}" href="/produk">
            <span data-feather="package" class="align-text-bottom"></span>
            Produk
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link {{  Request::is('pelanggan*') ? 'active' : '' }}" href="/pelanggan">
          <span data-feather="users" class="align-text-bottom"></span>
          Pelanggan
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" {{  Request::is('reports*') ? 'active' : '' }}" href="/laporan">
          <span data-feather="bar-chart-2" class="align-text-bottom"></span>
          Reports
        </a>
      </li>
      
    </ul>

    
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
      <span>Saved reports</span>
      <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle" class="align-text-bottom"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Current month
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Last quarter
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Social engagement
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Year-end sale
        </a>
      </li>
    </ul>
  </div>
</nav>


{{-- <script src="/js/bar.js"></script>
<nav class="w3-sidebar">
  <div class="x1">
    @csrf
    <a href="/home" class="x1"><img src="img/Logomenu2.svg" width="100%"></a>
    
  </div>

    <div class="x2">
      <a class="w3-button w3-hover-yellow w3-hover-text-blue w3-left-align" onclick="myFunction('a1')">
        Master <i class="fa fa-caret-down"></i>
      </a>
        <div id="a1" class="w3-hide w3-card" style="font-size:80%">
          <a href="/pelanggan" class="w3-button w3-hover-yellow w3-hover-text-blue">Pelanggan</a>
          <a href="#" class="w3-button w3-hover-yellow w3-hover-text-blue">Kategori</a>
          <a href="#" class="w3-button w3-hover-yellow w3-hover-text-blue">Produk</a>
          <a href="#" class="w3-button w3-hover-yellow w3-hover-text-blue">Satuan</a>
        </div>
    
    <div>
      <a class="w3-button w3-hover-yellow w3-hover-text-blue w3-left-align" onclick="myFunction('a2')">
        Transaksi <i class="fa fa-caret-down"></i>
      </a>
        <div id="a2" class="w3-hide w3-card" style="font-size:80%">
          <a href="/getbayar" class="w3-button w3-hover-yellow w3-hover-text-blue">Pesanan</a>
          <a href="#" class="w3-button w3-hover-yellow w3-hover-text-blue">Riwayat</a>
          <a href="#" class="w3-button w3-hover-yellow w3-hover-text-blue">Pembayaran</a>
        </div>
    </div>
  <div class="x2">

      <a href="/laporan" class="x2">Laporan</a>

  </div>
  <div class="x3">
    @csrf
  <a href="/logout" class="x3">Logout <i class="fa fa-sign-out" style="padding-left: 10px"></i></a>
  </div>

</nav> --}}
