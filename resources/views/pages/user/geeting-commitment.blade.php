@extends('user-layouts.master')

<style>
    /* Halaman Pembuka */
    .opening-container {
        background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)), url('{{ asset('user-assets/images/background.jpg') }}') no-repeat center center;
        /* Ganti dengan gambar latar belakang yang diinginkan */
        background-size: cover;
        color: white;
        text-align: center;
        padding: 50px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease;
        /* Transisi halus */
    }

    /* Tombol */
    .opening-container button {
        padding: 12px 24px;
        background-color: #f1f1de !important;
        border: none;
        border-radius: 5px;
        color: #000;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
        font-size: 16px;
        /* Ukuran font yang lebih besar */
        transition: background-color 0.3s ease, transform 0.3s ease;
        /* Transisi untuk efek hover */
    }

    .opening-container button:hover {
        background-color: #e0e0d1 !important;
        /* Warna saat hover */
        transform: scale(1.05);
        /* Efek zoom saat hover */
    }

    /* Judul dan Teks */
    .opening-container h1 {
        font-size: 36px;
        /* Ukuran font yang lebih besar untuk judul */
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        /* Bayangan teks untuk kontras */
    }

    .opening-container p {
        font-size: 18px;
        /* Ukuran font yang lebih besar untuk teks */
        margin-bottom: 20px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        /* Bayangan teks untuk kontras */
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        transition: opacity 0.3s ease-in-out;
    }

    .modal.show {
        display: flex;
        opacity: 1;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .quiz-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 90%;
        max-width: 500px;
        text-align: left;
        /* Rata kiri untuk konten modal */
    }

    .quiz-container h1 {
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
        /* Judul tetap di tengah */
    }

    .quiz-container p {
        font-size: 13px;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        /* Rata kiri untuk teks */
    }

    .quiz-container .divider {
        width: 60%;
        height: 2px;
        background-color: #d3d3d3;
        margin: 10px auto 20px;
    }

    .quiz-container .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    /* Congratulations Modal */
    .congrats-modal {
        display: none;
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7) !important;
        justify-content: center;
        align-items: center;
    }

    .congrats-modal.show {
        display: flex;
    }

    .congrats-content {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2) !important;
        padding: 30px;
        width: 90%;
        max-width: 500px;
        text-align: center;
    }

    .congrats-content h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .congrats-content p {
        font-size: 16px;
        color: #555;
        margin-bottom: 20px;
    }

    .congrats-content button {
        padding: 10px 20px;
        background-color: #f1f1de !important;
        border: none;
        border-radius: 5px;
        color: #000;
        font-weight: bold;
        cursor: pointer;
    }

    .congrats-content button:hover {
        background-color: #f1f1de !important;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-top: 20px;
    }

    .btn-circle {
        width: 80px;
        height: 80px;
        background-color: #f1c40f !important;
        border: none;
        border-radius: 50%;
        color: #000;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease, transform 0.2s ease-in-out;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        outline: none;
        text-align: center;
    }

    .btn-circle:hover {
        background-color: #e0b70c !important;
        transform: scale(1.1);
    }

    .btn-circle:active {
        transform: scale(0.9);
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>

@section('content')
    {{-- <div class="opening-container" id="openingContainer">
        <p>Click the button below to start the experience.</p>
        <button id="startButton">Start</button>
    </div> --}}

    <div class="section started" id="section-started">

        <!-- Background -->
        <div id="started-video-bg" class="video-bg media-bg jarallax-video video-mobile-bg"
            data-jarallax-video="mp4:{{ asset('user-assets/videos/background.mp4') }}">
            <div class="video-bg-mask"></div>
            <div class="video-bg-texture" id="grained_container"></div>
        </div>

        {{-- Backsound --}}
        <audio id="backgroundMusic" loop>
            <source src="{{ asset('user-assets/audios/backsound.mp3') }}" type="audio/mp3">
            Your browser does not support the audio element.
        </audio>

        <div class="centrize full-width">
            <div class="vertical-center">
                <div class="started-content">
                    <div class="h-title"></div>
                    <div class="h-subtitle typing-subtitle">
                    </div>
                    <span class="typed-subtitle"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar Modal -->
    <div id="progressModal" class="modal">
        <div class="quiz-container">
            {{-- <span class="close-btn">&times;</span> --}}
            <h1>GETTING COMMITMENT</h1>
            <div class="divider"></div>
            <p style="color: #333 !important">Push the button with mindfulness to describe how your commitment to the
                activity in 2025. Push your limits until 100% power</p>
            <!-- Progress Bar -->
            <div style="width: 100%; background-color: #ddd; border-radius: 10px; overflow: hidden;">
                <div id="progressBar" style="width: 0%; height: 30px; background-color: #f1c40f; transition: width 0.1s;">
                </div>
            </div>

            <p style="text-align: center; margin-top: 10px;"><span id="progressText">0</span>%</p>

            <!-- Push Button -->
            <div class="button-container">
                <button id="pushButton" class="btn-circle">
                    PUSH
                </button>
            </div>
        </div>
    </div>

    <!-- Congratulations Modal -->
    <div id="congratsModal" class="congrats-modal">
        <div class="congrats-content">
            <h1>🎉 Congratulations! 🎉</h1>
            <p>Your commitment has been successfully recorded. Thank you for contributing to KMI’s future improvements.</p>
            <button onclick="window.location.href='{{ route('home') }}'">Back to Home</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // const openingContainer = document.getElementById("openingContainer");
            const sectionStarted = document.getElementById("section-started");
            const progressModal = document.getElementById("progressModal");
            const progressBar = document.getElementById("progressBar");
            const progressText = document.getElementById("progressText");
            const pushButton = document.getElementById("pushButton");
            const congratsModal = document.getElementById("congratsModal");

            let progress = 0;
            let increaseInterval;
            let decreaseInterval;

            // document.getElementById("startButton").addEventListener("click", function() {
            //     openingContainer.style.display = "none";
            //     sectionStarted.style.display = "block";

            //     const audio = document.getElementById("backgroundMusic");
            //     if (audio) {
            //         audio.volume = 1;
            //         audio.play().catch(error => console.error("Autoplay error:", error));
            //     }

            //     setTimeout(() => {
            //         progressModal.classList.add("show");
            //     }, 500);
            // });

            // Tampilkan sectionStarted langsung
            sectionStarted.style.display = "block";
            setTimeout(() => {
                progressModal.classList.add("show");
            }, 1200);

            // Mulai audio jika tersedia
            const audio = document.getElementById("backgroundMusic");
            if (audio) {
                audio.volume = 1;
                audio.play().catch(error => console.error("Autoplay error:", error));
            }

            function startProgress() {
                clearInterval(decreaseInterval);
                increaseInterval = setInterval(() => {
                    if (progress < 100) {
                        progress += 20;
                        progressBar.style.width = progress + "%";
                        progressText.innerText = progress;
                    }
                    if (progress >= 100) {
                        clearInterval(increaseInterval);
                        progressModal.classList.remove("show");
                        congratsModal.classList.add("show");
                    }
                }, 1000);
            }

            function stopProgress() {
                clearInterval(increaseInterval);
                decreaseInterval = setInterval(() => {
                    if (progress > 0) {
                        progress -= 20;
                        progressBar.style.width = progress + "%";
                        progressText.innerText = progress;
                    } else {
                        clearInterval(decreaseInterval);
                    }
                }, 1000);
            }

            pushButton.addEventListener("mousedown", startProgress);
            pushButton.addEventListener("mouseup", stopProgress);
            pushButton.addEventListener("touchstart", startProgress);
            pushButton.addEventListener("touchend", stopProgress);
        });
    </script>
@endsection
