<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olahraga & BMI - FitLife</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/olahraga.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        
        @include('layout.nav')

        <div class="hero">
            <h1>Olahraga & BMI Tracker</h1>
            <p>Pantau kesehatan dan aktivitas olahraga Anda</p>
        </div>
    </header>

    <main>
        <section class="bmi-section">
            <div class="container">
                <h2>Kalkulator BMI</h2>
                <div class="bmi-calculator">
                    <div class="bmi-form">
                        <div class="form-group">
                            <label for="height">Tinggi Badan (cm)</label>
                            <input type="number" id="height" min="100" max="250" required>
                        </div>
                        <div class="form-group">
                            <label for="weight">Berat Badan (kg)</label>
                            <input type="number" id="weight" min="30" max="300" required>
                        </div>
                        <button id="calculate-bmi" class="btn-primary">Hitung BMI</button>
                    </div>
                    <div class="bmi-result">
                        <div class="result-value">
                            <span id="bmi-score">--</span>
                            <span>BMI</span>
                        </div>
                        <div class="result-category" id="bmi-category">
                            Masukkan data untuk menghitung BMI
                        </div>
                        <div class="bmi-chart">
                            <div class="chart-bar underweight" data-range="18.5"></div>
                            <div class="chart-bar normal" data-range="18.5-24.9"></div>
                            <div class="chart-bar overweight" data-range="25-29.9"></div>
                            <div class="chart-bar obese" data-range="≥30"></div>
                            <div class="chart-indicator" id="bmi-indicator"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="exercise-section">
            <div class="container">
                <h2>Rekomendasi Olahraga</h2>
                <div class="exercise-filter">
                    <button class="filter-btn active" data-type="all">Semua</button>
                    <button class="filter-btn" data-type="cardio">Cardio</button>
                    <button class="filter-btn" data-type="strength">Strength</button>
                    <button class="filter-btn" data-type="flexibility">Flexibility</button>
                </div>
                <div class="exercise-grid">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 FitLife. All rights reserved.</p>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/olahraga.js') }}"></script>
</body>
</html>