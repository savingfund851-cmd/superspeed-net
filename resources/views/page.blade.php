<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SuperSpeed Net — Bangladesh's fastest dedicated fiber internet. BTRC approved packages from ৳500/month.">
    <title>SuperSpeed Net — Lightning Fast Fiber Internet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ═══════════════════════════════════════════
           CSS CUSTOM PROPERTIES
           ═══════════════════════════════════════════ */
        :root {
            --primary: #0ea5e9;
            --primary-light: #38bdf8;
            --primary-dark: #0284c7;
            --accent: #06b6d4;
            --accent2: #6366f1;
            --accent3: #8b5cf6;
            --neon-cyan: #22d3ee;
            --neon-blue: #3b82f6;
            --bg-deep: #020817;
            --bg-surface: rgba(255,255,255,0.03);
            --glass-bg: rgba(255,255,255,0.06);
            --glass-border: rgba(255,255,255,0.1);
            --glass-highlight: rgba(255,255,255,0.15);
            --text-primary: #f0f9ff;
            --text-secondary: #94a3b8;
            --text-tertiary: #64748b;
            --success: #10b981;
            --radius: 20px;
            --radius-sm: 12px;
            --radius-xs: 8px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg-deep);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 2; }

        /* ═══════════════════════════════════════════
           ANIMATED BACKGROUND — MESH GRADIENT + PARTICLES
           ═══════════════════════════════════════════ */
        .bg-scene { position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; }

        .mesh-gradient {
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(14,165,233,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 30%, rgba(99,102,241,0.10) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 80%, rgba(6,182,212,0.08) 0%, transparent 50%),
                radial-gradient(ellipse 90% 70% at 60% 50%, rgba(139,92,246,0.06) 0%, transparent 60%);
            animation: meshShift 12s ease-in-out infinite alternate;
        }
        @keyframes meshShift {
            0% { filter: hue-rotate(0deg); transform: scale(1); }
            50% { filter: hue-rotate(15deg); transform: scale(1.02); }
            100% { filter: hue-rotate(-10deg); transform: scale(1); }
        }

        .grid-overlay {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(14,165,233,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14,165,233,0.035) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(ellipse 80% 70% at 50% 30%, black 20%, transparent 70%);
            animation: gridFloat 30s linear infinite;
        }
        @keyframes gridFloat { 0% { transform: translateY(0); } 100% { transform: translateY(80px); } }

        /* Floating Orbs */
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(80px); opacity: 0.5;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }
        .orb-1 { width: 500px; height: 500px; background: rgba(14,165,233,0.2); top: -10%; left: -5%; animation: orbFloat1 10s; }
        .orb-2 { width: 400px; height: 400px; background: rgba(99,102,241,0.15); top: 30%; right: -8%; animation: orbFloat2 14s; }
        .orb-3 { width: 350px; height: 350px; background: rgba(6,182,212,0.12); bottom: 10%; left: 15%; animation: orbFloat3 12s; }
        @keyframes orbFloat1 { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(40px,30px) scale(1.1)} }
        @keyframes orbFloat2 { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(-30px,40px) scale(0.9)} }
        @keyframes orbFloat3 { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(25px,-35px) scale(1.05)} }

        /* Particle Canvas */
        #particleCanvas { position: absolute; inset: 0; z-index: 1; }

        /* ═══════════════════════════════════════════
           LIQUID GLASS NAVBAR (iPhone Style)
           ═══════════════════════════════════════════ */
        .glass-nav {
            position: fixed; top: 16px; left: 50%; transform: translateX(-50%);
            z-index: 9999;
            padding: 8px 8px;
            border-radius: 22px;
            display: flex; align-items: center; gap: 4px;
            max-width: 1600px; width: 95%;
            overflow: visible;
            /* Liquid Glass Layers */
            background:
                linear-gradient(135deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.04) 50%, rgba(255,255,255,0.08) 100%);
            border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(40px) saturate(180%) brightness(1.1);
            -webkit-backdrop-filter: blur(40px) saturate(180%) brightness(1.1);
            box-shadow:
                0 8px 32px rgba(0,0,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.15),
                inset 0 -1px 0 rgba(255,255,255,0.05),
                0 0 0 0.5px rgba(255,255,255,0.1);
            transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
        }
        .glass-nav::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 50%;
            background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, transparent 100%);
            border-radius: 22px 22px 0 0;
            pointer-events: none;
        }
        .glass-nav:hover {
            border-color: rgba(255,255,255,0.22);
            box-shadow:
                0 12px 40px rgba(0,0,0,0.35),
                inset 0 1px 0 rgba(255,255,255,0.2),
                inset 0 -1px 0 rgba(255,255,255,0.06),
                0 0 0 0.5px rgba(255,255,255,0.15),
                0 0 60px rgba(14,165,233,0.08);
        }

        .nav-logo-link {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; padding: 6px 12px;
            border-radius: 16px;
            transition: background 0.3s;
        }
        .nav-logo-link:hover { background: rgba(255,255,255,0.08); }
        .nav-logo-img { width: 36px; height: 36px; border-radius: 10px; object-fit: cover; }
        .nav-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px; font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.7) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        .nav-links-group {
            display: flex; align-items: center; gap: 4px; flex-wrap: wrap; justify-content: center;
            margin: 0 auto;
            position: static;
            overflow: visible;
        }
        /* Liquid glass active indicator */
        .nav-pill {
            position: absolute; height: 36px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
        }
        .nav-link {
            position: relative; z-index: 1;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 13px; font-weight: 500;
            transition: color 0.3s, transform 0.2s;
            white-space: nowrap;
        }
        .nav-link:hover, .nav-link.active { color: #fff; }
        .nav-link:active { transform: scale(0.96); }

        .nav-cta {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent2) 100%);
            color: #fff !important; font-size: 13px; font-weight: 600;
            text-decoration: none; white-space: nowrap;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 2px 12px rgba(14,165,233,0.3), inset 0 1px 0 rgba(255,255,255,0.2);
            transition: all 0.3s;
        }
        .nav-cta:hover {
            transform: translateY(-1px) scale(1.02);
            box-shadow: 0 4px 20px rgba(14,165,233,0.45), inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .nav-cta:active { transform: scale(0.97); }

        .nav-hamburger {
            display: none; background: none; border: none;
            color: rgba(255,255,255,0.7); font-size: 22px;
            padding: 6px 10px; cursor: pointer; border-radius: 10px;
            transition: background 0.2s;
            margin-left: auto;
        }
        .nav-hamburger:hover { background: rgba(255,255,255,0.08); color: #fff; }

        /* Liquid Glass Dropdown */
        .nav-item-dropdown { position: relative; }
        .nav-dropdown {
            position: absolute; top: 120%; left: 50%; transform: translateX(-50%) translateY(10px);
            background: linear-gradient(135deg, rgba(10,20,40,0.85) 0%, rgba(20,30,50,0.85) 100%);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px; padding: 8px; min-width: 220px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.05);
            opacity: 0; visibility: hidden; pointer-events: none;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            z-index: 10000;
        }
        .nav-item-dropdown:hover .nav-dropdown,
        .nav-item-dropdown:focus-within .nav-dropdown {
            opacity: 1; visibility: visible; pointer-events: auto; transform: translateX(-50%) translateY(0);
        }
        .nav-dropdown a {
            display: block; padding: 10px 16px; color: rgba(255,255,255,0.7);
            text-decoration: none; font-size: 13px; font-weight: 500;
            border-radius: 10px; transition: all 0.2s;
        }
        .nav-dropdown a:hover { background: rgba(255,255,255,0.1); color: #fff; transform: translateX(3px); }

        /* ═══════════════════════════════════════════
           HERO SECTION
           ═══════════════════════════════════════════ */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 140px 24px 100px;
            text-align: center;
            position: relative;
        }
        .hero-content { max-width: 800px; margin: 0 auto; }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 7px 18px; border-radius: 100px;
            background: rgba(14,165,233,0.1);
            border: 1px solid rgba(14,165,233,0.25);
            color: var(--neon-cyan); font-size: 12px; font-weight: 700;
            letter-spacing: 1px; text-transform: uppercase;
            margin-bottom: 32px;
            animation: slideInUp 0.7s ease both;
        }
        .hero-badge .live-dot {
            width: 6px; height: 6px; background: var(--neon-cyan);
            border-radius: 50%; animation: livePulse 1.5s ease-in-out infinite;
            box-shadow: 0 0 8px var(--neon-cyan);
        }
        @keyframes livePulse { 0%,100%{opacity:1;box-shadow:0 0 8px var(--neon-cyan)} 50%{opacity:0.4;box-shadow:0 0 16px var(--neon-cyan)} }

        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(44px, 7.5vw, 88px);
            font-weight: 800;
            line-height: 1.05;
            margin-bottom: 24px;
            letter-spacing: -2px;
            animation: slideInUp 0.8s ease 0.1s both;
        }
        .hero-gradient-text {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--neon-cyan) 25%, var(--accent2) 50%, var(--accent3) 75%, var(--primary-light) 100%);
            background-size: 300% 300%;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: gradientFlow 6s ease infinite;
        }
        @keyframes gradientFlow {
            0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%}
        }

        .hero-sub {
            font-size: clamp(16px, 2.5vw, 20px);
            color: var(--text-secondary);
            max-width: 560px; margin: 0 auto 44px;
            line-height: 1.7;
            animation: slideInUp 0.8s ease 0.2s both;
        }

        .hero-buttons {
            display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;
            animation: slideInUp 0.8s ease 0.3s both;
        }
        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 16px 36px; border-radius: 16px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent2) 100%);
            color: #fff; font-size: 16px; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 4px 30px rgba(14,165,233,0.35), inset 0 1px 0 rgba(255,255,255,0.2);
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .btn-hero-primary:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 8px 40px rgba(14,165,233,0.5), inset 0 1px 0 rgba(255,255,255,0.3); }
        .btn-hero-primary:active { transform: scale(0.97); }

        .btn-hero-glass {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 16px 36px; border-radius: 16px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(12px);
            color: var(--text-primary); font-size: 16px; font-weight: 600;
            text-decoration: none;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
            transition: all 0.3s;
        }
        .btn-hero-glass:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); transform: translateY(-2px); }

        /* Speed Counter */
        .speed-display {
            margin-top: 64px; animation: slideInUp 0.8s ease 0.45s both;
        }
        .speed-ring {
            width: 160px; height: 160px; margin: 0 auto 16px;
            border-radius: 50%;
            background: conic-gradient(var(--primary) 0deg, var(--accent) 120deg, var(--accent2) 240deg, var(--primary) 360deg);
            padding: 4px; position: relative;
            animation: speedRingSpin 8s linear infinite;
        }
        @keyframes speedRingSpin { 0%{transform:rotate(0)} 100%{transform:rotate(360deg)} }
        .speed-ring-inner {
            width: 100%; height: 100%; border-radius: 50%;
            background: var(--bg-deep);
            display: flex; align-items: center; justify-content: center;
            flex-direction: column;
        }
        .speed-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 42px; font-weight: 800; line-height: 1;
            background: linear-gradient(135deg, var(--primary-light), var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .speed-unit { font-size: 12px; color: var(--text-secondary); font-weight: 600; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }

        /* ═══════════════════════════════════════════
           STATS TICKER
           ═══════════════════════════════════════════ */
        .stats-ticker {
            padding: 56px 0;
            background: rgba(255,255,255,0.015);
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px; text-align: center; }
        .stat-block {}
        .stat-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 44px; font-weight: 800; line-height: 1;
            background: linear-gradient(135deg, var(--primary-light), var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .stat-lbl { font-size: 13px; color: var(--text-tertiary); margin-top: 8px; font-weight: 500; letter-spacing: 0.5px; }

        /* ═══════════════════════════════════════════
           SECTION GENERIC
           ═══════════════════════════════════════════ */
        .section { padding: 120px 0; position: relative; z-index: 2; }
        .section-head { text-align: center; margin-bottom: 72px; }
        .section-chip {
            display: inline-block;
            padding: 5px 16px; border-radius: 100px;
            background: rgba(14,165,233,0.08);
            border: 1px solid rgba(14,165,233,0.2);
            color: var(--neon-cyan); font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 2px;
            margin-bottom: 20px;
        }
        .section-head h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(32px, 5vw, 52px);
            font-weight: 800; line-height: 1.15;
            letter-spacing: -1px;
        }
        .section-head p { font-size: 17px; color: var(--text-secondary); max-width: 520px; margin: 14px auto 0; line-height: 1.7; }

        /* ═══════════════════════════════════════════
           PACKAGES SECTION
           ═══════════════════════════════════════════ */
        .pkg-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }

        .pkg-card {
            position: relative; overflow: hidden;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 24px;
            padding: 36px 28px 28px;
            transition: all 0.45s cubic-bezier(0.4,0,0.2,1);
        }
        .pkg-card::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at 30% 0%, rgba(14,165,233,0.08), transparent 60%);
            opacity: 0; transition: opacity 0.45s;
            border-radius: 24px;
        }
        .pkg-card::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            opacity: 0; transition: opacity 0.45s;
        }
        .pkg-card:hover {
            transform: translateY(-8px);
            border-color: rgba(14,165,233,0.3);
            box-shadow: 0 24px 60px rgba(14,165,233,0.1), 0 0 80px rgba(14,165,233,0.04);
        }
        .pkg-card:hover::before, .pkg-card:hover::after { opacity: 1; }

        .pkg-card.featured {
            background: linear-gradient(135deg, rgba(14,165,233,0.08) 0%, rgba(99,102,241,0.06) 100%);
            border-color: rgba(14,165,233,0.3);
            box-shadow: 0 0 40px rgba(14,165,233,0.06);
        }
        .pkg-featured-tag {
            position: absolute; top: 18px; right: 18px;
            padding: 4px 12px; border-radius: 100px;
            background: linear-gradient(135deg, var(--primary), var(--accent2));
            font-size: 10px; font-weight: 800; color: #fff;
            letter-spacing: 0.5px; text-transform: uppercase;
            box-shadow: 0 2px 10px rgba(14,165,233,0.4);
        }
        .pkg-speed-tag { font-size: 11px; color: var(--neon-cyan); font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; }
        .pkg-title { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 700; margin-bottom: 8px; }
        .pkg-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 24px; min-height: 40px; }

        .pkg-price-row { display: flex; align-items: baseline; gap: 3px; margin-bottom: 6px; }
        .pkg-currency { font-size: 20px; font-weight: 700; color: var(--primary-light); }
        .pkg-amount {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 46px; font-weight: 800; line-height: 1;
            background: linear-gradient(135deg, var(--primary-light), var(--neon-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .pkg-period { font-size: 14px; color: var(--text-tertiary); }

        .pkg-btrc-ref {
            font-size: 10px; color: var(--text-tertiary);
            padding: 5px 10px; border-radius: 6px;
            background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border);
            margin-bottom: 24px; display: inline-block;
        }
        .pkg-btrc-ref span { color: var(--neon-cyan); font-weight: 600; }

        .pkg-features { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 28px; }
        .pkg-features li { display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--text-secondary); }
        .pkg-check {
            width: 18px; height: 18px; border-radius: 50%; flex-shrink: 0;
            background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.2);
            display: flex; align-items: center; justify-content: center;
        }
        .pkg-check::after { content: '✓'; font-size: 9px; color: var(--success); font-weight: 800; }

        .btn-pkg {
            width: 100%; padding: 13px; border-radius: 14px; border: none; cursor: pointer;
            font-size: 14px; font-weight: 700; text-decoration: none; display: block; text-align: center;
            background: rgba(14,165,233,0.08);
            color: var(--primary-light);
            border: 1px solid rgba(14,165,233,0.2);
            transition: all 0.3s;
        }
        .btn-pkg:hover { background: linear-gradient(135deg, var(--primary), var(--accent2)); color: #fff; border-color: transparent; transform: translateY(-2px); box-shadow: 0 6px 24px rgba(14,165,233,0.3); }
        .btn-pkg.featured-btn { background: linear-gradient(135deg, var(--primary), var(--accent2)); color: #fff; border-color: transparent; box-shadow: 0 4px 20px rgba(14,165,233,0.3); }

        /* ═══════════════════════════════════════════
           FEATURES SECTION
           ═══════════════════════════════════════════ */
        .features-bg { background: rgba(255,255,255,0.01); }
        .feat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .feat-card {
            padding: 40px 28px; border-radius: 24px;
            background: var(--bg-surface); border: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
            position: relative; overflow: hidden;
        }
        .feat-card::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }
        .feat-card:hover {
            transform: translateY(-6px);
            border-color: rgba(14,165,233,0.2);
            background: rgba(255,255,255,0.05);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        .feat-icon {
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, rgba(14,165,233,0.12), rgba(99,102,241,0.08));
            border: 1px solid rgba(14,165,233,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; margin-bottom: 24px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feat-card:hover .feat-icon { transform: scale(1.1) rotate(-5deg); box-shadow: 0 4px 20px rgba(14,165,233,0.15); }
        .feat-card h3 { font-family: 'Space Grotesk', sans-serif; font-size: 19px; font-weight: 700; margin-bottom: 10px; }
        .feat-card p { font-size: 14px; color: var(--text-secondary); line-height: 1.75; }

        /* ═══════════════════════════════════════════
           BTRC COMPLIANCE
           ═══════════════════════════════════════════ */
        .btrc-bar {
            padding: 80px 0;
            background: linear-gradient(135deg, rgba(14,165,233,0.04), rgba(99,102,241,0.03));
            border-top: 1px solid var(--glass-border); border-bottom: 1px solid var(--glass-border);
        }
        .btrc-box {
            display: flex; align-items: center; gap: 48px;
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            border-radius: 28px; padding: 48px;
            backdrop-filter: blur(12px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
        }
        .btrc-icon { font-size: 72px; flex-shrink: 0; filter: drop-shadow(0 0 20px rgba(14,165,233,0.3)); }
        .btrc-box h2 { font-family: 'Space Grotesk', sans-serif; font-size: 28px; font-weight: 800; margin-bottom: 12px; }
        .btrc-box p { color: var(--text-secondary); font-size: 15px; line-height: 1.7; margin-bottom: 20px; }
        .btrc-link { color: var(--neon-cyan); font-weight: 600; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; transition: gap 0.2s; }
        .btrc-link:hover { gap: 10px; }

        /* ═══════════════════════════════════════════
           CTA
           ═══════════════════════════════════════════ */
        .cta { text-align: center; }
        .cta-card {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(99,102,241,0.06));
            border: 1px solid rgba(14,165,233,0.2);
            border-radius: 32px; padding: 80px 48px;
        }
        .cta-card::before {
            content: ''; position: absolute; width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(14,165,233,0.12), transparent);
            top: -200px; right: -150px; border-radius: 50%;
            animation: ctaOrb 10s ease-in-out infinite alternate;
        }
        @keyframes ctaOrb { 0%{transform:scale(1) translate(0,0)} 100%{transform:scale(1.1) translate(-20px,20px)} }
        .cta-card h2 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(28px, 4vw, 44px); font-weight: 900; margin-bottom: 16px; letter-spacing: -1px; position: relative; }
        .cta-card p { color: var(--text-secondary); font-size: 17px; max-width: 480px; margin: 0 auto 40px; position: relative; }
        .cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; position: relative; }

        /* ═══════════════════════════════════════════
           FOOTER
           ═══════════════════════════════════════════ */
        footer { padding: 80px 0 32px; border-top: 1px solid var(--glass-border); background: rgba(0,0,0,0.25); }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
        .footer-brand-text { font-size: 14px; color: var(--text-secondary); line-height: 1.8; max-width: 260px; margin-top: 16px; }
        .footer-brand-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .footer-brand-logo img { width: 40px; height: 40px; border-radius: 10px; }
        .footer-brand-logo span { font-family: 'Space Grotesk', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-primary); }
        .footer-col h4 { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-tertiary); margin-bottom: 18px; }
        .footer-col a { display: block; color: var(--text-secondary); text-decoration: none; font-size: 14px; padding: 4px 0; transition: color 0.2s, transform 0.2s; }
        .footer-col a:hover { color: var(--neon-cyan); transform: translateX(3px); }
        .footer-bar { padding-top: 32px; border-top: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; }
        .footer-bar p { font-size: 12px; color: var(--text-tertiary); }
        .footer-bar strong { color: var(--neon-cyan); }
        .footer-address { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-top: 10px; }
        .footer-contact-info { margin-top: 10px; }
        .footer-contact-info a { display: block; color: var(--text-secondary); text-decoration: none; font-size: 13px; padding: 2px 0; transition: color 0.2s; }
        .footer-contact-info a:hover { color: var(--neon-cyan); }
        .footer-social { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }
        .social-btn {
            display: flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            color: var(--text-secondary); transition: all 0.25s; text-decoration: none;
            flex-shrink: 0;
        }
        .social-btn svg { width: 18px; height: 18px; }
        .social-btn:hover { background: rgba(14,165,233,0.15); border-color: rgba(14,165,233,0.3); color: var(--neon-cyan); transform: translateY(-2px); }
        .btrc-stamp {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 8px;
            background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.15);
            color: var(--success); font-size: 11px; font-weight: 700;
        }

        /* ═══════════════════════════════════════════
           ANIMATIONS
           ═══════════════════════════════════════════ */
        @keyframes slideInUp { from { opacity:0; transform:translateY(30px) } to { opacity:1; transform:translateY(0) } }

        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }
        .reveal-delay-5 { transition-delay: 0.5s; }

        /* ═══════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════ */
        @media (max-width: 1000px) {
            .nav-links-group { display: none; }
            .nav-links-group.open {
                display: flex; flex-direction: column;
                position: absolute; top: 60px; right: 8px;
                background: rgba(10,20,40,0.95);
                backdrop-filter: blur(30px);
                border: 1px solid rgba(255,255,255,0.12);
                border-radius: 18px; padding: 16px; gap: 8px; min-width: 240px;
                box-shadow: 0 16px 40px rgba(0,0,0,0.4);
            }
            .nav-pill { display: none; }
            .nav-hamburger { display: block; }
            
            /* Mobile Dropdown Fix */
            .nav-item-dropdown .nav-dropdown {
                position: relative; top: 0; left: 0; transform: none;
                width: 100%; min-width: unset;
                background: rgba(255,255,255,0.03);
                box-shadow: none; border: none; padding: 4px 12px;
                margin-top: 8px; display: none; opacity: 1; visibility: visible;
            }
            .nav-item-dropdown:hover .nav-dropdown,
            .nav-item-dropdown:active .nav-dropdown {
                display: block; pointer-events: auto; transform: none;
            }
            
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .feat-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .btrc-box { flex-direction: column; text-align: center; gap: 28px; }
        }
        @media (max-width: 600px) {
            .glass-nav { top: 10px; border-radius: 18px; }
            .pkg-grid { grid-template-columns: 1fr; }
            .feat-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .hero-buttons { flex-direction: column; align-items: center; }
            .cta-btns { flex-direction: column; align-items: center; }
            .cta-card { padding: 48px 24px; }
        }
    </style>
