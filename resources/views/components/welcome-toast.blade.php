@props(['user' => 'Guest'])

<div {{ $attributes->class(['welcome-toast']) }} role="status" aria-live="polite" data-welcome-toast>
    <span>Selamat datang, {{ $user }}!</span>
    <button class="welcome-toast__close" type="button" aria-label="Tutup notifikasi">&times;</button>
</div>

<script>
    (() => {
        const toast = document.querySelector('[data-welcome-toast]');
        if (!toast) return;

        const dismiss = () => {
            if (toast.classList.contains('welcome-toast--dismissed')) return;

            toast.classList.add('welcome-toast--dismissed');
            window.setTimeout(() => toast.remove(), 300);
        };

        toast.querySelector('.welcome-toast__close').addEventListener('click', dismiss);
        window.setTimeout(dismiss, 6000);
    })();
</script>
