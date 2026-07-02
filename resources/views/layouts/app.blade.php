<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Portal — SuperSpeed Net</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{
            --bg:#060d1a;--bg2:#0d1628;--card:rgba(255,255,255,0.04);
            --border:rgba(255,255,255,0.08);--primary:#0ea5e9;--cyan:#22d3ee;
            --text:#e2e8f0;--text2:#94a3b8;--text3:#64748b;
            --success:#10b981;--warning:#f59e0b;--danger:#ef4444;
            --sidebar-w:260px;
        }
        html,body{height:100%;}
        body{background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;display:flex;min-height:100vh;}

        /* ── Ambient glow ── */
        body::before{content:'';position:fixed;inset:0;pointer-events:none;
            background:radial-gradient(ellipse at 10% 30%,rgba(14,165,233,0.06),transparent 55%),
                        radial-gradient(ellipse at 90% 70%,rgba(34,211,238,0.04),transparent 50%);}

        /* ── Sidebar ── */
        .sidebar{
            width:var(--sidebar-w);min-height:100vh;position:fixed;top:0;left:0;z-index:50;
            background:rgba(6,13,26,0.95);border-right:1px solid var(--border);
            backdrop-filter:blur(20px);display:flex;flex-direction:column;
            transition:transform 0.3s;
        }
        .sidebar-logo{padding:24px 20px 20px;border-bottom:1px solid var(--border);}
        .sidebar-logo a{display:flex;align-items:center;gap:10px;text-decoration:none;}
        .sidebar-logo img{width:38px;height:38px;border-radius:10px;box-shadow:0 0 16px rgba(14,165,233,0.25);}
        .sidebar-logo span{font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700;color:var(--text);}

        /* User card in sidebar */
        .sidebar-user{padding:16px 20px;border-bottom:1px solid var(--border);}
        .user-avatar{
            width:48px;height:48px;border-radius:50%;
            background:linear-gradient(135deg,var(--primary),var(--cyan));
            display:flex;align-items:center;justify-content:center;
            font-size:20px;font-weight:800;color:#fff;margin-bottom:10px;
            box-shadow:0 0 20px rgba(14,165,233,0.3);
        }
        .user-name{font-weight:700;font-size:15px;color:var(--text);}
        .user-email{font-size:12px;color:var(--text3);margin-top:2px;word-break:break-all;}
        .user-badge{
            display:inline-flex;align-items:center;gap:4px;margin-top:6px;
            padding:3px 10px;border-radius:100px;font-size:10px;font-weight:700;text-transform:uppercase;
            background:rgba(14,165,233,0.1);border:1px solid rgba(14,165,233,0.2);color:var(--primary);
        }

        /* Nav items */
        .sidebar-nav{flex:1;padding:16px 12px;display:flex;flex-direction:column;overflow-y:auto;}
        .sidebar-footer{padding:12px;border-top:1px solid var(--border);}
        .btn-signout{display:flex;align-items:center;gap:10px;width:100%;padding:11px 12px;border-radius:10px;background:transparent;border:1px solid rgba(239,68,68,0.15);color:rgba(239,68,68,0.7);font-size:14px;font-weight:500;cursor:pointer;transition:all 0.2s;text-align:left;}
        .btn-signout:hover{background:rgba(239,68,68,0.08);border-color:rgba(239,68,68,0.3);color:var(--danger);}
        .nav-label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--text3);padding:8px 8px 4px;}
        .nav-item{
            display:flex;align-items:center;gap:12px;padding:11px 12px;border-radius:10px;
            text-decoration:none;color:var(--text2);font-size:14px;font-weight:500;
            transition:all 0.2s;margin-bottom:2px;
        }
        .nav-item:hover{background:rgba(255,255,255,0.05);color:var(--text);}
        .nav-item.active{background:rgba(14,165,233,0.1);color:var(--cyan);border:1px solid rgba(14,165,233,0.15);}
        .nav-item .icon{font-size:16px;width:20px;text-align:center;}

        /* Logout */
        .sidebar-footer{padding:12px;border-top:1px solid var(--border);}
        .btn-logout{
            display:flex;align-items:center;gap:10px;width:100%;padding:11px 12px;
            border-radius:10px;background:transparent;border:1px solid rgba(239,68,68,0.15);
            color:rgba(239,68,68,0.7);font-size:14px;font-weight:500;cursor:pointer;
            text-decoration:none;transition:all 0.2s;
        }
        .btn-logout:hover{background:rgba(239,68,68,0.08);border-color:rgba(239,68,68,0.3);color:var(--danger);}

        /* ── Main content ── */
        .main{margin-left:var(--sidebar-w);flex:1;min-height:100vh;display:flex;flex-direction:column;}
        .topbar{
            background:rgba(6,13,26,0.8);border-bottom:1px solid var(--border);
            backdrop-filter:blur(20px);position:sticky;top:0;z-index:40;
            padding:0 32px;height:60px;display:flex;align-items:center;justify-content:space-between;
        }
        .topbar-title{font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:700;color:var(--text);}
        .topbar-right{display:flex;align-items:center;gap:12px;}
        .topbar-chip{
            padding:5px 14px;border-radius:100px;font-size:12px;font-weight:600;
            background:rgba(14,165,233,0.08);border:1px solid rgba(14,165,233,0.15);color:var(--primary);
        }

        .page-content{padding:32px;flex:1;}

        /* ── Mobile toggle ── */
        .mobile-toggle{display:none;position:fixed;top:14px;left:14px;z-index:100;
            background:rgba(14,165,233,0.9);border:none;border-radius:8px;padding:8px;cursor:pointer;color:#fff;}
        @media(max-width:768px){
            .sidebar{transform:translateX(-100%);}
            .sidebar.open{transform:translateX(0);}
            .main{margin-left:0;}
            .mobile-toggle{display:flex;}
            .page-content{padding:20px;}
        }
    </style>
</head>
<body>
    <!-- Mobile toggle -->
    <button class="mobile-toggle" onclick="document.querySelector('.sidebar').classList.toggle('open')" aria-label="Menu">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <span>SuperSpeed Net</span>
            </a>
        </div>

        <!-- User Info -->
        <div class="sidebar-user">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-email">{{ Auth::user()->email }}</div>
            <div class="user-badge">🟢 Customer</div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
            <div class="nav-label">{{ __('Main Menu') }}</div>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="icon">🏠</span> {{ __('Dashboard') }}
            </a>
            <a href="{{ route('support.index') }}" class="nav-item {{ request()->routeIs('support.*') ? 'active' : '' }}">
                <span class="icon">🎫</span> {{ __('Support Tickets') }}
            </a>
            <a href="{{ route('support.create') }}" class="nav-item">
                <span class="icon">➕</span> {{ __('New Ticket') }}
            </a>

            <div class="nav-label" style="margin-top:12px;">{{ __('Account') }}</div>
            <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span class="icon">👤</span> {{ __('My Profile') }}
            </a>
            <a href="{{ route('quick-pay') }}" class="nav-item">
                <span class="icon">💳</span> {{ __('Quick Pay') }}
            </a>
        </nav>

        <!-- Signout at bottom -->
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-signout">
                    <span>🚪</span> {{ __('Signout') }}
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main">
        <div class="topbar">
            <div class="topbar-title">
                @isset($header){{ $header }}@else {{ __('Customer Portal') }} @endisset
            </div>
            <div class="topbar-right">
                <!-- Language Switcher -->
                <div style="display:flex;align-items:center;gap:6px;margin-right:8px;background:rgba(255,255,255,0.05);padding:4px 8px;border-radius:8px;border:1px solid var(--border);">
                    <a href="{{ route('lang.switch', 'en') }}" style="color: {{ app()->getLocale() === 'en' ? 'var(--cyan)' : 'var(--text3)' }}; font-weight:700; text-decoration:none; font-size:12px;">EN</a>
                    <span style="color:var(--text3);font-size:10px;">|</span>
                    <a href="{{ route('lang.switch', 'bn') }}" style="color: {{ app()->getLocale() === 'bn' ? 'var(--cyan)' : 'var(--text3)' }}; font-weight:700; text-decoration:none; font-size:12px;">BN</a>
                </div>

                <span class="topbar-chip">ID #{{ Auth::user()->id }}</span>
                @if(Auth::user()->phone)
                <span class="topbar-chip">📞 {{ Auth::user()->phone }}</span>
                @endif
            </div>
        </div>

        <div class="page-content">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
