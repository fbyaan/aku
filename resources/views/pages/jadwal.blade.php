<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Olahraga - FitLife</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
       

        @include('layout.nav')

        <div class="hero">
            <h1>Jadwal Olahraga Personal</h1>
            <p>Buat dan kelola jadwal olahraga Anda</p>
        </div>
    </header>

    <main>
        <section class="schedule-section">
            <div class="container">
                <div class="schedule-controls">
                    <button id="add-workout" class="btn-primary">
                        <i class="fas fa-plus"></i> Tambah Workout
                    </button>
                   
                </div>


                 <div class="schedule-list">
                    @if(isset($schedules) && count($schedules) > 0)
                        <table class="workout-table">
                            <thead>
                                <tr>
                                    <th>Nama Workout</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Durasi</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $workout)
                                    <tr>
                                        <td>{{ $workout->nama_workout }}</td>
                                        <td>{{ $workout->hari }}</td>
                                        <td>{{ $workout->waktu }}</td>
                                        <td>{{ $workout->durasi }} menit</td>
                                        <td>{{ $workout->jenis_olahraga }}</td>
                                        <td>
                                            <button class="edit-workout btn-secondary" data-id="{{ $workout->id }}"><i class="fas fa-edit"></i></button>
                                            <button class="delete-workout btn-danger" data-id="{{ $workout->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Belum ada jadwal workout. Tambahkan workout untuk memulai!</p>
                    @endif
                </div>
                
                
            </div>
        </section>
        
        <div id="workout-modal" class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h2>Tambah Workout Baru</h2>
                <form id="workout-form">
                    <div class="form-group">
                        <label for="workout-name">Nama Workout</label>
                        <input type="text" id="workout-name" required>
                    </div>
                    <div class="form-group">
                        <label for="workout-day">Hari</label>
                        <select id="workout-day" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="workout-time">Waktu</label>
                        <input type="time" id="workout-time" required>
                    </div>
                    <div class="form-group">
                        <label for="workout-duration">Durasi (menit)</label>
                        <input type="number" id="workout-duration" min="5" max="180" required>
                    </div>
                    <div class="form-group">
                        <label for="workout-type">Jenis Olahraga</label>
                        <select id="workout-type" required>
                            <option value="">Pilih Jenis</option>
                            <option value="Cardio">Cardio</option>
                            <option value="Strength">Strength Training</option>
                            <option value="Flexibility">Flexibility</option>
                            <option value="HIIT">HIIT</option>
                            <option value="Yoga">Yoga</option>
                            <option value="Other">Lainnya</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 FitLife. All rights reserved.</p>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script> 
    <script></script>

</body>
</html>