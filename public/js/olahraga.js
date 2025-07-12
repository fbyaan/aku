// olahraga.js
document.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        document.getElementById("calculate-bmi").click(); // Simulasi klik pada tombol
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const heightInput = document.getElementById('height');
    const weightInput = document.getElementById('weight');
    const calculateBtn = document.getElementById('calculate-bmi');
    const bmiScore = document.getElementById('bmi-score');
    const bmiCategory = document.getElementById('bmi-category');
    const bmiIndicator = document.getElementById('bmi-indicator');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const exerciseGrid = document.querySelector('.exercise-grid');
    
    // Tambahkan CSS untuk styling
    const styleElement = document.createElement('style');
    styleElement.textContent = `
        .exercise-card {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .exercise-card:hover {
            transform: translateY(-5px);
        }
        
        .exercise-img {
            height: 180px;
            background-size: cover;
            background-position: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .exercise-img:hover {
            opacity: 0.9;
        }
        
        .exercise-content {
            padding: 15px;
            position: relative;
        }
        
        .exercise-link-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
        
        .exercise-link {
            display: inline-block;
            padding: 6px 12px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .exercise-link:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .exercise-type {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        
        .cardio {
            background-color: #ff7675;
            color: white;
        }
        
        .strength {
            background-color: #74b9ff;
            color: white;
        }
        
        .flexibility {
            background-color: #55efc4;
            color: #2d3436;
        }
    `;
    document.head.appendChild(styleElement);
    
    // Exercise Data
    const exercises = [
        {
            id: 1,
            title: "Lari Pagi",
            type: "cardio",
            duration: "30 menit",
            difficulty: "Pemula",
            description: "Lari santai di pagi hari membantu meningkatkan stamina dan kesehatan jantung.",
            image: "url('../../../assets/Image_Olahraga/running.jpeg')",
            url: "https://cyclopedia.id/id/blog/cyclopedia-journal-1/post/manfaat-lari-pagi-untuk-kesehatan-mental-dan-fisik-69?srsltid=AfmBOoqI5pf7xf0zpxIqj-1axLTPERyv8xaBd4CNr_TzZenxesesx_yD"
        },
        {
            id: 2,
            title: "Angkat Beban",
            type: "strength",
            duration: "45 menit",
            difficulty: "Menengah",
            description: "Latihan beban membantu membangun massa otot dan kekuatan.",
            image: "url('../../../assets/Image_Olahraga/weightlifting.jpeg')",
            url: "https://id.wikihow.com/Memilih-Berat-Barbel-yang-Tepat"
        },
        {
            id: 3,
            title: "Yoga",
            type: "flexibility",
            duration: "60 menit",
            difficulty: "Semua Level",
            description: "Yoga meningkatkan fleksibilitas, keseimbangan, dan ketenangan pikiran.",
            image: "url('../../../assets/Image_Olahraga/yoga.jpeg')",
            url: "https://nirvana.co.id/id/nys/article/yoga-untuk-relaksasi-7-pose-yang-patut-dicoba"
        },
        {
            id: 4,
            title: "Bersepeda",
            type: "cardio",
            duration: "45 menit",
            difficulty: "Pemula",
            description: "Bersepeda adalah cara yang menyenangkan untuk membakar kalori.",
            image: "url('../../../assets/Image_Olahraga/cycling.jpeg')",
            url: "https://cyclopedia.id/id/blog/cyclopedia-journal-1/post/tips-bersepeda-agar-aman-untuk-pemula-33?srsltid=AfmBOoqT6cIdkTCTe3aDHnOGcTtuTX20Xp_J6Jwp-tkSyvk7BVoagDco"
        }
    ];

    // Calculate BMI
    function calculateBMI() {
        const height = parseFloat(heightInput.value) / 100; // Convert cm to m
        const weight = parseFloat(weightInput.value);
        
        if (isNaN(height) || isNaN(weight) || height <= 0 || weight <= 0) {
            alert('Masukkan tinggi dan berat yang valid');
            return;
        }
        
        const bmi = weight / (height * height);
        const roundedBMI = bmi.toFixed(1);
        
        bmiScore.textContent = roundedBMI;
        updateBMICategory(bmi);
        updateBMIChart(bmi);
    }

    // Update BMI Category
    function updateBMICategory(bmi) {
        let category, categoryClass;
        
        if (bmi < 18.5) {
            category = "Underweight (Kekurangan berat badan)";
            categoryClass = "underweight";
        } else if (bmi < 25) {
            category = "Normal (Berat badan sehat)";
            categoryClass = "normal";
        } else if (bmi < 30) {
            category = "Overweight (Kelebihan berat badan)";
            categoryClass = "overweight";
        } else {
            category = "Obese (Obesitas)";
            categoryClass = "obese";
        }
        
        bmiCategory.textContent = category;
        bmiCategory.className = "result-category " + categoryClass;
    }

    // Update BMI Chart Indicator
    function updateBMIChart(bmi) {
        let indicatorPosition;
        
        if (bmi < 18.5) {
            indicatorPosition = (bmi / 18.5) * 25;
        } else if (bmi < 25) {
            indicatorPosition = 25 + ((bmi - 18.5) / 6.5) * 25;
        } else if (bmi < 30) {
            indicatorPosition = 50 + ((bmi - 25) / 5) * 25;
        } else {
            indicatorPosition = 75 + ((Math.min(bmi, 40) - 30) / 10 * 25);
        }
        
        indicatorPosition = Math.max(0, Math.min(100, indicatorPosition));
        bmiIndicator.style.left = `${indicatorPosition}%`;
    }

    // Render Exercises
    function renderExercises(filter = 'all') {
        exerciseGrid.innerHTML = '';
        
        const filteredExercises = filter === 'all' 
            ? exercises 
            : exercises.filter(ex => ex.type === filter);
        
        if (filteredExercises.length === 0) {
            exerciseGrid.innerHTML = '<p class="no-exercises">Tidak ada olahraga yang ditemukan</p>';
            return;
        }
        
        filteredExercises.forEach(exercise => {
            const exerciseCard = createExerciseCard(exercise);
            exerciseGrid.appendChild(exerciseCard);
        });
    }

    // Create Exercise Card
    function createExerciseCard(exercise) {
        const exerciseCard = document.createElement('div');
        exerciseCard.className = 'exercise-card';
        
        exerciseCard.innerHTML = `
            <div class="exercise-img" style="background-image: ${exercise.image}"></div>
            <div class="exercise-content">
                <h3>${exercise.title}</h3>
                <div class="exercise-meta">
                    <span>${exercise.duration}</span>
                    <span>${exercise.difficulty}</span>
                </div>
                <div class="exercise-type ${exercise.type}">
                    ${exercise.type.charAt(0).toUpperCase() + exercise.type.slice(1)}
                </div>
                <p>${exercise.description}</p>
                <div class="exercise-link-container">
                    <a href="${exercise.url}" class="exercise-link" target="_blank">Lihat Info</a>
                </div>
            </div>
        `;
        
        // Menambahkan event listener pada gambar
        const exerciseImg = exerciseCard.querySelector('.exercise-img');
        exerciseImg.style.cursor = 'pointer'; // Mengubah cursor saat hover pada gambar
        exerciseImg.addEventListener('click', function() {
            window.open(exercise.url, '_blank');
        });
        
        return exerciseCard;
    }

    // Event Listeners
    function initEventListeners() {
        calculateBtn.addEventListener('click', calculateBMI);
        
        [heightInput, weightInput].forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') calculateBMI();
            });
        });
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                renderExercises(this.dataset.type);
            });
        });
    }

    // Initialize
    function init() {
        initEventListeners();
        renderExercises();
    }

    init();
});