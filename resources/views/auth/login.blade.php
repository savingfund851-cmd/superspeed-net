<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — SuperSpeed Net</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{
            --bg:#060d1a;--card:rgba(255,255,255,0.045);--border:rgba(255,255,255,0.08);
            --primary:#0ea5e9;--cyan:#22d3ee;--text:#e2e8f0;--text2:#94a3b8;--text3:#64748b;
            --danger:#ef4444;--neon:rgba(14,165,233,0.15);
        }
        body{
            background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;
            min-height:100vh;display:flex;align-items:center;justify-content:center;
            position:relative;overflow:hidden;
        }
        /* Animated background */
        body::before{
            content:'';position:fixed;inset:0;
            background:radial-gradient(ellipse at 20% 50%,rgba(14,165,233,0.08) 0%,transparent 50%),
                        radial-gradient(ellipse at 80% 20%,rgba(34,211,238,0.06) 0%,transparent 50%),
                        radial-gradient(ellipse at 50% 80%,rgba(99,102,241,0.05) 0%,transparent 50%);
            pointer-events:none;
        }
        /* Floating orbs */
        .orb{position:fixed;border-radius:50%;filter:blur(80px);pointer-events:none;animation:float 8s ease-in-out infinite;}
        .orb1{width:350px;height:350px;background:rgba(14,165,233,0.07);top:-100px;left:-100px;animation-delay:0s;}
        .orb2{width:250px;height:250px;background:rgba(34,211,238,0.05);bottom:-80px;right:-80px;animation-delay:3s;}
        @keyframes float{0%,100%{transform:translateY(0) scale(1);}50%{transform:translateY(-20px) scale(1.05);}}

        .login-wrap{
            position:relative;z-index:10;width:100%;max-width:440px;padding:24px;
        }
        /* Brand */
        .brand{display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:40px;}
        .brand img{width:44px;height:44px;border-radius:12px;box-shadow:0 0 20px rgba(14,165,233,0.3);}
        .brand span{font-family:'Space Grotesk',sans-serif;font-size:22px;font-weight:700;color:var(--text);}

        .card{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;padding:40px;
            backdrop-filter:blur(20px);
            box-shadow:0 32px 80px rgba(0,0,0,0.4),0 0 0 1px rgba(255,255,255,0.04);
        }
        .card-title{font-family:'Space Grotesk',sans-serif;font-size:26px;font-weight:800;margin-bottom:4px;}
        .card-sub{color:var(--text2);font-size:14px;margin-bottom:32px;}

        .form-group{margin-bottom:20px;}
        .form-label{display:block;font-size:12px;font-weight:600;color:var(--text2);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;}
        .form-input{
            width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);
            border-radius:12px;padding:13px 16px;color:var(--text);font-family:'Inter',sans-serif;
            font-size:15px;outline:none;transition:all 0.2s;
        }
        .form-input:focus{border-color:rgba(14,165,233,0.5);background:rgba(14,165,233,0.05);box-shadow:0 0 0 4px rgba(14,165,233,0.08);}
        .form-input::placeholder{color:var(--text3);}
        .error-msg{color:var(--danger);font-size:12px;margin-top:6px;}
        .alert-error{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2);color:#fca5a5;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;}

        .check-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;}
        .check-label{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--text2);cursor:pointer;}
        .check-label input[type=checkbox]{accent-color:var(--primary);width:15px;height:15px;}
        .forgot{font-size:13px;color:var(--primary);text-decoration:none;transition:color 0.2s;}
        .forgot:hover{color:var(--cyan);}

        .btn-login{
            width:100%;padding:14px;border-radius:12px;border:none;cursor:pointer;
            background:linear-gradient(135deg,var(--primary) 0%,#0284c7 100%);
            color:#fff;font-family:'Inter',sans-serif;font-size:15px;font-weight:700;
            letter-spacing:0.3px;transition:all 0.25s;position:relative;overflow:hidden;
        }
        .btn-login::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(255,255,255,0.1),transparent);
            opacity:0;transition:opacity 0.25s;
        }
        .btn-login:hover{transform:translateY(-2px);box-shadow:0 12px 35px rgba(14,165,233,0.4);}
        .btn-login:hover::before{opacity:1;}
        .btn-login:active{transform:translateY(0);}

        .divider{text-align:center;margin-top:28px;color:var(--text3);font-size:13px;}
        .divider a{color:var(--primary);text-decoration:none;font-weight:600;}
        .divider a:hover{color:var(--cyan);}

        .back-link{display:flex;align-items:center;justify-content:center;gap:6px;margin-top:24px;color:var(--text3);font-size:13px;text-decoration:none;transition:color 0.2s;}
        .back-link:hover{color:var(--cyan);}
    </style>
</head>
<body>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <div class="login-wrap">
        <div style="position:absolute;top:20px;right:24px;display:flex;gap:10px;z-index:20;">
            <a href="{{ route('lang.switch', 'en') }}" style="color: {{ app()->getLocale() === 'en' ? 'var(--cyan)' : 'var(--text2)' }}; font-weight:700; text-decoration:none; font-size:13px;">EN</a>
            <span style="color:var(--border);">|</span>
            <a href="{{ route('lang.switch', 'bn') }}" style="color: {{ app()->getLocale() === 'bn' ? 'var(--cyan)' : 'var(--text2)' }}; font-weight:700; text-decoration:none; font-size:13px;">BN</a>
        </div>

        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>SuperSpeed Net</span>
        </div>

        <div class="card">
            <h1 class="card-title">{{ __('Welcome!') }}</h1>
            <p class="card-sub">{{ __('Login to your account') }}</p>

            {{-- Session Status --}}
            @if(session('status'))
            <div style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#6ee7b7;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;">
                {{ session('status') }}
            </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="login_id">{{ __('Login ID / Mobile') }}</label>
                    <input id="login_id" class="form-input" type="text" name="login_id"
                           value="{{ old('login_id') }}" required autofocus
                           placeholder="Enter your ID or Mobile number">
                    @error('login_id')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <input id="password" class="form-input" type="password" name="password"
                           required placeholder="••••••••">
                    @error('password')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="check-row" style="justify-content: flex-end;">
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">{{ __('Forgot password?') }}</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">🚀 {{ __('Login') }}</button>
            </form>

            <div class="divider" style="margin-top:20px;">
                {{ __('Need new connection?') }} <a href="{{ route('new-connection') }}">{{ __('Apply here') }}</a>
            </div>
        </div>

        <a href="/" class="back-link">← {{ __('Back to main site') }}</a>
    </div>
</body>
</html>
