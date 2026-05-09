<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>My Evaluation - Faculty Portal | NU Horizon LMS</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            corePlugins: { preflight: false }
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8F6F1;
            overflow-x: hidden;
        }

        :root {
            --navy: #0A1F44;
            --navy-mid: #1F3A6D;
            --navy-pale: #EEF3FB;
            --gold: #FFD70F;
            --gold-d: #C49A00;
            --bg-2: #F2EEE5;
            --txt-1: #0A1F44;
            --txt-2: #2C3E5C;
            --txt-3: #637089;
            --bdr: rgba(10,31,68,0.09);
            --card-shadow: 0 8px 20px rgba(10,31,68,0.05);
            --transition: all 0.25s ease;
            --danger-red: #dc2626;
            --danger-dark: #b91c1c;
            --spring: cubic-bezier(0.34,1.56,0.64,1);
        }

        .sidebar {
            background-color: var(--navy);
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 40;
            transition: transform 0.3s ease;
            transform: translateX(0);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 215, 15, 0.2);
            display: flex;
            align-items: center;
            gap: 0.82rem;
            min-height: 96px;
            overflow: visible;
        }

        .sidebar-logo-img {
            height: 45px;
            width: auto;
            flex-shrink: 0;
        }

        .logo-text {
            position: relative;
            min-width: 0;
            overflow: visible;
        }

        .logo-text h1 {
            font-family: 'Fraunces', serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: white;
            letter-spacing: -0.3px;
            line-height: 1.05;
            margin: 0;
            white-space: nowrap;
            overflow: visible;
        }

        .logo-text p {
            font-size: 0.55rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-top: 0.25rem;
        }

        .horizon-logo-wrap {
            position: relative;
            display: inline-block;
            margin-left: 0.05rem;
            color: var(--gold);
            overflow: visible;
        }

        .horizon-word {
            position: relative;
            display: inline-block;
            color: var(--gold);
            z-index: 2;
        }

        .sun-rays {
            position: absolute;
            left: 50%;
            top: -1.48rem;
            width: 108px;
            height: 36px;
            transform: translateX(-50%);
            pointer-events: none;
            z-index: 1;
            overflow: visible;
        }

        .sun-rays::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -2px;
            width: 62px;
            height: 18px;
            transform: translateX(-50%);
            background: radial-gradient(ellipse at center, rgba(255, 215, 15, 0.30), transparent 72%);
            border-radius: 999px;
        }

        .sun-rays .ray {
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 2px;
            border-radius: 999px;
            background: linear-gradient(
                to top,
                rgba(255, 215, 15, 0.95) 0%,
                rgba(255, 215, 15, 0.55) 42%,
                rgba(255, 215, 15, 0.00) 100%
            );
            transform-origin: bottom center;
            filter: drop-shadow(0 -1px 3px rgba(255, 215, 15, 0.18));
        }

        .sun-rays .ray-1 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(-64deg); }
        .sun-rays .ray-2 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(-48deg); }
        .sun-rays .ray-3 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(-32deg); }
        .sun-rays .ray-4 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(-16deg); }
        .sun-rays .ray-5 { height: 34px; opacity: 1; width: 2.5px; transform: translateX(-50%) rotate(0deg); }
        .sun-rays .ray-6 { height: 31px; opacity: 0.82; transform: translateX(-50%) rotate(16deg); }
        .sun-rays .ray-7 { height: 28px; opacity: 0.70; transform: translateX(-50%) rotate(32deg); }
        .sun-rays .ray-8 { height: 24px; opacity: 0.58; transform: translateX(-50%) rotate(48deg); }
        .sun-rays .ray-9 { height: 20px; opacity: 0.45; transform: translateX(-50%) rotate(64deg); }

        .nav-section {
            padding: 0 1rem;
            margin-top: 1.5rem;
        }

        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,215,15,0.5);
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            color: rgba(255,255,255,0.75);
            transition: var(--transition);
            margin-bottom: 0.25rem;
            font-weight: 500;
            text-decoration: none;
        }

        .nav-item i {
            font-size: 1.2rem;
            width: 1.5rem;
        }

        .nav-item:hover {
            background: rgba(255,215,15,0.12);
            color: white;
        }

        .nav-item.active {
            background: var(--gold);
            color: var(--navy);
        }

        .nav-item.active i {
            color: var(--navy);
        }

        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .top-bar {
            background: white;
            padding: 0.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-bottom: 1px solid var(--bdr);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--navy);
        }

        .page-title {
            font-weight: 700;
            color: var(--navy);
            font-family: 'Fraunces', serif;
        }

        .header-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-avatar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.3rem 0.8rem;
            border-radius: 40px;
            transition: background 0.2s;
        }

        .header-avatar:hover {
            background: #F5F7FB;
        }

        .header-avatar-img {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            border: 2px solid var(--gold);
        }

        .header-avatar-info {
            text-align: right;
        }

        .header-avatar-name {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--navy);
        }

        .header-avatar-role {
            font-size: 0.65rem;
            color: var(--txt-3);
        }

        .header-logout-btn {
            background: none;
            border: none;
            color: var(--txt-3);
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.3rem;
            border-radius: 50%;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logout-btn:hover {
            color: var(--danger-red);
            background: rgba(220,38,38,0.1);
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .header-avatar-info {
                display: none;
            }
        }

        .hero-card {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            color: white;
            border-radius: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 18px 40px rgba(10,31,68,0.12);
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 1.2rem;
            padding: 1.25rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--bdr);
        }

        .rating-circle {
            width: 118px;
            height: 118px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(255,215,15,0.15), rgba(255,215,15,0.05));
            border: 8px solid rgba(255,215,15,0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: var(--navy);
        }

        .progress-track {
            height: 10px;
            background: #EEF2F7;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--gold), var(--gold-d));
            border-radius: 999px;
        }

        .evaluation-card {
            background: white;
            border: 1px solid var(--bdr);
            border-radius: 1.25rem;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            background: var(--bg-2);
            border-radius: 1.2rem;
            color: var(--txt-3);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .pill-gold {
            background: rgba(255,215,15,0.15);
            color: var(--gold-d);
        }

        .pill-navy {
            background: var(--navy-pale);
            color: var(--navy);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10,31,68,0.85);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease;
        }

        .modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .confirmation-modal {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s var(--spring);
        }

        .modal-overlay.active .confirmation-modal {
            transform: scale(1);
        }

        .modal-header {
            background: var(--navy);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Fraunces', serif;
        }

        .modal-header h3 i {
            color: var(--gold);
            font-size: 1.4rem;
        }

        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.6rem;
            cursor: pointer;
        }

        .modal-close:hover {
            color: var(--gold);
        }

        .modal-body {
            padding: 1.8rem 1.5rem;
            background: white;
            text-align: center;
        }

        .modal-body p {
            font-size: 1rem;
            color: var(--txt-1);
            font-weight: 500;
        }

        .modal-footer {
            padding: 1rem 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: #f9fafb;
            border-top: 1px solid var(--bdr);
        }

        .modal-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .modal-btn-cancel {
            background: #eef2ff;
            color: #1e293b;
        }

        .modal-btn-confirm {
            background: var(--danger-red);
            color: white;
        }

        @media (max-width: 500px) {
            .modal-footer {
                flex-direction: column-reverse;
            }

            .modal-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

@php
    $authUser = Auth::user();

    $isRecord = function ($item) {
        return is_object($item) || is_array($item);
    };

    $getValue = function ($item, $key, $default = null) {
        if (is_array($item)) {
            return $item[$key] ?? $default;
        }

        if (is_object($item)) {
            return data_get($item, $key, $default);
        }

        return $default;
    };

    $formatDate = function ($date) {
        if (empty($date)) {
            return 'Recently submitted';
        }

        try {
            if ($date instanceof \Carbon\Carbon) {
                return $date->format('M d, Y h:i A');
            }

            return \Carbon\Carbon::parse($date)->format('M d, Y h:i A');
        } catch (\Throwable $e) {
            return 'Recently submitted';
        }
    };

    $evaluationsCollection = collect($evaluations ?? [])
        ->filter(fn ($item) => $isRecord($item))
        ->values();

    $recentEvaluationsCollection = collect($recentEvaluations ?? $evaluationsCollection->take(8))
        ->filter(fn ($item) => $isRecord($item))
        ->values();

    $courseRatingsCollection = collect($courseRatings ?? $courseBreakdown ?? [])
        ->filter(fn ($item) => $isRecord($item))
        ->values();

    $categoryAveragesCollection = collect($categoryAverages ?? []);

    $totalEvaluations = $evaluationCount
        ?? $totalEvaluationCount
        ?? $evaluationsTotal
        ?? $evaluationsCollection->count();

    $averageRating = $averageRating
        ?? $averageEvaluationRating
        ?? $avgRating
        ?? $evaluationsCollection->avg('rating')
        ?? 0;

    $averageRating = (float) $averageRating;

    $ratingDistributionRaw = $ratingDistribution
        ?? $ratingCounts
        ?? [
            5 => $fiveStarCount ?? 0,
            4 => $fourStarCount ?? 0,
            3 => $threeStarCount ?? 0,
            2 => $twoStarCount ?? 0,
            1 => $oneStarCount ?? 0,
        ];

    $ratingDistributionCollection = collect($ratingDistributionRaw);

    $ratingTotal = $ratingDistributionCollection->sum(function ($count) {
        return is_numeric($count) ? (int) $count : 0;
    });

    if ($ratingTotal <= 0 && $totalEvaluations > 0) {
        $ratingTotal = (int) $totalEvaluations;
    }

    $ratingPercent = function ($count) use ($ratingTotal) {
        if ($ratingTotal <= 0) {
            return 0;
        }

        return round(((int) $count / $ratingTotal) * 100);
    };

    $performanceLabel = 'No Data Yet';
    $performanceClass = 'pill-navy';

    if ($averageRating >= 4.5) {
        $performanceLabel = 'Excellent';
        $performanceClass = 'pill-gold';
    } elseif ($averageRating >= 4.0) {
        $performanceLabel = 'Very Good';
        $performanceClass = 'pill-gold';
    } elseif ($averageRating >= 3.0) {
        $performanceLabel = 'Satisfactory';
        $performanceClass = 'pill-navy';
    } elseif ($averageRating > 0) {
        $performanceLabel = 'Needs Improvement';
        $performanceClass = 'pill-navy';
    }

    $categoryFallbacks = [
        'teaching_quality' => 'Teaching Quality',
        'communication' => 'Communication',
        'preparedness' => 'Preparedness',
        'fairness' => 'Fairness',
    ];

    $resolvedCategoryAverages = collect();

    if ($categoryAveragesCollection->count() > 0) {
        foreach ($categoryAveragesCollection as $category => $score) {
            $resolvedCategoryAverages->put($category, is_numeric($score) ? (float) $score : 0);
        }
    } else {
        foreach ($categoryFallbacks as $key => $label) {
            $resolvedCategoryAverages->put($label, (float) ($evaluationsCollection->avg($key) ?? 0));
        }
    }
@endphp

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="/logo/NatU.png" alt="NU Logo" class="sidebar-logo-img" onerror="this.src='https://placehold.co/45x45/0A1F44/FFD70F?text=NU'">

        <div class="logo-text">
            <h1>
                NU
                <span class="horizon-logo-wrap">
                    <span class="sun-rays" aria-hidden="true">
                        <span class="ray ray-1"></span>
                        <span class="ray ray-2"></span>
                        <span class="ray ray-3"></span>
                        <span class="ray ray-4"></span>
                        <span class="ray ray-5"></span>
                        <span class="ray ray-6"></span>
                        <span class="ray ray-7"></span>
                        <span class="ray ray-8"></span>
                        <span class="ray ray-9"></span>
                    </span>

                    <span class="horizon-word">HORIZON</span>
                </span>
            </h1>

            <p>Faculty Portal</p>
        </div>
    </div>

    <div style="flex:1; overflow-y: auto;">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>

            <a href="{{ route('faculty.dashboard') }}" class="nav-item {{ request()->routeIs('faculty.dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-line"></i> Dashboard
            </a>

            <a href="{{ route('faculty.students') }}" class="nav-item {{ request()->routeIs('faculty.students*') ? 'active' : '' }}">
                <i class="ri-user-line"></i> Students
            </a>

            <a href="{{ route('faculty.courses') }}" class="nav-item {{ request()->routeIs('faculty.courses*') ? 'active' : '' }}">
                <i class="ri-book-line"></i> Courses
            </a>

            <a href="{{ route('faculty.folder-files') }}" class="nav-item {{ request()->routeIs('faculty.folder-files*') ? 'active' : '' }}">
                <i class="ri-folder-3-line"></i> Files & Folders
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Quiz Management</div>

            <a href="{{ route('faculty.quiz.create') }}" class="nav-item {{ request()->routeIs('faculty.quiz.create*') ? 'active' : '' }}">
                <i class="ri-add-circle-line"></i> Create Quiz
            </a>

            <a href="{{ route('faculty.quizzes.list') }}" class="nav-item {{ request()->routeIs('faculty.quizzes.list*') ? 'active' : '' }}">
                <i class="ri-list-check"></i> All Quizzes
            </a>

            <a href="{{ route('faculty.question.bank') }}" class="nav-item {{ request()->routeIs('faculty.question.bank*') ? 'active' : '' }}">
                <i class="ri-database-2-line"></i> Question Bank
            </a>

            <a href="{{ route('faculty.grading') }}" class="nav-item {{ request()->routeIs('faculty.grading*') ? 'active' : '' }}">
                <i class="ri-graduation-cap-line"></i> Grading
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Analytics</div>

            <a href="{{ route('faculty.results.index') }}" class="nav-item {{ request()->routeIs('faculty.results*') ? 'active' : '' }}">
                <i class="ri-bar-chart-line"></i> Results & Analytics
            </a>

            <a href="{{ route('faculty.my-evaluation') }}" class="nav-item {{ request()->routeIs('faculty.my-evaluation*') ? 'active' : '' }}">
                <i class="ri-star-smile-line"></i> My Evaluation
            </a>
        </div>
    </div>
</aside>

<div class="main-content" id="mainContent">
    <div class="top-bar">
        <div class="flex items-center gap-3">
            <button class="menu-toggle" id="menuToggle">
                <i class="ri-menu-line"></i>
            </button>

            <div>
                <h2 class="page-title text-lg md:text-xl">My Evaluation</h2>
                <p class="text-sm text-gray-500 hidden md:block">Student feedback and faculty performance summary</p>
            </div>
        </div>

        <div class="header-profile">
            <div class="header-avatar" id="headerAvatar">
                <div class="header-avatar-img">
                    <i class="ri-user-line"></i>
                </div>

                <div class="header-avatar-info">
                    <div class="header-avatar-name">{{ $authUser->name ?? 'Faculty User' }}</div>
                    <div class="header-avatar-role">Faculty</div>
                </div>
            </div>

            <button class="header-logout-btn" id="logoutButtonHeader" title="Sign Out">
                <i class="ri-logout-box-r-line"></i>
            </button>
        </div>
    </div>

    <div class="p-4 md:p-6">
        <div class="hero-card">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="pill pill-gold">
                            <i class="ri-star-smile-line"></i>
                            Faculty Evaluation
                        </span>

                        <span class="pill {{ $performanceClass }}">
                            {{ $performanceLabel }}
                        </span>
                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold mb-2" style="font-family:'Fraunces',serif;">
                        Student Feedback Summary
                    </h1>

                    <p class="text-white/75 max-w-2xl">
                        This page shows your evaluation results based on student feedback. Student identities are kept protected when evaluations are submitted anonymously.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-5 shadow-lg">
                    <div class="rating-circle">
                        <div class="text-3xl font-extrabold">{{ number_format($averageRating, 2) }}</div>
                        <div class="text-xs font-bold text-gray-500">out of 5</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">Total Evaluations</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ $totalEvaluations }}</p>
                    </div>

                    <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                        <i class="ri-chat-smile-3-line text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">Average Rating</p>
                        <p class="text-3xl font-extrabold text-gray-800">{{ number_format($averageRating, 2) }}/5</p>
                    </div>

                    <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center">
                        <i class="ri-star-line text-yellow-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">Performance Level</p>
                        <p class="text-xl font-extrabold text-gray-800">{{ $performanceLabel }}</p>
                    </div>

                    <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                        <i class="ri-award-line text-green-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="evaluation-card">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-bar-chart-horizontal-line" style="color: var(--gold);"></i>
                        Rating Distribution
                    </h3>
                </div>

                <div class="p-5 space-y-4">
                    @for($star = 5; $star >= 1; $star--)
                        @php
                            $count = (int) ($ratingDistributionCollection->get($star) ?? $ratingDistributionCollection->get((string) $star) ?? 0);
                            $percent = $ratingPercent($count);
                        @endphp

                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <div class="flex items-center gap-1 text-sm font-semibold text-gray-700">
                                    <span>{{ $star }}</span>
                                    <i class="ri-star-fill text-yellow-500"></i>
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $count }} response(s) · {{ $percent }}%
                                </div>
                            </div>

                            <div class="progress-track">
                                <div class="progress-bar" style="width: {{ $percent }}%;"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="evaluation-card">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="ri-focus-3-line" style="color: var(--gold);"></i>
                        Category Averages
                    </h3>
                </div>

                <div class="p-5 space-y-4">
                    @forelse($resolvedCategoryAverages as $category => $score)
                        @php
                            $label = is_string($category)
                                ? ucwords(str_replace('_', ' ', $category))
                                : 'Category ' . ($loop->iteration);

                            $score = is_numeric($score) ? (float) $score : 0;
                            $scorePercent = min(100, max(0, ($score / 5) * 100));
                        @endphp

                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-semibold text-gray-700">{{ $label }}</span>
                                <span class="text-xs font-bold text-gray-500">{{ number_format($score, 2) }}/5</span>
                            </div>

                            <div class="progress-track">
                                <div class="progress-bar" style="width: {{ $scorePercent }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="ri-bar-chart-box-line text-4xl text-gray-300"></i>
                            <p class="mt-2">No category ratings available yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="evaluation-card mb-6">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-book-open-line" style="color: var(--gold);"></i>
                    Course Evaluation Summary
                </h3>
            </div>

            <div class="p-5">
                @if($courseRatingsCollection->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 border-b border-gray-100">
                                    <th class="py-3 px-2">Course</th>
                                    <th class="py-3 px-2">Average Rating</th>
                                    <th class="py-3 px-2">Evaluations</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($courseRatingsCollection as $courseRating)
                                    @php
                                        $courseName = $getValue($courseRating, 'course.name')
                                            ?? $getValue($courseRating, 'course_name')
                                            ?? 'Course #' . ($getValue($courseRating, 'course_id', 'N/A'));

                                        $courseAverage = $getValue($courseRating, 'average_rating')
                                            ?? $getValue($courseRating, 'rating')
                                            ?? 0;

                                        $courseCount = $getValue($courseRating, 'evaluation_count')
                                            ?? $getValue($courseRating, 'count')
                                            ?? 0;
                                    @endphp

                                    <tr class="border-b border-gray-50">
                                        <td class="py-3 px-2 font-semibold text-gray-800">{{ $courseName }}</td>
                                        <td class="py-3 px-2">
                                            <span class="pill pill-gold">
                                                <i class="ri-star-fill"></i>
                                                {{ number_format((float) $courseAverage, 2) }}/5
                                            </span>
                                        </td>
                                        <td class="py-3 px-2 text-gray-600">{{ $courseCount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ri-book-open-line text-4xl text-gray-300"></i>
                        <p class="mt-2">No course-specific evaluation data yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="evaluation-card">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="ri-message-3-line" style="color: var(--gold);"></i>
                    Recent Student Feedback
                </h3>

                <span class="text-xs text-gray-400">Latest comments</span>
            </div>

            <div class="p-5">
                @if($recentEvaluationsCollection->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentEvaluationsCollection as $evaluation)
                            @php
                                $courseName = $getValue($evaluation, 'course.name')
                                    ?? $getValue($evaluation, 'course_name')
                                    ?? 'General Evaluation';

                                $createdAt = $formatDate($getValue($evaluation, 'created_at'));
                                $rating = (float) ($getValue($evaluation, 'rating', 0));
                                $comment = $getValue($evaluation, 'comment', 'No written comment provided.');
                            @endphp

                            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/50">
                                <div class="flex items-center justify-between gap-3 mb-2">
                                    <div>
                                        <p class="font-bold text-gray-800">
                                            {{ $courseName }}
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            {{ $createdAt }}
                                        </p>
                                    </div>

                                    <span class="pill pill-gold">
                                        <i class="ri-star-fill"></i>
                                        {{ number_format($rating, 1) }}/5
                                    </span>
                                </div>

                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ $comment ?: 'No written comment provided.' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ri-chat-smile-3-line text-4xl text-gray-300"></i>
                        <p class="mt-2">No student feedback yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="logoutModal" class="modal-overlay">
    <div class="confirmation-modal">
        <div class="modal-header">
            <h3><i class="ri-logout-box-r-line"></i> Confirm Sign Out</h3>
            <button class="modal-close" id="closeModalBtn">&times;</button>
        </div>

        <div class="modal-body">
            <p>Are you sure you want to sign out of your account?</p>
            <p class="text-xs text-gray-500 mt-2">You will be redirected to the main page and will need to log in again.</p>
        </div>

        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
            <button class="modal-btn modal-btn-confirm" id="confirmLogoutBtn">Yes, Sign Out</button>
        </div>
    </div>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('mobile-open'));
    }

    document.addEventListener('click', (event) => {
        const isMobile = window.innerWidth <= 1024;

        if (isMobile && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    const currentUrl = window.location.pathname;

    document.querySelectorAll('.nav-item').forEach(item => {
        const href = item.getAttribute('href');

        if (href && currentUrl.includes(href) && href !== '/faculty/dashboard') {
            item.classList.add('active');
        } else if (currentUrl === '/faculty/dashboard' && href === '/faculty/dashboard') {
            item.classList.add('active');
        }
    });

    const logoutButton = document.getElementById('logoutButtonHeader');
    const logoutModal = document.getElementById('logoutModal');
    const confirmBtn = document.getElementById('confirmLogoutBtn');
    const cancelBtn = document.getElementById('cancelLogoutBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const logoutForm = document.getElementById('logoutForm');

    function openModal() {
        logoutModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        logoutModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (logoutButton) {
        logoutButton.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });
    }

    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            if (logoutForm) {
                logoutForm.submit();
            } else {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }

    if (logoutModal) {
        logoutModal.addEventListener('click', (e) => {
            if (e.target === logoutModal) {
                closeModal();
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && logoutModal.classList.contains('active')) {
            closeModal();
        }
    });
</script>

<form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display: none;">
    @csrf
</form>

</body>
</html>