</head>
<body>

<!-- ═══ BACKGROUND SCENE ═══ -->
<div class="bg-scene">
    <div class="mesh-gradient"></div>
    <div class="grid-overlay"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <canvas id="particleCanvas"></canvas>
</div>

<!-- ═══ LIQUID GLASS NAVBAR ═══ -->
<nav class="glass-nav" id="glassNav">
    <a href="/" class="nav-logo-link">
        <img src="/images/logo.png" alt="SuperSpeed" class="nav-logo-img">
        <span class="nav-brand" style="font-family:'Space Grotesk',sans-serif;font-size:20px;font-weight:900;">SuperSpeed</span>
    </a>
    <div class="nav-links-group" id="navLinksGroup">
        <div class="nav-pill" id="navPill"></div>
        <!-- Menus will be injected here -->
    </div>
    <div style="display:flex;align-items:center;gap:16px;margin-left:auto;margin-right:16px;">
        <a href="{{ route('login') }}" class="nav-cta">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            {{ __('Login') }}
        </a>
        <div style="display:flex;align-items:center;gap:8px;">
            <a href="{{ route('lang.switch', 'en') }}" style="color: {{ app()->getLocale() === 'en' ? 'var(--neon-cyan)' : 'var(--text-secondary)' }}; font-weight:700; text-decoration:none; font-size:13px; font-family:'Space Grotesk',sans-serif;">EN</a>
            <span style="color:rgba(255,255,255,0.2);">|</span>
            <a href="{{ route('lang.switch', 'bn') }}" style="color: {{ app()->getLocale() === 'bn' ? 'var(--neon-cyan)' : 'var(--text-secondary)' }}; font-weight:700; text-decoration:none; font-size:13px; font-family:'Space Grotesk',sans-serif;">BN</a>
        </div>
    </div>
    <button class="nav-hamburger" id="navHamburger" aria-label="Menu">☰</button>
