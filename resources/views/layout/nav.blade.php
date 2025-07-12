<nav>
    <div class="logo">FitLife</div>
    <ul>
        <li><a href="/">Beranda</a></li>
        <li><a href="/jadwal">Jadwal</a></li>
        <li><a href="/olahraga">Olahraga & BMI</a></li>
        <li><a href="/team">Tim Kami</a></li>
    </ul>
    <div class="auth-buttons">
        @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Register</a>
        @endif
    </div>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<style>
    /* Navbar Styles */
    
    
    .logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
    }
    
    ul {
        display: flex;
        gap: 1.5rem;
        list-style: none;
    }
    
    ul li a {
        text-decoration: none;
        color: var(--dark);
        font-weight: 500;
        transition: color 0.3s;
    }
    
    ul li a:hover {
        color: var(--primary);
    }
    
    .auth-buttons {
        display: flex;
        align-items: center;
        gap: 0.75rem; /* Mengurangi gap antara button */
    }
    
    /* Button Styles - Standar Industri */
    .btn-login,
    .btn-register,
    .btn-logout {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
        border: none;
        display: inline-block;
        text-align: center;
        min-width: 80px; /* Lebar minimum untuk konsistensi */
    }
    
    .btn-login {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-register {
        background-color: var(--secondary);
        color: white;
    }
    
    .btn-logout {
        background-color: #f44336; /* Warna merah untuk logout */
        color: white;
    }
    
    /* Hover Effects */
    .btn-login:hover {
        background-color: var(--primary-dark);
        transform: translateY(-1px);
    }
    
    .btn-register:hover {
        background-color: #e68a00; /* Darker orange */
        transform: translateY(-1px);
    }
    
    .btn-logout:hover {
        background-color: #d32f2f; /* Darker red */
        transform: translateY(-1px);
    }
    
    /* Hamburger Menu (for mobile) */
    .hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
    }
    
    .hamburger span {
        width: 25px;
        height: 3px;
        background-color: var(--dark);
        transition: all 0.3s;
    }
    
    @media (max-width: 768px) {
        ul {
            display: none;
        }
        
        .auth-buttons {
            display: none;
        }
        
        .hamburger {
            display: flex;
        }
    }
</style>