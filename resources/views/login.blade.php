@include('layout.bg')



<body>

<div>
    @if(session()->has('Success'))
        <div class="success" >
            {{ session('Success') }}
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endif

    @if(session()->has('loginError'))
        <div class="alert">
            {{ session('loginError') }}
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endif  
</div>

<main class="login">
        <h1 class="h3 mb-4 fw-normal text-center"><b>Login to P.CIS</b></h1>
    <form action="/postlogin" method="post">
    @csrf
    <div class="form-floating mb-3 mt-3">
        <input type="text" name="username" class="form-control rounded @error('username') is-invalid @enderror" id="username" placeholder="Username" autofocus required value="{{ old ('username')}}">
        <label for="username">Username</label>
        @error ('username')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-floating mb-3 mt-3">
        <input type="password" name="password" class="form-control rounded" id="password" placeholder="Password" required>
        <label for="password">Password</label>
    </div>
    <button type="submit" class="w-100 btn btn-primary btn-lg">Log In</button>   
    </form>
        <small class="d-block text-center mt-3">Belum punya akun? <a href="/register">Register sekarang! </a></small>
</main>
</div>
</div>
</div>
</body>
