<header class="navbar navbar-dark sticky-top bg-warning flex-md-nowrap p-0 shadow" style="width: 100%">
    <div class="text-black col-lg-2 fs-6 fw-bold" href="/home"><img class="align-text-top" src="/img/LogoNami.svg" width="22px"> Nami Laundry </div>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> --}}
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <form action="/logout" method="get">
        @csrf
        <button type="submit" class="nav-link text-black px-3">Logout <span data-feather="log-out" class="align-text-bottom"></span></button>
        </form>
      </div>
    </div>
</header>