</nav>


<!-- ═══ PAGE CONTENT ═══ -->
<section class="page-content" style="padding: 160px 24px 100px; max-width: 900px; margin: 0 auto; color: white;">
    <h1 style="font-size: 48px; margin-bottom: 24px; font-family: 'Space Grotesk', sans-serif;">{{ $page->title }}</h1>
    <div class="prose prose-invert prose-lg" style="color: rgba(255,255,255,0.8); line-height: 1.8;">
        {!! $page->content !!}
    </div>
</section>
<!-- ═══ FOOTER ═══ -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand-col">
                <a href="/" class="footer-brand-logo"><img src="/images/logo.png" alt="{{ $settings['site_name'] }}"><span>{{ $settings['site_name'] }}</span></a>
                <p class="footer-brand-text">{{ $settings['footer_brand_text'] }}</p>
                @if($settings['site_address'])
                <p class="footer-address">📍 {{ $settings['site_address'] }}</p>
                @endif
                <p class="footer-contact-info">
                    <a href="tel:{{ $settings['site_phone'] }}">📞 {{ $settings['site_phone'] }}</a><br>
                    <a href="mailto:{{ $settings['site_email'] }}">✉️ {{ $settings['site_email'] }}</a>
                </p>
                <!-- Social Media Icons -->
                <div class="footer-social">
                    @if($settings['social_facebook'])<a href="{{ $settings['social_facebook'] }}" target="_blank" class="social-btn" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>@endif
                    @if($settings['social_youtube'])<a href="{{ $settings['social_youtube'] }}" target="_blank" class="social-btn" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>@endif
                    @if($settings['social_whatsapp'])<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['social_whatsapp']) }}" target="_blank" class="social-btn" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>@endif
                </div>
            </div>
            <div class="footer-col"><h4>{{ __('Packages') }}</h4><a href="/#packages">Starter 5 Mbps</a><a href="/#packages">Home 10 Mbps</a><a href="/#packages">Power 20 Mbps</a><a href="/#packages">Business 50 Mbps</a><a href="/#packages">Enterprise 100 Mbps</a></div>
            <div class="footer-col"><h4>{{ __('Company') }}</h4><a href="/">{{ __('About Us') }}</a><a href="/">{{ __('Coverage') }}</a><a href="/#contact">{{ __('Contact') }}</a><a href="/support">{{ __('Support Ticket') }}</a></div>
            <div class="footer-col"><h4>{{ __('Legal') }}</h4><a href="{{ $settings['btrc_link_url'] }}" target="_blank">{{ __('BTRC Tariff Matrix') }}</a><a href="#">{{ __('Privacy Policy') }}</a><a href="#">{{ __('Terms of Service') }}</a><a href="#">{{ __('SLA Agreement') }}</a></div>
        </div>
        <div class="footer-bar">
            <p>{{ $settings['footer_copy'] }} &nbsp;|&nbsp; {{ __('Developed by') }} <strong>{{ $settings['developer_name'] }}</strong></p>
            <div class="btrc-stamp">✅ {{ __('BTRC Licensed ISP') }}</div>
        </div>
    </div>
