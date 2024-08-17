<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ url('css/style.css') }}" />
    <title>Sign in & Sign up Form</title>
    <style>
        .text-red-500 {
            color: #f56565;
            font-size: 0.875rem; /* Optional: adjust font size */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Sign In Form -->
                <form method="POST" action="{{ route('login') }}" class="sign-in-form">
                    @csrf
                    <img src="{{ url('images/logo_siix.png') }}" class="" alt="" width="180" height="100" />
                    <hr>
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <x-input id="nik" class="block mt-1 w-full" type="number" name="nik" :value="old('nik')" placeholder="NIK" required autofocus autocomplete="username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                    </div>
                    @error('nik')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <x-button class="btn solid">
                        {{ __('Sign In') }}
                    </x-button>
                </form>

                <!-- Sign Up Form -->
                <form method="POST" action="{{ route('register') }}" class="sign-up-form">
                    @csrf
                    <img src="{{ url('images/logo_siix.png') }}" class="" alt="" width="180" height="100" />
                    <hr>
                    <h2 class="title">Register</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <x-input id="nik" class="block mt-1 w-full" type="number" name="nik" :value="old('nik')" placeholder="NIK" required />
                    </div>
                    
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus autocomplete="name" />
                    </div>
                   
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                    </div>
                    @error('nik')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <x-button class="btn">
                        {{ __('Sign Up') }}
                    </x-button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Welcome To Web Portal Admin Dept.</h3>
                    <p>Belum Mempunyai Akun? Silahkan klik tombol Sign Up di bawah ini untuk mengakses Website.</p>
                    <button class="btn transparent" id="sign-up-btn">
                        {{ __('Sign Up') }}
                    </button>
                </div>
                <img src="{{ url('images/login.png') }}" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Sudah Mempunyai Akun?</h3>
                    <p>Silahkan klik tombol Sign In di bawah ini.</p>
                    <button class="btn transparent" id="sign-in-btn">
                        {{ __('Sign In') }}
                    </button>
                </div>
                <img src="{{ url('images/register.png') }}" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="{{ url('js/app.js') }}"></script>
</body>
</html>
