@php
    $plugin = filament('ngankt2-auth-ui');
    $backgroundImage = $plugin->getBackgroundImage();
    $formPosition = $plugin->getFormPosition();
    $featureCards = $plugin->getFeatureCards();
    $hasFeatureCards = $plugin->hasFeatureCards();
    $socialLogins = $plugin->getSocialLogins();
    $hasSocialLogins = $plugin->hasSocialLogins();
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    <div class="ngankt2-split-auth {{ $formPosition === 'right' ? 'ngankt2-layout-right' : 'ngankt2-layout-left' }}">

        {{-- Form Panel --}}
        <div class="ngankt2-auth-form-panel">
            <div class="ngankt2-auth-form-wrapper">

                {{-- Form Slot --}}
                <div class="ngankt2-auth-form">
                    {{ $slot }}
                </div>

                {{-- Forgot Password (for login page) --}}
                @if (filament()->hasPasswordReset() && request()->routeIs('*.login'))
                    <div class="ngankt2-auth-forgot">
                        <a href="{{ filament()->getRequestPasswordResetUrl() }}">
                            {{ __('filament-panels::pages/auth/login.actions.request_password_reset.label') }}
                        </a>
                    </div>
                @endif
                {{-- Social Login --}}
                @if($hasSocialLogins)
                    {{-- Divider --}}
                    <div class="ngankt2-auth-divider">
                        <span>{{ __('ngankt2-auth-ui::auth-ui.or') }}</span>
                    </div>

                    <div class="ngankt2-auth-social">
                        @foreach($socialLogins as $login)
                            <button type="button" class="ngankt2-auth-social-btn" onclick="window.location.href='{{ $login['url'] }}'" style="{{ isset($login['color']) ? '--btn-color: ' . $login['color'] : '' }}">
                                @if(isset($login['svg']))
                                    {!! $login['svg'] !!}
                                @elseif(isset($login['icon']))
                                    <x-filament::icon :icon="$login['icon']" class="ngankt2-social-icon" />
                                @endif
                                {{ $login['label'] }}
                            </button>
                        @endforeach
                    </div>
                @endif

                {{-- Footer --}}
                <div class="ngankt2-auth-footer">
                    {{ __('ngankt2-auth-ui::auth-ui.copyright', ['year' => date('Y'), 'brand' => filament()->getBrandName()]) }}
                </div>
            </div>
        </div>

        {{-- Feature Cards Panel --}}
        <div class="ngankt2-auth-features-panel">
            <div class="ngankt2-auth-features-wrapper">
                <div class="ngankt2-auth-features-content">
                    {{-- Brand Logo --}}
                    <div class="ngankt2-features-brand">
                        <div class="ngankt2-features-brand-name">
                            {{ filament()->getBrandName() }}
                        </div>
                    </div>

                    {{-- Feature Cards Grid --}}
                    <div class="ngankt2-features-grid">
                        @if($hasFeatureCards)
                            @foreach($featureCards as $index => $card)
                                <div class="ngankt2-feature-card {{ $index % 2 === 0 ? 'ngankt2-card-left' : 'ngankt2-card-right' }}">
                                    <div class="ngankt2-feature-icon">
                                        <x-filament::icon
                                            :icon="$card['icon'] ?? 'heroicon-o-sparkles'"
                                            class="ngankt2-feature-icon-svg"
                                        />
                                    </div>
                                    <div class="ngankt2-feature-content">
                                        <h3 class="ngankt2-feature-title">{{ $card['title'] ?? '' }}</h3>
                                        <p class="ngankt2-feature-brief">{{ $card['brief'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Skeleton Cards --}}
                            @for($i = 0; $i < 4; $i++)
                                <div class="ngankt2-feature-card ngankt2-feature-skeleton {{ $i % 2 === 0 ? 'ngankt2-card-left' : 'ngankt2-card-right' }}">
                                    <div class="ngankt2-feature-icon ngankt2-skeleton-icon"></div>
                                    <div class="ngankt2-feature-content">
                                        <div class="ngankt2-skeleton-title"></div>
                                        <div class="ngankt2-skeleton-brief"></div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ngankt2-split-auth {
            display: flex;
            min-height: 100vh;
            max-height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        /* Layout Direction */
        .ngankt2-layout-left .ngankt2-auth-form-panel {
            order: 1;
        }
        .ngankt2-layout-left .ngankt2-auth-features-panel {
            order: 2;
        }
        .ngankt2-layout-right .ngankt2-auth-form-panel {
            order: 2;
        }
        .ngankt2-layout-right .ngankt2-auth-features-panel {
            order: 1;
        }

        /* Form Panel */
        .ngankt2-auth-form-panel {
            width: var(--ngankt2-form-width, 400px);
            min-width: 360px;
            max-width: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--ngankt2-form-bg, #ffffff);
            flex-shrink: 0;
        }

        .dark .ngankt2-auth-form-panel {
            background: #1f2937;
        }

        .ngankt2-auth-form-wrapper {
            width: 100%;
            max-width: 320px;
        }

        /* Logo */
        .ngankt2-auth-logo {
            margin-bottom: 1.5rem;
        }

        .ngankt2-auth-logo-img {
            height: 40px;
            width: auto;
        }

        .ngankt2-auth-brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #363B97;
        }

        /* Heading */
        .ngankt2-auth-heading {
            font-size: 1.125rem;
            font-weight: 500;
            color: #363B97;
            margin-bottom: 2rem;
        }

        .dark .ngankt2-auth-heading {
            color: #a5b4fc;
        }

        /* Form */
        .ngankt2-auth-form {
            margin-bottom: 0.5rem;
        }

        .ngankt2-auth-form .fi-input-wrp {
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: none;
        }

        .ngankt2-auth-form .fi-input-wrp:focus-within {
            border-color: #363B97;
            background: #fff;
        }

        .dark .ngankt2-auth-form .fi-input-wrp {
            background: #1f2937;
            border-color: #374151;
        }

        .dark .ngankt2-auth-form .fi-input-wrp:focus-within {
            border-color: #6366f1;
            background: #111827;
        }

        .ngankt2-auth-form .fi-btn-primary {
            background: #363B97 !important;
            border-radius: 8px;
            font-weight: 600;
        }

        .ngankt2-auth-form .fi-btn-primary:hover {
            background: #2a2f7a !important;
        }

        /* Forgot Password */
        .ngankt2-auth-forgot {
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .ngankt2-auth-forgot a {
            color: #363B97;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .ngankt2-auth-forgot a:hover {
            text-decoration: underline;
        }

        .dark .ngankt2-auth-forgot a {
            color: #a5b4fc;
        }

        /* Divider */
        .ngankt2-auth-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .ngankt2-auth-divider::before,
        .ngankt2-auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }

        .dark .ngankt2-auth-divider::before,
        .dark .ngankt2-auth-divider::after {
            background: #4b5563;
        }

        .ngankt2-auth-divider span {
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .dark .ngankt2-auth-divider span {
            color: #9ca3af;
        }

        /* Google Button */
        .ngankt2-auth-google-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #333;
            cursor: pointer;
            transition: all 0.2s;
        }

        .ngankt2-auth-google-btn:hover {
            background: #f8f9fa;
            border-color: #dee2e6;
        }

        .dark .ngankt2-auth-google-btn {
            background: #374151;
            border-color: #4b5563;
            color: #e5e7eb;
        }

        .dark .ngankt2-auth-google-btn:hover {
            background: #4b5563;
        }

        /* Social Login Buttons */
        .ngankt2-auth-social {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .ngankt2-auth-social-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: var(--btn-color, #fff);
            border: 1px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.875rem;
            color: #333;
            cursor: pointer;
            transition: all 0.2s;
        }

        .ngankt2-auth-social-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .dark .ngankt2-auth-social-btn {
            background: var(--btn-color, #374151);
            border-color: #4b5563;
            color: #e5e7eb;
        }

        .ngankt2-social-icon {
            width: 20px;
            height: 20px;
        }

        /* Register/Login Link */
        .ngankt2-auth-register-link {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .ngankt2-auth-register-link a {
            color: #363B97;
            text-decoration: none;
        }

        .ngankt2-auth-register-link a:hover {
            text-decoration: underline;
        }

        .dark .ngankt2-auth-register-link {
            color: #9ca3af;
        }

        .dark .ngankt2-auth-register-link a {
            color: #a5b4fc;
        }

        /* Footer */
        .ngankt2-auth-footer {
            margin-top: 3rem;
            font-size: 0.75rem;
            color: #adb5bd;
        }

        .dark .ngankt2-auth-footer {
            color: #6b7280;
        }

        /* Features Panel */
        .ngankt2-auth-features-panel {
            flex: 1;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #363B97 0%, #5a5fc9 50%, #8b5cf6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
        }

        .dark .ngankt2-auth-features-panel {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
        }

        .ngankt2-auth-features-wrapper {
            width: 100%;
            max-width: 600px;
        }

        .ngankt2-auth-features-content {
            color: #fff;
        }

        /* Features Brand */
        .ngankt2-features-brand {
            margin-bottom: 3rem;
        }

        .ngankt2-features-brand-name {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Features Grid - Chat-like staggered layout */
        .ngankt2-features-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
        }

        /* Feature Card */
        .ngankt2-feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            padding: 1rem;
            transition: all 0.3s ease;
            align-items: center;
            display: flex;
        }

        .ngankt2-feature-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        /* Staggered card positions */
        .ngankt2-card-left {
            margin-right: 3rem;
        }

        .ngankt2-card-right {
            margin-left: 3rem;
        }

        .ngankt2-feature-icon {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .ngankt2-feature-icon-svg {
            width: 32px;
            height: 32px;
            color: #fff;
        }

        .ngankt2-feature-title {
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin: 0 0 0.5rem 0;
        }

        .ngankt2-feature-brief {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            line-height: 1.5;
        }

        /* Skeleton Cards */
        .ngankt2-feature-skeleton {
            animation: pulse 2s ease-in-out infinite;
        }

        .ngankt2-skeleton-icon {
            background: rgba(255, 255, 255, 0.2) !important;
        }

        .ngankt2-skeleton-title {
            height: 1rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            width: 70%;
            margin-bottom: 0.75rem;
        }

        .ngankt2-skeleton-brief {
            height: 0.75rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
            width: 100%;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.6;
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .ngankt2-features-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .ngankt2-split-auth {
                flex-direction: column;
            }

            .ngankt2-auth-form-panel {
                width: 100%;
                min-width: auto;
                max-width: none;
                min-height: 100vh;
                order: 1 !important;
            }

            .ngankt2-auth-features-panel {
                display: none;
            }
        }
    </style>
</x-filament-panels::layout.base>