</footer>

<!-- ═══ JAVASCRIPT ═══ -->
<script>
// ─── PARTICLES ───
(function(){
    const c = document.getElementById('particleCanvas');
    const ctx = c.getContext('2d');
    let w, h, particles = [];
    function resize(){ w = c.width = window.innerWidth; h = c.height = window.innerHeight; }
    window.addEventListener('resize', resize); resize();
    class Particle {
        constructor(){ this.reset(); }
        reset(){
            this.x = Math.random()*w; this.y = Math.random()*h;
            this.vx = (Math.random()-0.5)*0.3; this.vy = (Math.random()-0.5)*0.3;
            this.r = Math.random()*1.5+0.5;
            this.alpha = Math.random()*0.4+0.1;
        }
        update(){
            this.x += this.vx; this.y += this.vy;
            if(this.x<0||this.x>w||this.y<0||this.y>h) this.reset();
        }
        draw(){
            ctx.beginPath(); ctx.arc(this.x,this.y,this.r,0,Math.PI*2);
            ctx.fillStyle=`rgba(14,165,233,${this.alpha})`; ctx.fill();
        }
    }
    for(let i=0;i<60;i++) particles.push(new Particle());
    function drawLines(){
        for(let i=0;i<particles.length;i++){
            for(let j=i+1;j<particles.length;j++){
                const dx=particles[i].x-particles[j].x,dy=particles[i].y-particles[j].y;
                const d=Math.sqrt(dx*dx+dy*dy);
                if(d<150){
                    ctx.beginPath(); ctx.moveTo(particles[i].x,particles[i].y);
                    ctx.lineTo(particles[j].x,particles[j].y);
                    ctx.strokeStyle=`rgba(14,165,233,${0.06*(1-d/150)})`;
                    ctx.lineWidth=0.5; ctx.stroke();
                }
            }
        }
    }
    function animate(){
        ctx.clearRect(0,0,w,h);
        particles.forEach(p=>{p.update();p.draw()});
        drawLines();
        requestAnimationFrame(animate);
    }
    animate();
})();

