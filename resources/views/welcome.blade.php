<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLife - Transformasi Kesehatan Anda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        
        @include('layout.nav')

        <div class="hero">
            <h1>Transformasi Kesehatan Anda</h1>
            <p>Jadwal olahraga personal dan tracker BMI dalam satu platform</p>
            <a href="/olahraga" class="cta-button">Mulai Sekarang</a>
        </div>
    </header>

    <main>
        <section class="features">
            <a href="/jadwal" class="feature-card">
                <i class="fas fa-calendar-alt"></i>
                <h3>Jadwal Personal</h3>
                <p>Buat jadwal olahraga sesuai kebutuhan Anda</p>
            </a>
            <a href="/olahraga" class="feature-card">
                <i class="fas fa-heartbeat"></i>
                <h3>Tracker BMI</h3>
                <p>Pantau perkembangan kesehatan Anda</p>
            </a>
            
        </section>
    </main>

    
    <footer>
        <p>&copy; 2023 FitLife. All rights reserved.</p>
        
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>