<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Kami | FitLife</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/team.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        
        @include('layout.nav')

        
        <div class="hero">
            <h1>Tim FitLife</h1>
            <p>Para ahli di balik transformasi kesehatan Anda</p>
        </div>
    </header>

    <main>
        <section class="team-intro">
            <h2>Kenali Tim Kami</h2>
            <p>Dua Mahasiswa informatika yang sedang berjuang menyelesaikan final project dengan coding dan debugging.</p>
        </section>

        <section class="team-members">
            <div class="member-card">
                <div class="member-img-circle">
                    <img src="{{ asset('image/fabian.jpg') }}" alt="Fabian">
                </div>
                <div class="member-info">
                    <h3>Muchamad Budi Fabiantoro</h3>
                    <p class="role">Mahasiswa Informatika</p>
                    <p>Mahasiswa yang sedang mengembangkan final project dengan mengubah ide menjadi kode yang efisien dan fungsional</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/fbyy.ant/" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/muchamad-budi-fabiantoro-181723280/" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                        <a href="https://wa.me/085739452171" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <div class="member-card">
                <div class="member-img-circle">
                    <img src="{{ asset('image/agik.jpg') }}" alt="Agik">
                </div>
                <div class="member-info">
                    <h3>Agik Wiyono</h3>
                    <p class="role">Mahasiswa Informatika</p>
                    <p>Mahasiswa yang tengah menyelesaikan final project, menerapkan konsep teknologi dan merancang sistem yang efektif</p>
                    </p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/agikwiy/" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/agik-wiyono-3b97522a4?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app " target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                        <a href="https://wa.me/6285755131406" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer>
        <p>&copy; 2023 FitLife. All rights reserved.</p>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>