<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Pay | SuperSpeed Net</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-base: #030712;
            --primary: #0ea5e9;
            --neon-cyan: #00e5ff;
            --glass-bg: rgba(255,255,255,0.03);
            --glass-border: rgba(255,255,255,0.08);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
        }
        body {
            margin: 0; padding: 0;
            background-color: var(--bg-base);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            display: flex; align-items: center; justify-content: center;
            min-height: 100vh;
        }
        .qp-container {
            width: 100%; max-width: 440px; padding: 20px;
        }
        .qp-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            text-align: center;
        }
        .qp-logo {
            width: 70px; height: 70px;
            border-radius: 16px; margin-bottom: 20px;
            filter: drop-shadow(0 0 15px rgba(0,229,255,0.5));
        }
        h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 28px; font-weight: 800; margin: 0 0 10px;
        }
        p { color: var(--text-secondary); margin-bottom: 30px; font-size: 15px; }
        
        .form-group { text-align: left; margin-bottom: 24px; }
        label { display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px; color: var(--text-secondary); }
        input {
            width: 100%; padding: 14px 16px;
            background: rgba(0,0,0,0.2); border: 1px solid var(--glass-border);
            border-radius: 12px; color: #fff; font-size: 16px;
            outline: none; transition: border 0.3s;
            box-sizing: border-box;
        }
        input:focus { border-color: var(--primary); }
        
        .btn-pay {
            width: 100%; padding: 16px; border: none;
            background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
            color: #fff; font-size: 16px; font-weight: 600;
            border-radius: 12px; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 24px rgba(14,165,233,0.3);
        }
        .btn-pay:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(14,165,233,0.5); }
        
        .alert {
            padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;
        }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }
        
        .back-link {
            display: inline-block; margin-top: 24px; color: var(--text-secondary);
            text-decoration: none; font-size: 14px; transition: color 0.2s;
        }
        .back-link:hover { color: #fff; }
    </style>
</head>
<body>

<div class="qp-container">
    <div class="qp-card">
        <img src="/images/logo.png" alt="Logo" class="qp-logo">
        <h1>Quick Pay</h1>
        <p>Enter your registered phone number to find your pending bill.</p>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('quick-pay.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="phone">Registered Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="e.g. 017XXXXXXXX" required>
            </div>
            <button type="submit" class="btn-pay">Find & Pay Bill ⚡</button>
        </form>
        
        <a href="/" class="back-link">← Back to Home</a>
    </div>
</div>

</body>
</html>
