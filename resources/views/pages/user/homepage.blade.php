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
        text-align: center;
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

    .modal.hide {
        display: flex;
        opacity: 0;
        animation: fadeOut 0.3s ease-in-out;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    .login-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        position: relative;
        z-index: 10000;
        /* Make sure the login form is above other elements */
    }

    .login-container h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .login-container p {
        font-size: 14px;
        color: #333;
        margin-bottom: 20px;
    }

    .login-container label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
        font-size: 14px;
        color: #333;
    }

    .login-container input[type="number"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        color: #333
    }

    .login-container button {
        width: 100%;
        padding: 10px;
        background-color: #f1f1de !important;
        border: none;
        border-radius: 5px;
        color: black !important;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        z-index: 500000;
        /* Ensure the button stays on top */
        text-align: center;
    }

    .login-container button:hover {
        background-color: #ffffca !important;
    }

    .login-container .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        z-index: 8000;
        /* Ensure the close button stays on top */
    }

    .login-container .close-btn-group {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        z-index: 8000;
        /* Ensure the close button stays on top */
    }

    .login-container .divider {
        width: 60%;
        height: 2px;
        background-color: #d3d3d3;
        margin: 10px auto 20px;
    }

    .group-info {
        margin-bottom: 20px;
    }

    .group-info label {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        display: block;
        margin-bottom: 10px;
    }

    .group-info p,
    .group-info ul {
        font-size: 15px;
        color: #555;
        line-height: 1.6;
    }

    .group-info ul {
        padding-left: 0;
        margin: 0;
        list-style-type: none;
    }

    .group-info ul li {
        padding: 8px;
        background-color: #f9f9f9;
        border-radius: 5px;
        margin-bottom: 5px;
        transition: background-color 0.3s ease;
    }

    .group-info ul li:hover {
        background-color: #f1f1de;
    }

    .group-info .no-leader {
        font-style: italic;
        color: #888;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-btn {
        padding: 12px 24px;
        background-color: #f1f1de !important;
        color: #000;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        min-width: 200px;
        z-index: 1;
        bottom: 100%;
        left: -100px;
        transform: translateY(-5px);
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .dropdown-content a {
        color: black;
        padding: 10px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    /* Container Dynamic Modal */
    /* Style untuk container login di dalam modal */
    .dynamic-modal-container {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    /* Style untuk tombol close */
    .close-btn-dynamic {
        position: absolute;
        right: 20px;
        top: 10px;
        font-size: 28px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
    }

    .close-btn-dynamic:hover,
    .close-btn-dynamic:focus {
        color: #000;
        text-decoration: none;
    }

    /* Style untuk judul modal */
    h1 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
    }

    /* Style untuk divider */
    .divider {
        border-bottom: 1px solid #ddd;
        margin: 10px 0;
    }

    /* Style untuk konten modal */
    .modal-content {
        margin-top: 20px;
        font-size: 12px;
    }

    /* Style untuk setiap info di dalam modal */
    .modal-info {
        margin-bottom: 15px;
        font-size: 12px;
    }

    .modal-info label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
        font-size: 12px;
    }

    .modal-info p {
        margin: 0;
        color: #333;
        font-size: 12px;
    }

    /* Style untuk gambar di dalam modal */
    #modal_image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 10px;
        display: block;
    }

    /* Style untuk link di dalam modal */
    #modal_link {
        color: #007bff;
        text-decoration: none;
    }

    #modal_link:hover {
        text-decoration: underline;
    }

    /* Styling kontainer dalam modal */
    .geeting-container {
        background: white !important;
        padding: 20px;
        width: 90%;
        max-width: 400px;
        border-radius: 10px;
        text-align: center;
        position: relative;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Styling untuk tombol */
    .button-geeting {
        background-color: #f1f1de !important;
        color: #000;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 10px;
        width: 100%;
        text-align: center;
    }

    .button-geeting:disabled {
        background-color: #ccc !important;
        cursor: not-allowed;
    }

    /* Styling untuk video kamera */
    #cameraPreview {
        width: 100%;
        border-radius: 5px;
        border: 2px solid #ddd !important;
    }

    /* Styling untuk preview gambar */
    #photoPreview {
        width: 100%;
        max-height: 300px;
        border-radius: 5px;
        margin-top: 10px;
        border: 2px solid #ddd !important;
    }

    /* Styling untuk form input */
    .geeting-container input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-top: 8px;
        border: 1px solid #ccc !important;
        border-radius: 5px;
        color: #333 !important
    }
