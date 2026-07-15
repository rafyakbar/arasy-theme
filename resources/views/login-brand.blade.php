@php
    $brandInitial = mb_substr(trim($brandName), 0, 1);
    $hasBrandLogo = filled($brandLogo ?? null);
    $showBrandText = ! ($hasBrandLogo && ($hideBrandText ?? false));
    $brandLogoHeightValue = ($brandLogoHeight ?? null) ?: '44px';
@endphp

<div class="arasy-auth-brand">
    @if ($hasBrandLogo)
        @if ($brandLogo instanceof \Illuminate\Contracts\Support\Htmlable)
            <div class="arasy-auth-brand-logo" style="height: {{ e($brandLogoHeightValue) }}">
                {{ $brandLogo }}
            </div>
        @else
            <img
                src="{{ $brandLogo }}"
                alt="{{ $brandName }}"
                class="arasy-auth-brand-logo"
                style="height: {{ e($brandLogoHeightValue) }}"
            />
        @endif
    @else
        <div class="arasy-auth-brand-mark" aria-hidden="true">{{ $brandInitial }}</div>
    @endif

    @if ($showBrandText)
        <div class="arasy-auth-brand-text">
            <div class="arasy-auth-brand-name">{{ $brandName }}</div>

            @if (filled($brandTagline))
                <div class="arasy-auth-brand-tagline">{{ $brandTagline }}</div>
            @endif
        </div>
    @endif
</div>
