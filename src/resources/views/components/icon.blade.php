@php
$icons = [
    // User & Profile Icons
    'user' => '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />',
    'user-plus' => '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 11h6" /><path d="M19 8v6" />',
    'users' => '<path d="M9 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v2" /><path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',

    // Communication Icons
    'mail' => '<path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" />',
    'mail-check' => '<path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M15 19l2 2l4 -4" />',

    // Security Icons
    'lock' => '<path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" />',
    'key' => '<path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.414 .586h-4.172a1 1 0 0 1 -1 -1v-4.172a2 2 0 0 1 .586 -1.414l6.558 -6.558l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" />',
    'key-off' => '<path d="M10.17 6.159l2.316 -2.316a2.877 2.877 0 0 1 4.069 0l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.33 2.33m-2.3 1.672l-1.257 1.257a2 2 0 0 1 -1.414 .586h-4.172a1 1 0 0 1 -1 -1v-4.172a2 2 0 0 1 .586 -1.414l5.744 -5.744" /><path d="M15 9h.01" /><path d="M3 3l18 18" />',
    'shield' => '<path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />',
    'shield-off' => '<path d="M17.67 17.667a12 12 0 0 1 -5.67 3.333a12 12 0 0 1 -8.5 -15c.794 .036 1.583 -.006 2.357 -.124m3.128 -.926a11.997 11.997 0 0 0 3.015 -1.95a12 12 0 0 0 8.5 3a12 12 0 0 1 -2.833 11.667" /><path d="M3 3l18 18" />',

    // Navigation Icons
    'arrow-left' => '<path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" />',
    'arrow-right' => '<path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" />',
    'arrow-up' => '<path d="M12 5l0 14" /><path d="M18 11l-6 -6" /><path d="M6 11l6 -6" />',
    'arrow-down' => '<path d="M12 5l0 14" /><path d="M18 13l-6 6" /><path d="M6 13l6 6" />',

    // Basic Icons
    'check' => '<path d="M5 12l5 5l10 -10" />',
    'x' => '<path d="M18 6l-12 12" /><path d="M6 6l12 12" />',
    'plus' => '<path d="M12 5l0 14" /><path d="M5 12l14 0" />',
    'minus' => '<path d="M5 12l14 0" />',

    // Action Icons
    'edit' => '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />',
    'trash' => '<path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />',
    'eye' => '<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 2.4 -5.4 4 -9 4c-3.6 0 -6.6 -1.6 -9 -4c2.4 -2.4 5.4 -4 9 -4c3.6 0 6.6 1.6 9 4" />',
    'eye-off' => '<path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -1.6 -9 -4c1.1 -1.1 2.4 -2.1 3.9 -2.8" /><path d="M7.5 7.5l9 9" /><path d="M3 3l18 18" />',
    'device-floppy' => '<path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-4 0l0 -4" />',

    // Information Icons
    'info-circle' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" />',
    'alert-circle' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
    'alert-triangle' => '<path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />',

    // Time & Date Icons
    'calendar' => '<path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" />',
    'clock' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" />',

    // Activity Icons
    'activity' => '<path d="M3 12h4l3 8l4 -16l3 8h4" />',
];

$iconPath = $icons[$name] ?? $slot;
$displaySize = $size ?? '24';
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    width="{{ $displaySize }}"
    height="{{ $displaySize }}"
    viewBox="0 0 24 24"
    fill="none"
    stroke="{{ $color ?? 'currentColor' }}"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    {{ $attributes->class(['icon']) }}
>
    {!! $iconPath !!}
</svg>
