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
                <img src="{{ asset('user-assets/images/logo/logo kmi.png') }}" alt="Logo Kiri" class="responsive-logo">
            </a>
        </div>

        <!-- Tombol Play/Mute -->
        <button id="play-video" class="play-audio-btn pulse">
            <i id="audio-icon" class="fa fa-volume-up"></i> <!-- Default: suara -->
        </button>

        <!-- Logo kanan -->
        <div class="logo-right">
            <a href="#">
                <img src="{{ asset('user-assets/images/logo/Logo.png') }}" alt="Logo Kanan" class="responsive-logo">
            </a>
        </div>

    </div>
</header>

{{-- <script>
    document.getElementById("play-video").addEventListener("click", function() {
        var video = document.querySelector(".jarallax-video video");
        if (video) {
            video.muted = false;
            video.volume = 1;
            video.play();
        }
        this.classList.remove("pulse"); // Hapus efek animasi setelah diklik
    });
</script> --}}

{{-- <script>
    document.getElementById("play-video").addEventListener("click", function() {
        var video = document.querySelector(".jarallax-video video");
        var icon = document.getElementById("audio-icon");

        if (video) {
            video.muted = !video.muted; // Toggle mute/unmute

            // Ubah ikon sesuai status suara
            if (video.muted) {
                icon.classList.remove("fa-volume-up");
                icon.classList.add("fa-volume-mute"); // Ikon Mute
            } else {
                icon.classList.remove("fa-volume-mute");
                icon.classList.add("fa-volume-up"); // Ikon Unmute
                video.volume = 1; // Pastikan volume penuh saat di-unmute
                video.play(); // Pastikan video berjalan
            }
        }

        this.classList.remove("pulse"); // Hapus animasi setelah diklik
    });
</script> --}}

<script>
    document.getElementById("play-video").addEventListener("click", function() {
        var video = document.querySelector(".jarallax-video video");
        var audio = document.getElementById("backgroundMusic");
        var icon = document.getElementById("audio-icon");

        if (video && audio) {
            var isMuted = video.muted; // Cek apakah video dalam kondisi mute

            // Toggle mute/unmute untuk video dan audio
            video.muted = !isMuted;
            audio.muted = !isMuted;

            // Ubah ikon sesuai status suara
            if (isMuted) {
                icon.classList.remove("fa-volume-mute");
                icon.classList.add("fa-volume-up"); // Ikon Unmute
                video.volume = 1;
                audio.volume = 0.5; // Atur volume backsound
                video.play(); // Pastikan video berjalan
                audio.play(); // Pastikan backsound berjalan
            } else {
                icon.classList.remove("fa-volume-up");
                icon.classList.add("fa-volume-mute"); // Ikon Mute
            }
        }

        this.classList.remove("pulse"); // Hapus animasi setelah diklik
    });
</script>