</style>

@section('content')
    <!-- Section Started -->
    <div class="section started" id="section-started">

        <!-- background -->
        <div id="started-video-bg" class="video-bg media-bg jarallax-video video-mobile-bg"
            data-jarallax-video="mp4:{{ asset('user-assets/videos/background.mp4') }}"
            data-mobile-preview="images/started_image_p.jpg" data-volume="0" muted>
            <div class="video-bg-mask"></div>
            <div class="video-bg-texture" id="grained_container"></div>
        </div>

        <!-- started content -->
        <div class="centrize full-width">
            <div class="vertical-center">
                <div class="started-content">
                    <div class="h-title">
                        <div class="button-container">
                            @if (Auth::user() && Auth::user()->intProcessStep == 0)
                                <a href="{{ route('question') }}"
                                    style="display: inline-block; padding: 10px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 14px; border-radius: 5px; font-weight: bold; width: 110px;">Survey
                                    Page</a>
                            @elseif (Auth::user() && Auth::user()->intProcessStep == 1)
                                <a href="{{ route('congratulations') }}"
                                    style="display: inline-block; padding: 10px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 14px; border-radius: 5px; font-weight: bold; width: 110px;">Task
                                    Page</a>
                            @elseif (Auth::user() && Auth::user()->intProcessStep == 2)
                                <a href="#" id="openModalGroup"
                                    style="display: inline-block; padding: 10px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 14px; border-radius: 5px; font-weight: bold; width: 110px;">Group
                                    Information</a>
                            @else
                                <a href="#" id="openModal"
                                    style="display: inline-block; padding: 10px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 14px; border-radius: 5px; font-weight: bold; width: 110px;">Get
                                    Started</a>
                            @endif
                            @if (Auth::user() && $buttons->count() > 0)
                                <div class="dropdown" style="margin-left: 10px;">
                                    <a class="dropdown-btn"
                                        style="display: inline-block; padding: 10px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 14px; border-radius: 5px; font-weight: bold; width: 110px;">Event</a>
                                    <div class="dropdown-content">
                                        @foreach ($buttons as $button)
                                            <a href="#" class="open-dynamic-modal"
                                                style="display: inline-block; padding: 10px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 14px; border-radius: 5px; font-weight: bold; margin-bottom: 10px;"
                                                data-id="{{ $button->intEventInformation_ID }}">
                                                {{ $button->txtModalTitle }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user())
                                <a href="#" id="openModalGeetingCommitment"
                                    style="margin-left: 10px; display: none; padding: 10px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 12px; border-radius: 5px; font-weight: bold; width: 110px;">
                                    Getting Commitment
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="h-subtitle typing-subtitle">
                        <p><span style="color: #f1f1de">PREPARE FOR THE</span> <strong style="color: #F22121"> NEXT MISSION</strong></p>
                        <p><span style="color: #f1f1de">"SMILE"</span> <br> <strong style="color: #F22121"> SMART-AGILE-BEYOND</strong></p>
                        <p><span style="color: #f1f1de">ANNUAL MEETING KMI</span> <strong style="color: #F22121"> 2025</strong>
                        </p>
                    </div>
                    <span class="typed-subtitle"></span>
                </div>
            </div>
        </div>
    </div>

    @auth
        {{-- Modal dinamis --}}
        @foreach ($buttons as $button)
            <!-- Dynamic Modal -->
            <div id="dynamicModal{{ $button->intEventInformation_ID }}" class="modal">
                <div class="login-container" style="max-width: 600px;">
                    <div class="close-btn-dynamic" data-id="{{ $button->intEventInformation_ID }}">&times;</div>
                    <h1>{{ $button->txtModalTitle }}</h1>
                    <div class="divider"></div>

                    <!-- Modal Content -->
                    <div class="modal-content">
                        <div class="modal-info">
                            <label for="modal_title">Title</label>
                            <p id="modal_title">{{ $button->txtModalTitle }}</p>
                        </div>

                        @if ($button->txtModalContent)
                            <div class="modal-info">
                                <label for="modal_content">Content</label>
                                <p id="modal_content">{{ $button->txtModalContent }}</p>
                            </div>
                        @endif

                        @if ($button->txtModalImagePath)
                            <div class="modal-info">
                                <label for="modal_image">Image</label>
                                <a href="{{ asset('storage/' . $button->txtModalImagePath) }}" target="_blank">
                                    <img id="modal_image" src="{{ asset('storage/' . $button->txtModalImagePath) }}"
                                        alt="Modal Image">
                                </a>
                            </div>
                        @endif

                        @if ($button->txtModalLink)
                            <div class="modal-info">
                                <label for="modal_link">Link</label>
                                <a id="modal_link" href="{{ $button->txtModalLink }}">{{ $button->txtModalLink }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endauth

    <!-- Modal HTML -->
    <div id="loginModal" class="modal">
        <div class="login-container">
            <div class="close-btn">&times;</div>
            <h1>Login</h1>
            <div class="divider"></div>
            <p>Welcome KMlers! Login to start your <strong>SMILE</strong> (Smart, Agile, Beyond) journey at KMI Annual
                Meeting 2025.</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="nik">NIK</label>
                <input type="number" id="nik" name="nik" placeholder="Enter your NIK">
                @error('nik')
                    <p style="color: red">{{ $message }}</p>
                @enderror
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                @error('password')
                    <p style="color: red">{{ $message }}</p>
                @enderror
                <button class="button" type="submit">Login</button>
            </form>
        </div>
    </div>

    <!-- Modal Geeting Commitment -->
    <div id="geetingCommitmentModal" class="modal">
        <div class="geeting-container">
            <div class="close-btn" onclick="closeGeetingModal()">&times;</div>
            <h1>Getting Commitment</h1>
            <div class="divider"></div>

            <!-- Step 1: Ambil Foto dari Kamera -->
            <div id="photoStep">
                <p style="color: black !important">Take a photo</p>

                <!-- Video Kamera (Akan Diganti oleh Foto) -->
                <video id="cameraPreview" autoplay></video>

                <!-- Gambar Preview (Awalnya Tersembunyi) -->
                <img id="photoPreview" style="display: none; max-width: 100%; margin-top: 10px;">

                <!-- Tombol untuk Capture dan Lanjut -->
                <button class="button-geeting" id="captureBtn">Capture</button>
                <canvas id="canvas" style="display: none;"></canvas>
                <button class="button-geeting" id="nextStepBtn" style="display: none;">Next</button>
            </div>


            <!-- Step 2: Input Geeting Commitment -->
            <div id="commitmentStep" style="display: none;">
                <p style="color: #333 !important">Enter your Getting Commitment</p>
                <form action="{{ route('geeting-commitment.store-user') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="photo" id="hiddenPhoto">
                    <label for="geetingText" style="color: #333 !important">Please enter your commitment in three
                        words.</label>
                    <input type="text" id="geetingText" name="geetingText" placeholder="Enter your commitment..."
                        required>
                    <button class="button-geeting" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>


    @if (Auth::user() && Auth::user()->intProcessStep == 2)
        <!-- Modal HTML -->
        <div id="groupCheckModal" class="modal">
            <div class="login-container">
                <div class="close-btn-group">&times;</div>
                <h1>Group Information</h1>
                <div class="divider"></div>

                <!-- Group Name -->
                <div class="group-info">
                    <label for="group_name">Group Name</label>
                    <p id="group_name"></p>
                </div>

                <!-- Group Members -->
                <div class="group-info">
                    <label for="group_members">Group Members</label>
                    <ul id="group_members"></ul>
                </div>

                <!-- Leader -->
                <div class="group-info">
                    <label for="leader_id">Leader</label>
                    <p id="leader_name"></p>
                </div>
            </div>
        </div>
    @endif

    {{-- Javascript Loader --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Get modal and buttons
        const loginModal = document.getElementById("loginModal");
        const groupCheckModal = document.getElementById("groupCheckModal");
        const openModalButton = document.getElementById("openModal");
        const openModalGroupButton = document.getElementById("openModalGroup");
        const closeBtn = document.querySelector(".close-btn");
        const closeBtnGroup = document.querySelector(".close-btn-group");
        const sectionStarted = document.getElementById('section-started');

        if (openModalGroupButton) {
            openModalGroupButton.addEventListener("click", function(event) {
                event.preventDefault();
                groupCheckModal.classList.add("show");
                openModalGroupButton.style.display = "none";
            });
        }

        if (openModalButton) {
            openModalButton.addEventListener("click", function(event) {
                event.preventDefault();
                loginModal.classList.add("show");
                openModalButton.style.display = "none";
            });
        }

        // Close modal when the close button is clicked
        closeBtn.addEventListener("click", function() {
            loginModal.classList.remove("show");
            loginModal.classList.add("hide");
            setTimeout(function() {
                loginModal.classList.remove("hide");
            }, 300);
            openModalButton.style.display = "inline-block";
        });

        // Close modal when the close button is clicked
        closeBtnGroup.addEventListener("click", function() {
            groupCheckModal.classList.remove("show");
            groupCheckModal.classList.add("hide");
            setTimeout(function() {
                groupCheckModal.classList.remove("hide");
            }, 300);
            openModalGroupButton.style.display = "inline-block";
        });

        // Close modal if clicked outside the modal content
        window.addEventListener("click", function(event) {
            if (event.target === loginModal) {
                loginModal.classList.remove("show");
                loginModal.classList.add("hide");
                setTimeout(function() {
                    loginModal.classList.remove("hide");
                }, 300);
                openModalButton.style.display = "inline-block";
            }
        });

        // Close modal if clicked outside the modal content
        window.addEventListener("click", function(event) {
            if (event.target === groupCheckModal) {
                groupCheckModal.classList.remove("show");
                groupCheckModal.classList.add("hide");
                setTimeout(function() {
                    groupCheckModal.classList.remove("hide");
                }, 300);
                openModalGroupButton.style.display = "inline-block";
            }
        });

        // AJAX to fetch group information
        if (openModalGroupButton) {
            openModalGroupButton.addEventListener("click", function(event) {
                event.preventDefault();

                // Show loading state (optional)
                groupCheckModal.classList.add("show");

                // Fetch group data via AJAX
                function fetchGroupData() {
                    fetch("{{ route('get-group-information') }}")
                        .then(response => response.json())
                        .then(data => {
                            // Populate modal with fetched data
                            document.getElementById('group_name').innerText = data.groupName;
                            const groupMembersList = document.getElementById('group_members');
                            groupMembersList.innerHTML = ''; // Clear previous members
                            data.members.forEach(member => {
                                const li = document.createElement('li');
                                li.textContent = member;
                                groupMembersList.appendChild(li);
                            });
                            document.getElementById('leader_name').innerText = data.leader;
                        })
                        .catch(error => {
                            console.error('Error fetching group data:', error);
                            // Handle error appropriately
                        });
                }

                // Initial fetch when the modal opens
                fetchGroupData();

                // Periodically fetch data (every 30 seconds, for example)
                const refreshInterval = setInterval(fetchGroupData, 1000);

                // Stop refreshing when the modal is closed
                closeBtnGroup.addEventListener("click", function() {
                    clearInterval(refreshInterval);
                    groupCheckModal.classList.remove("show");
                    groupCheckModal.classList.add("hide");
                    setTimeout(function() {
                        groupCheckModal.classList.remove("hide");
                    }, 300);
                    openModalGroupButton.style.display = "inline-block";
                });
            });
        }
    </script>

    <script>
        // Handle button untuk membuka modal dinamis
        document.querySelectorAll('.open-dynamic-modal').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const modalId = this.getAttribute('data-id');
                const modal = document.getElementById(`dynamicModal${modalId}`);
                modal.classList.add('show');
            });
        });

        // Handle button untuk menutup modal dinamis
        document.querySelectorAll('.close-btn-dynamic').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-id');
                const modal = document.getElementById(`dynamicModal${modalId}`);
                modal.classList.remove('show');
            });
        });

        // Handle klik di luar modal untuk menutup modal
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownBtn = document.querySelector(".dropdown-btn");
            const dropdownContent = document.querySelector(".dropdown-content");

            dropdownBtn.addEventListener("click", function(event) {
                event.stopPropagation(); // Mencegah event bubbling
                const isOpen = dropdownContent.style.display === "block";

                // Sembunyikan semua dropdown sebelum membuka yang baru
                document.querySelectorAll(".dropdown-content").forEach(content => {
                    content.style.display = "none";
                    content.style.opacity = "0";
                });

                // Tampilkan dropdown jika belum terbuka
                if (!isOpen) {
                    dropdownContent.style.display = "block";
                    setTimeout(() => {
                        dropdownContent.style.opacity = "1";
                    }, 10);
                }
            });

            // Klik di luar dropdown untuk menutupnya
            document.addEventListener("click", function(event) {
                if (!dropdownBtn.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.style.opacity = "0";
                    setTimeout(() => {
                        dropdownContent.style.display = "none";
                    }, 200);
                }
            });
        });
    </script>

    <script>
        // Buka modal saat tombol diklik
        document.getElementById("openModalGeetingCommitment").addEventListener("click", function() {
            document.getElementById("geetingCommitmentModal").style.display = "flex";
            startCamera();
        });

        // Tutup modal
        function closeGeetingModal() {
            document.getElementById("geetingCommitmentModal").style.display = "none";
            stopCamera();
        }

        // Mulai kamera saat modal dibuka
        function startCamera() {
            let video = document.getElementById("cameraPreview");

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(err) {
                    console.error("Error accessing camera:", err);
                    alert("Could not access camera. Please check your permissions.");
                });
        }

        // Hentikan kamera saat modal ditutup
        function stopCamera() {
            let video = document.getElementById("cameraPreview");
            let stream = video.srcObject;
            if (stream) {
                let tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
                video.srcObject = null;
            }
        }

        // Tangkap gambar dari kamera
        document.getElementById("captureBtn").addEventListener("click", function() {
            let video = document.getElementById("cameraPreview");
            let canvas = document.getElementById("canvas");
            let photoPreview = document.getElementById("photoPreview");
            let captureBtn = document.getElementById("captureBtn"); // Ambil tombol Capture
            let nextStepBtn = document.getElementById("nextStepBtn");

            let context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Konversi ke base64 untuk dikirim ke backend
            let photoData = canvas.toDataURL("image/png");
            document.getElementById("hiddenPhoto").value = photoData;

            // Tampilkan preview foto menggantikan video
            photoPreview.src = photoData;
            photoPreview.style.display = "block";
            video.style.display = "none"; // Sembunyikan kamera

            // Sembunyikan tombol Capture
            captureBtn.style.display = "none";

            // Munculkan tombol "Next"
            nextStepBtn.style.display = "inline-block";
        });



        // Lanjut ke langkah 2 (input geeting commitment)
        document.getElementById("nextStepBtn").addEventListener("click", function() {
            document.getElementById("photoStep").style.display = "none";
            document.getElementById("commitmentStep").style.display = "block";
        });
    </script>

    <script>
        function checkGeetingButton() {
            $.ajax({
                url: "{{ url('/geeting-commitments/check-geeting-button') }}",
                type: "GET",
                success: function(response) {
                    if (response.buttonVisible && !response.hasSubmittedGeeting) {
                        $("#openModalGeetingCommitment").show();
                    } else {
                        $("#openModalGeetingCommitment").hide();
                    }
                }
            });
        }

        // Panggil pertama kali saat halaman dimuat
        $(document).ready(function() {
            checkGeetingButton();

            // Periksa status tombol setiap 10 detik
            setInterval(checkGeetingButton, 1000);
        });
    </script>
@endsection
