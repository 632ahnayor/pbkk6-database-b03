@props(['message'])

<p {{ $attributes->class(['status-banner']) }} role="status" aria-live="polite">
    {{ $message }}
</p>
