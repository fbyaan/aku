document.addEventListener('DOMContentLoaded', function() {
    // Sample workout data
    let workouts = [];

    // Ambil data dari backend
    function fetchWorkouts() {
        fetch('/jadwal/api')
            .then(res => res.json())
            .then(data => {
                workouts = data;
                renderSchedule();
            });
    }

    // Tambah/Update workout ke backend
    function saveWorkout(workoutData, isEditing) {
        let url = '/workouts';
        let method = 'POST';
        if (isEditing) {
            url = `/workouts/${workoutData.id}`;
            method = 'PUT';
        }
        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(workoutData)
        }).then(() => {
            workoutModal.style.display = 'none';
            fetchWorkouts();
        });
    }

    // Hapus workout dari backend
    function deleteWorkout(id) {
        fetch(`/workouts/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => fetchWorkouts());
    }

    // DOM Elements
    const scheduleGrid = document.querySelector('.schedule-grid');
    const addWorkoutBtn = document.getElementById('add-workout');
    const workoutModal = document.getElementById('workout-modal');
    const closeModal = document.querySelector('.close-modal');
    const workoutForm = document.getElementById('workout-form');
    const prevWeekBtn = document.getElementById('prev-week');
    const nextWeekBtn = document.getElementById('next-week');
    const weekDisplay = document.getElementById('week-display');
    
    // Days of the week
    const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    
    // Current week tracking
    let currentWeekOffset = 0;
    
    // Initialize the schedule
    function initSchedule() {
        fetchWorkouts();
        updateWeekDisplay();
    }
    
    // Render the schedule grid
    function renderSchedule() {
        scheduleGrid.innerHTML = '';
        
        days.forEach(day => {
            const dayWorkouts = workouts.filter(workout => workout.day === day);
            
            const dayCard = document.createElement('div');
            dayCard.className = 'day-card';
            
            dayCard.innerHTML = `
                <div class="day-header">
                    <h3 class="day-title">${day}</h3>
                    <span class="workout-count">${dayWorkouts.length} workout</span>
                </div>
                <ul class="workout-list">
                    ${dayWorkouts.length > 0 ? 
                        dayWorkouts.map(workout => `
                            <li class="workout-item">
                                <h4>${workout.name}</h4>
                                <div class="workout-meta">
                                    <span>${workout.time} - ${workout.duration} menit</span>
                                    <span>${workout.type}</span>
                                </div>
                                <div class="workout-actions">
                                    <button class="edit-workout" data-id="${workout.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="delete-workout" data-id="${workout.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </li>
                        `).join('') : 
                        '<p class="no-workouts">Tidak ada workout dijadwalkan</p>'}
                </ul>
            `;
            
            scheduleGrid.appendChild(dayCard);
        });
        
        // Add event listeners to action buttons
        document.querySelectorAll('.edit-workout').forEach(btn => {
            btn.addEventListener('click', handleEditWorkout);
        });
        
        document.querySelectorAll('.delete-workout').forEach(btn => {
            btn.addEventListener('click', handleDeleteWorkout);
        });
    }
    
    // Handle adding a new workout
    function handleAddWorkout() {
        workoutModal.style.display = 'block';
        workoutForm.reset();
        workoutForm.dataset.editing = 'false';
    }
    
    // Handle form submission
    function handleFormSubmit(e) {
        e.preventDefault();
        const isEditing = workoutForm.dataset.editing === 'true';
        const workoutId = isEditing ? parseInt(workoutForm.dataset.workoutId) : null;
        const workoutData = {
            id: workoutId,
            nama_workout: document.getElementById('workout-name').value,
            hari: document.getElementById('workout-day').value,
            waktu: document.getElementById('workout-time').value,
            durasi: parseInt(document.getElementById('workout-duration').value),
            jenis_olahraga: document.getElementById('workout-type').value
        };
        if (isEditing) workoutData.id = workoutId;
        saveWorkout(workoutData, isEditing);
    }
    
    // Handle editing a workout
    function handleEditWorkout(e) {
        const workoutId = parseInt(e.currentTarget.dataset.id);
        const workout = workouts.find(w => w.id === workoutId);
        
        if (workout) {
            document.getElementById('workout-name').value = workout.nama_workout;
            document.getElementById('workout-day').value = workout.hari;
            document.getElementById('workout-time').value = workout.waktu;
            document.getElementById('workout-duration').value = workout.durasi;
            document.getElementById('workout-type').value = workout.jenis_olahraga;
            
            workoutForm.dataset.editing = 'true';
            workoutForm.dataset.workoutId = workoutId;
            workoutModal.style.display = 'block';
        }
    }
    
    // Handle deleting a workout
    function handleDeleteWorkout(e) {
        if (confirm('Apakah Anda yakin ingin menghapus workout ini?')) {
            const workoutId = parseInt(e.currentTarget.dataset.id);
            deleteWorkout(workoutId);
        }
    }
    
    // Update week display
    function updateWeekDisplay() {
        const today = new Date();
        const startOfWeek = new Date(today);
        startOfWeek.setDate(today.getDate() - today.getDay() + 1 + (currentWeekOffset * 7));
        
        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);
        
        if (currentWeekOffset === 0) {
            weekDisplay.textContent = 'Minggu Ini';
        } else if (currentWeekOffset === -1) {
            weekDisplay.textContent = 'Minggu Lalu';
        } else if (currentWeekOffset === 1) {
            weekDisplay.textContent = 'Minggu Depan';
        } else {
            const options = { day: 'numeric', month: 'short' };
            weekDisplay.textContent = 
                `${startOfWeek.toLocaleDateString('id-ID', options)} - ${endOfWeek.toLocaleDateString('id-ID', options)}`;
        }
    }
    
    // Event Listeners
    addWorkoutBtn.addEventListener('click', handleAddWorkout);
    closeModal.addEventListener('click', () => workoutModal.style.display = 'none');
    workoutForm.addEventListener('submit', handleFormSubmit);
    
    prevWeekBtn.addEventListener('click', () => {
        currentWeekOffset--;
        updateWeekDisplay();
    });
    
    nextWeekBtn.addEventListener('click', () => {
        currentWeekOffset++;
        updateWeekDisplay();
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === workoutModal) {
            workoutModal.style.display = 'none';
        }
    });
    
    // Initialize the app
    initSchedule();
    
});