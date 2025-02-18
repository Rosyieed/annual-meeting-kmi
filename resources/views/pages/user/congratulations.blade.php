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

    /* Styling untuk kontainer utama */
    .congratulation-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 90%;
        max-width: 500px;
        text-align: center;
        margin: 20px auto;
    }

    /* Judul */
    .congratulation-container h1 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
    }

    /* Teks konten */
    .congratulation-container p {
        font-size: 14px;
        color: #333;
        margin-bottom: 20px;
    }

    /* Divider */
    .congratulation-container .divider {
        width: 60%;
        height: 2px;
        background-color: #d3d3d3;
        margin: 10px auto 20px;
    }

    .congratulation-container .dividerCustom {
        width: 100%;
        height: 2px;
        background-color: #898989;
        margin: 10px auto 10px;
    }

    /* Tombol */
    .congratulation-container button {
        padding: 10px 20px !important;
        background-color: #f1f1de !important;
        border: none;
        border-radius: 5px;
        color: #000 !important;
        font-weight: bold;
        cursor: pointer;
        margin: 5px;
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    /* Tombol saat dihover */
    .congratulation-container button:hover {
        background-color: #e0e0d1 !important;
    }

    /* Form pemilihan ketua */
    .congratulation-container ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .congratulation-container ul li {
        margin-bottom: 10px;
    }

    .congratulation-container ul li input[type="radio"] {
        margin-right: 10px;
    }

    .congratulation-container ul li label {
        font-size: 14px;
        color: rgba(0, 0, 0, 0.5);
    }

    /* Tombol Vote */
    .congratulation-container button[type="submit"] {
        background-color: #f1f1de !important;
        color: #000 !important;
        font-weight: bold;
        padding: 10px 20px !important;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }

    .congratulation-container button[type="submit"]:hover {
        background-color: #e0e0d1 !important;
    }
</style>

@section('content')
    <div class="opening-container" id="openingContainer">
        {{-- <h1>Welcome!</h1> --}}
        <p>Click the button below to start the experience.</p>
        <button id="startButton">Start</button>
    </div>

    <div class="section started" id="section-started">
        <!-- Background -->
        <div id="started-video-bg" class="video-bg media-bg jarallax-video video-mobile-bg"
            data-jarallax-video="mp4:{{ asset('user-assets/videos/background.mp4') }}" data-volume="0" muted>
            <div class="video-bg-mask">
            </div>
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
                    {{-- Kata Kata --}}
                    <div class="congratulation-container" id="kata-kata-container">
                        <h1>Congratulations</h1>
                        <div class="divider"></div>

                        <!-- Ucapan Kata Kata -->
                        <div class="text-content" style="text-align: left;">
                            <p>Great news, <strong>{{ $userName }}</strong>!</p>
                            <p>Thank you for completing the survey.</p>
                            <p>Get ready to work together, tackle exciting challenges, and make this experience
                                unforgettable. We're
                                thrilled to have you on board!</p>
                        </div>
                        <div id="countdown"></div>

                        <button id="joinTeamBtn" style="display: none;">Join Your Team</button>
                        {{-- <button id="joinTeamBtn">Join Your Team</button> --}}
                    </div>

                    <div class="congratulation-container" id="welcomeContainer" style="display: none;">
                        <h1>Welcome to {{ $groupName }}</h1>
                        <div class="divider"></div>

                        <!-- Task 1: Cari Teman Kamu -->
                        <div class="text-content">
                            <p>Task 1: <strong>Find Your Team Members</strong></p>
                            <p>Get ready to collaborate with your team and find your friends!</p>
                        </div>

                        <div class="dividerCustom"></div>

                        <!-- Task 2: Vote Ketua Kelompok -->
                        <div class="text-content">
                            <p>Task 2: <strong>Please choose your team Leader</strong></p>
                            <p>Now, it's time to vote for your team leader!</p>
                            <button id="openTask2Modal" class="task-btn">Vote for Team Leader</button>
                        </div>
                    </div>

                    <!-- Task 2: Form Pemilihan Ketua Kelompok -->
                    <div id="task2Modal" style="display: none;">
                        <div class="congratulation-container">
                            <h1>Vote for Your Team Leader</h1>
                            <div class="divider"></div>

                            <!-- Form Pemilihan Ketua -->
                            <form action="{{ route('groups.vote', $group->intGroup_ID) }}" method="POST">
                                @csrf
                                <ul>
                                    @foreach ($members as $member)
                                        <li>
                                            <input type="radio" name="leader_id" value="{{ $member->intUser_ID }}"
                                                id="leader{{ $member->intUser_ID }}">
                                            <label for="leader{{ $member->intUser_ID }}">{{ $member->txtName }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                <button type="submit">Vote</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let startTime = new Date("{{ $countDown->dtmStartTime ?? '' }}").getTime();
            let countdownElement = document.getElementById("countdown");
            let joinButton = document.getElementById("joinTeamBtn");

            function updateCountdown() {
                let now = new Date().getTime();
                let distance = startTime - now;

                if (distance > 0) {
                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownElement.innerHTML = `Starts in: ${hours}h ${minutes}m ${seconds}s`;
                    joinButton.style.display = "none";
                } else {
                    // Saat countdown mencapai 00:00:00, tunggu 1 detik lalu hilangkan teks
                    setTimeout(() => {
                        countdownElement.style.display = "none";
                    }, 1000);

                    joinButton.style.display = "block"; // Tampilkan tombol join
                }
            }

            setInterval(updateCountdown, 1000);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openTask2Modal = document.getElementById('openTask2Modal');
            const task2Modal = document.getElementById('task2Modal');
            const joinTeamBtn = document.getElementById('joinTeamBtn');
            const kataKataContainer = document.getElementById('kata-kata-container');
            const welcomeContainer = document.getElementById('welcomeContainer');
            const openingContainer = document.getElementById('openingContainer');
            const sectionStarted = document.getElementById('section-started');

            // Jika tombol "Start" diklik
            document.getElementById('startButton').addEventListener('click', () => {
                openingContainer.style.display = 'none';
                sectionStarted.style.display = 'block';

                // Memutar video dan mengaktifkan suara
                // const video = document.querySelector(".jarallax-video video");
                // if (video) {
                //     video.muted = false;
                //     video.volume = 1;
                //     video.play();
                // }

                const audio = document.getElementById("backgroundMusic");
                if (audio) {
                    audio.volume = 1; // Atur volume awal
                    audio.play().catch(error => console.error("Autoplay error:", error));
                }

            });

            // Jika tombol "Join Your Team" diklik
            joinTeamBtn.addEventListener('click', () => {
                kataKataContainer.style.display = 'none';
                welcomeContainer.style.display = 'block';
            });

            // Tampilkan Task 2 Modal saat tombol "Vote for Team Leader" diklik
            openTask2Modal.addEventListener('click', () => {
                welcomeContainer.style.display = 'none';
                task2Modal.style.display = 'block';
            });
        });
    </script>
@endsection