// ─── LIQUID GLASS NAV PILL ───
(function(){
    const links = document.querySelectorAll('.nav-link');
    const pill = document.getElementById('navPill');
    function movePill(el){
        if(!el || window.innerWidth <= 900) return;
        pill.style.width = el.offsetWidth + 'px';
        pill.style.left = el.offsetLeft + 'px';
        pill.style.opacity = '1';
    }
    links.forEach(link => {
        link.addEventListener('mouseenter', () => movePill(link));
        link.addEventListener('click', () => {
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
            movePill(link);
        });
    });
    const group = document.getElementById('navLinksGroup');
    group.addEventListener('mouseleave', () => {
        const active = document.querySelector('.nav-link.active');
        if(active) movePill(active);
    });
    setTimeout(() => { const a = document.querySelector('.nav-link.active'); if(a) movePill(a); }, 100);

    // Hamburger
    document.getElementById('navHamburger').addEventListener('click', () => {
        group.classList.toggle('open');
    });
})();

// ─── SCROLL REVEAL ───
(function(){
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); obs.unobserve(e.target); }});
    }, {threshold: 0.1});
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
})();

// ─── COUNTER ANIMATION ───
// (Removed from page.blade.php as elements do not exist here)

// ─── NAVBAR SCROLL ───
window.addEventListener('scroll',()=>{
    const nav = document.getElementById('glassNav');
    if(window.scrollY>80){
        nav.style.background = 'linear-gradient(135deg, rgba(2,8,23,0.8) 0%, rgba(2,8,23,0.7) 100%)';
        nav.style.boxShadow = '0 12px 40px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.1), 0 0 0 0.5px rgba(255,255,255,0.08)';
    } else {
        nav.style.background = '';
        nav.style.boxShadow = '';
    }
});

