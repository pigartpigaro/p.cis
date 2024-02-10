@include('layout.bg')
    
<body>
<div class="row justify-content-center">
    <div class="col-md-4">

<main class="regist">
    
    <h1 class="h3 mb-4 fw-normal text-center"><b>Form Register</b></h1>
        
        <form action="/postregister" method="post">
        @csrf
        <div class="form-floating mb-3 mt-3">
            <input type="text" name="name" class="form-control rounded" id="name" placeholder="Name" required="">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" name="email" class="form-control rounded" id="email" placeholder="Email" required="">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" name="username" class="form-control rounded" id="username" placeholder="Username" required="">
            <label for="username">Username</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="password" name="password" class="form-control rounded" id="password" placeholder="Password" required="">
            <label for="password">Password</label>
        </div>
        <button type="submit" class="w-100 mt-4 btn btn-primary btn-lg">Register</button>
        </form>
            <small class="d-block text-center mt-3">Sudah punya akun silahkan <a href="/login">Login Disini!</a></small>
</main>
    </div>
</div>
</body>



