    @extends('user-layouts.master')

    <style>
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

        .congratulation-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        .congratulation-container h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .congratulation-container p {
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }

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
            text-align: center
        }

        .congratulation-container .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>

    @section('content')
        <div class="section started" id="section-started">

            <!-- Background -->
            <div id="started-video-bg" class="video-bg media-bg jarallax-video video-mobile-bg"
                data-jarallax-video="mp4:{{ asset('user-assets/videos/background.mp4') }}">
                <div class="video-bg-mask"></div>
                <div class="video-bg-texture" id="grained_container"></div>
            </div>

            <div class="centrize full-width">
                <div class="vertical-center">
                    <div class="started-content">
                        <div class="h-title"></div>
                        <div class="h-subtitle typing-subtitle">
                            <a href="#" id="openModalCongratulation"
                                style="display: inline-block; padding: 1px 24px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold;">
                                Join Your Team
                            </a>
                        </div>
                        <span class="typed-subtitle"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Congratulation Modal -->
        <div id="congratulation" class="modal">
            <div class="congratulation-container">
                <div class="close-btn">&times;</div>
                <h1>Congratulations</h1>
                <div class="divider"></div>

                <!-- Ucapan Kata Kata -->
                <div class="text-content" style="text-align: left;">
                    <p>Great news, <strong>{{ $userName }}</strong>!</p>
                    <p>Thank you for completing the survey.</p>
                    <p>Get ready to work together, tackle exciting challenges, and make this experience unforgettable. We're
                        thrilled to have you on board!</p>
                </div>
                <div id="countdown"></div>

                <button id="joinTeamBtn" style="display: none;">Join Your Team</button>
            </div>
        </div>

        <!-- Join Team Modal -->
        <div id="joinTeamModal" class="modal">
            <div class="congratulation-container">
                <div class="close-btn" id="closeJoinTeamModal">&times;</div>
                <h1>Welcome to {{ $groupName }}</h1>
                <div class="divider"></div>

                <!-- Task 1: Cari Teman Kamu -->
                <div class="text-content" style="text-align: left;">
                    <p>Task 1: <strong>Find Your Teams member</strong></p>
                    <p>Get ready to collaborate with your team and find your friends!</p>
                    {{-- <button id="openTask1Modal" class="task-btn">Proceed to Task 1</button> --}}
                </div>

                <div class="dividerCustom"></div>

                <!-- Task 2: Vote Ketua Kelompok -->
                <div class="text-content" style="text-align: left;">
                    <p>Task 2: <strong>Please choose your team Leader</strong></p>
                    <p>Now, it's time to vote for your team leader!</p>
                    <button id="openTask2Modal" class="task-btn">Vote for Team Leader</button>
                </div>
            </div>
        </div>

        <!-- Task 2 Modal - Pemilihan Ketua Kelompok -->
        <div id="task2Modal" class="modal">
            <div class="congratulation-container">
                <div class="close-btn" id="closeTask2Modal">&times;</div>
                <h1>Vote for Your Team Leader</h1>
                <div class="divider"></div>

                <!-- Form Pemilihan Ketua -->
                <form action="{{ route('groups.vote', $group->intGroup_ID) }}" method="POST">
                    @csrf
                    <ul>
                        @foreach ($members as $member)
                            <input type="radio" name="leader_id" value="{{ $member->intUser_ID }}"
                                id="leader{{ $member->intUser_ID }}">
                            <label style="color: rgba(0, 0, 0, 0.5)"
                                for="leader{{ $member->intUser_ID }}">{{ $member->txtName }}</label>
                        @endforeach
                    </ul>
                    <button type="submit">Vote</button>
                </form>
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
                const modal = document.getElementById('congratulation');
                const closeBtn = modal.querySelector('.close-btn');
                const joinTeamBtn = document.getElementById('joinTeamBtn');
                const joinTeamModal = document.getElementById('joinTeamModal');
                const closeJoinTeamModal = document.getElementById('closeJoinTeamModal');
                const task2Modal = document.getElementById('task2Modal');
                const closeTask2Modal = document.getElementById('closeTask2Modal');
                const openTask2Modal = document.getElementById('openTask2Modal');
                const openModalCongratulation = document.getElementById('openModalCongratulation');

                // Cek apakah ada session yang mengindikasikan error atau status tertentu
                @if (session('show_congratulation_modal'))
                    modal.classList.remove('show');
                @endif

                // Show the congratulation modal when the "Join Your Team" button is clicked
                openModalCongratulation.addEventListener('click', () => {
                    modal.classList.add('show');
                });

                // Close the congratulation modal
                closeBtn.addEventListener('click', () => {
                    modal.classList.remove('show');
                });

                // Show the Join Team modal when the "Join Your Team" button is clicked
                joinTeamBtn.addEventListener('click', () => {
                    modal.classList.remove('show');
                    joinTeamModal.classList.add('show');
                });

                // Close the Join Team modal
                closeJoinTeamModal.addEventListener('click', () => {
                    joinTeamModal.classList.remove('show');
                });

                // Open Task 2 modal for voting team leader
                openTask2Modal.addEventListener('click', () => {
                    joinTeamModal.classList.remove('show');
                    task2Modal.classList.add('show');
                });

                // Close Task 2 modal
                closeTask2Modal.addEventListener('click', () => {
                    task2Modal.classList.remove('show');
                });
            });
        </script>
    @endsection
