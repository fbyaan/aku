<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                                        <td>{{ substr($workout->waktu, 0, 5) }}</td>
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
                <h2 id="modal-title">Tambah Workout Baru</h2>
                <form id="workout-form">
                    @csrf
                    <input type="hidden" id="workout-id" name="workout_id">
                    <input type="hidden" id="form-method" name="_method" value="POST">
                    
                    <div class="form-group">
                        <label for="workout-name">Nama Workout</label>
                        <input type="text" id="workout-name" name="nama_workout" required>
                    </div>
                    <div class="form-group">
                        <label for="workout-day">Hari</label>
                        <select id="workout-day" name="hari" required>
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
                        <input type="time" id="workout-time" name="waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="workout-duration">Durasi (menit)</label>
                        <input type="number" id="workout-duration" name="durasi" min="5" max="180" required>
                    </div>
                    <div class="form-group">
                        <label for="workout-type">Jenis Olahraga</label>
                        <select id="workout-type" name="jenis_olahraga" required>
                            <option value="">Pilih Jenis</option>
                            <option value="Cardio">Cardio</option>
                            <option value="Strength">Strength Training</option>
                            <option value="Flexibility">Flexibility</option>
                            <option value="HIIT">HIIT</option>
                            <option value="Yoga">Yoga</option>
                            <option value="Other">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" id="cancel-btn">Batal</button>
                        <button type="submit" class="btn-primary" id="submit-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 FitLife. All rights reserved.</p>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // CSRF Token setup
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Modal elements
            const modal = document.getElementById('workout-modal');
            const addBtn = document.getElementById('add-workout');
            const closeBtn = document.querySelector('.close-modal');
            const cancelBtn = document.getElementById('cancel-btn');
            const form = document.getElementById('workout-form');
            const modalTitle = document.getElementById('modal-title');
            const submitBtn = document.getElementById('submit-btn');

            // Show success/error messages
            function showMessage(message, type = 'success') {
                const messageDiv = document.createElement('div');
                messageDiv.className = `alert alert-${type}`;
                messageDiv.textContent = message;
                messageDiv.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 15px 20px;
                    border-radius: 5px;
                    color: white;
                    font-weight: bold;
                    z-index: 10000;
                    background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
                `;
                document.body.appendChild(messageDiv);
                setTimeout(() => {
                    messageDiv.remove();
                }, 3000);
            }

            // Open modal for adding new workout
            addBtn.addEventListener('click', function() {
                form.reset();
                document.getElementById('workout-id').value = '';
                document.getElementById('form-method').value = 'POST';
                modalTitle.textContent = 'Tambah Workout Baru';
                submitBtn.textContent = 'Simpan';
                modal.style.display = 'block';
            });

            // Close modal functions
            function closeModal() {
                modal.style.display = 'none';
            }

            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Handle form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                const workoutId = document.getElementById('workout-id').value;
                const method = workoutId ? 'PUT' : 'POST';
                const url = workoutId ? `/workouts/${workoutId}` : '/workouts';

                // Convert FormData to JSON
                const data = {};
                formData.forEach((value, key) => {
                    if (key !== '_token' && key !== '_method' && key !== 'workout_id') {
                        data[key] = value;
                    }
                });

                fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showMessage(result.message);
                        closeModal();
                        location.reload(); // Reload to update the table
                    } else {
                        showMessage('Terjadi kesalahan: ' + (result.message || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Terjadi kesalahan saat menyimpan data', 'error');
                });
            });

            // Handle edit workout
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-workout')) {
                    const btn = e.target.closest('.edit-workout');
                    const workoutId = btn.getAttribute('data-id');
                    
                    fetch(`/workouts/${workoutId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            const workout = result.data;
                            
                            // Fill form with workout data
                            document.getElementById('workout-id').value = workout.id;
                            document.getElementById('form-method').value = 'PUT';
                            document.getElementById('workout-name').value = workout.nama_workout;
                            document.getElementById('workout-day').value = workout.hari;
                            document.getElementById('workout-time').value = workout.waktu;
                            document.getElementById('workout-duration').value = workout.durasi;
                            document.getElementById('workout-type').value = workout.jenis_olahraga;
                            
                            modalTitle.textContent = 'Edit Workout';
                            submitBtn.textContent = 'Update';
                            modal.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showMessage('Gagal memuat data workout', 'error');
                    });
                }
            });

            // Handle delete workout
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-workout')) {
                    const btn = e.target.closest('.delete-workout');
                    const workoutId = btn.getAttribute('data-id');
                    
                    if (confirm('Apakah Anda yakin ingin menghapus workout ini?')) {
                        fetch(`/workouts/${workoutId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                showMessage(result.message);
                                location.reload(); // Reload to update the table
                            } else {
                                showMessage('Gagal menghapus workout', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showMessage('Terjadi kesalahan saat menghapus data', 'error');
                        });
                    }
                }
            });
        });
    </script>

</body>
</html>