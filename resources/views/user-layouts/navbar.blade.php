<style>
    .responsive-logo {
        max-width: 100%;
        height: auto;
    }

    .head-top {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .logo-left img,
    .logo-right img {
        max-width: 185px;
    }

    @media (max-width: 768px) {

        .logo-left img,
        .logo-right img {
            max-width: 140px;
        }
    }

    @media (max-width: 480px) {

        .logo-left img,
        .logo-right img {
            max-width: 100px;
        }
    }

    /* Style untuk tombol Play */
    .play-audio-btn {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out; */
    }

    .play-audio-btn:hover {
        transform: translateX(-50%) scale(1.1);
    }

    /* Animasi efek berdenyut */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
        }

        50% {
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.8);
        }

        100% {
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
        }
    }

    .play-audio-btn.pulse {
        animation: pulse 1.5s infinite;
    }

    .play-audio-btn i {
        font-size: 25px;
    }
</style>

<header class="header">
    <div class="head-top">

        <!-- Logo kiri -->
        <div class="logo-left">
            <a href="#">
                <img src="{{ asset('user-assets/images/logo/kmi_white.png') }}" alt="Logo Kiri" class="responsive-logo">
            </a>
        </div>

        <!-- Logo kanan -->
        <div class="logo-right">
            <a href="#">
                <img src="{{ asset('user-assets/images/logo/patriot.png') }}" alt="Logo Kanan" class="responsive-logo">
            </a>
        </div>

    </div>
</header>
