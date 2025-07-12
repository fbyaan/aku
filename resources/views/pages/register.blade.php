<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLife | Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #4CAF50;
            --primary-dark: #388E3C;
            --secondary: #FF9800;
            --dark: #263238;
            --light: #f5f5f5;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light);
            display: flex;
            min-height: 100vh;
        }
        
        .container {
            display: flex;
            width: 100%;
        }
        
        .illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: white;
            display: none;
        }
        
        .illustration img {
            max-width: 80%;
            margin-bottom: 2rem;
        }
        
        .illustration h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .illustration p {
            text-align: center;
            opacity: 0.9;
        }
        
        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        
        .form-box {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo h1 {
            color: var(--primary);
            font-size: 2.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo h1 i {
            margin-right: 10px;
            color: var(--secondary);
        }
        
        .logo p {
            color: var(--dark);
            opacity: 0.7;
            margin-top: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }
        
        .form-group i {
            position: absolute;
            left: 1rem;
            top: 3.1rem;
            color: var(--primary);
        }
        
        .name-fields {
            display: flex;
            gap: 1rem;
        }
        
        .name-fields .form-group {
            flex: 1;
        }
        
        .password-strength {
            margin-top: 0.5rem;
            height: 5px;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            background: #f44336;
            transition: all 0.3s;
        }
        
        .password-requirements {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #757575;
        }
        
        .password-requirements ul {
            list-style-type: none;
            padding-left: 1rem;
        }
        
        .password-requirements li {
            margin-bottom: 0.3rem;
            position: relative;
        }
        
        .password-requirements li::before {
            content: "•";
            position: absolute;
            left: -1rem;
        }
        
        .terms {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .terms input {
            margin-right: 0.5rem;
            margin-top: 0.2rem;
        }
        
        .terms label {
            font-size: 0.9rem;
            color: var(--dark);
        }
        
        .terms a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .terms a:hover {
            text-decoration: underline;
        }
        
        .btn {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background: var(--primary-dark);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        @media (min-width: 992px) {
            .illustration {
                display: flex;
            }
        }
        
        @media (max-width: 576px) {
            .name-fields {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <img src="https://cdn-icons-png.flaticon.com/512/1830/1830839.png" alt="Fitness Illustration">
            <h2>Join FitLife Community</h2>
            <p>Start your fitness journey today and achieve your health goals with our support</p>
        </div>
        <div class="form-container">
            <div class="form-box">
                <div class="logo">
                    <h1><i class="fas fa-heartbeat"></i> FitLife</h1>
                    <p>Your personal fitness companion</p>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" placeholder="Nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <div class="password-strength">
                            <div class="strength-meter" id="strength-meter"></div>
                        </div>
                        <div class="password-requirements">
                            <p>Password must contain:</p>
                            <ul>
                                <li>At least 8 characters</li>
                                <li>One uppercase letter</li>
                                <li>One lowercase letter</li>
                                <li>One number</li>
                                <li>One special character</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                    </div>
                    <div class="terms">
                        <input type="checkbox" id="agree-terms" required>
                        <label for="agree-terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    <button type="submit" class="btn">Create Account</button>
                    <div class="login-link">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.getElementById('strength-meter');
        
        passwordInput.addEventListener('input', updateStrengthMeter);
        
        function updateStrengthMeter() {
            const password = passwordInput.value;
            let strength = 0;
            
            // Check for length
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            // Check for character types
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[a-z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Update meter
            const width = (strength / 6) * 100;
            strengthMeter.style.width = `${width}%`;
            
            // Update color
            if (strength <= 2) {
                strengthMeter.style.backgroundColor = '#f44336'; // Red
            } else if (strength <= 4) {
                strengthMeter.style.backgroundColor = '#FF9800'; // Orange
            } else {
                strengthMeter.style.backgroundColor = '#4CAF50'; // Green
            }
        }
    </script>
</body>
</html>