// ─── MENUS ───
async function loadMenus() {
    try {
        const r = await fetch('/api/menus?t=' + Date.now());
        const menus = await r.json();
        
        const currentPath = window.location.pathname;
        let hideNavbar = false;
        
        // Check if current URL is in menus with hide_navbar = true
        for (let i = 0; i < menus.length; i++) {
            if ((menus[i].url === currentPath || menus[i].url === currentPath.substring(1)) && menus[i].hide_navbar) {
                hideNavbar = true;
                break;
            }
        }
        
        if (hideNavbar) {
            const nav = document.getElementById('glassNav');
            const overlay = document.getElementById('mobileOverlay');
            const sidebar = document.getElementById('mobileSidebar');
            if(nav) nav.style.display = 'none';
            if(overlay) overlay.style.display = 'none';
            if(sidebar) sidebar.style.display = 'none';
            // We can return early to skip rendering menus
            return;
        }
        
        const group = document.getElementById('navLinksGroup');
        
        let html = '';
        let buttonHtml = '';
        
        // Translation map for common menu items
        const trans = {
            'Home': '{{ __("Home") }}',
            'Packages': '{{ __("Packages") }}',
            'Quick Pay': '{{ __("Quick Pay") }}',
            'Support': '{{ __("Support") }}',
            'Dashboard': '{{ __("Dashboard") }}',
            'Login': '{{ __("Login") }}',
            'Our Service': '{{ __("Our Service") }}',
            'Internet Connectivity': '{{ __("Internet Connectivity") }}',
            'Data Connectivity': '{{ __("Data Connectivity") }}',
            'WAN': '{{ __("WAN") }}',
            'Email Hosting Service': '{{ __("Email Hosting Service") }}',
            'Our Offerings': '{{ __("Our Offerings") }}',
            'CCTV & IP Surveillance': '{{ __("CCTV & IP Surveillance") }}',
            'Corporate IP-VPN services': '{{ __("Corporate IP-VPN services") }}',
            'Bill Payment': '{{ __("Bill Payment") }}',
            'Contact': '{{ __("Contact") }}',
            'About Us': '{{ __("About Us") }}',
            'SuperSpeed Network APP': '{{ __("SuperSpeed Network APP") }}',
            'BTRC Tariff': '{{ __("BTRC Tariff") }}',
            'New Connection': '{{ __("New Connection") }}',
            'quick pay': '{{ __("quick pay") }}'
        };

        menus.forEach((menu, index) => {
            let mName = trans[menu.name] || menu.name;
            if (menu.is_button) {
                buttonHtml += `<a href="${menu.url || '#'}" class="btn-quick-pay" style="margin-left: 10px;">${mName} ⚡</a>`;
                return;
            }
            if (menu.children && menu.children.length > 0) {
                html += `
                <div class="nav-item-dropdown">
                    <a href="${menu.url || '#'}" class="nav-link" data-index="${index}">${mName} ▾</a>
                    <div class="nav-dropdown">
                        ${menu.children.map(child => {
                            let cName = trans[child.name] || child.name;
                            return `<a href="${child.url || '#'}">${cName}</a>`;
                        }).join('')}
                    </div>
                </div>`;
            } else {
                html += `<a href="${menu.url || '#'}" class="nav-link" data-index="${index}">${mName}</a>`;
            }
        });
        
        group.innerHTML = html + buttonHtml;
        
    } catch(e) {
        console.error("Failed to load menus", e);
    }
}

// ─── INIT ───
document.addEventListener('DOMContentLoaded', () => {
    
    loadMenus();
});
</script>


</body>
</html>
