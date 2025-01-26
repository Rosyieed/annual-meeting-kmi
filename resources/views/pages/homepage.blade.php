@extends('layouts.master')

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
</style>

@section('content')
    <!-- Section Started -->
    <div class="section started" id="section-started">

        <!-- background -->
        <div id="started-video-bg" class="video-bg media-bg jarallax-video video-mobile-bg"
            data-jarallax-video="mp4:{{ asset('assets/videos/background.mp4') }}"
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
                                    style="display: inline-block; padding: 12px 24px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold;">Survey
                                    Page</a>
                            @elseif (Auth::user() && Auth::user()->intProcessStep == 1)
                                <a href="{{ route('congratulations') }}"
                                    style="display: inline-block; padding: 12px 24px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold;">congratulations
                                    Page</a>
                            @elseif (Auth::user() && Auth::user()->intProcessStep == 2)
                                <a href="#" id="openModalGroup"
                                    style="display: inline-block; padding: 12px 24px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold;">Group
                                    Information</a>
                            @else
                                <a href="#" id="openModal"
                                    style="display: inline-block; padding: 12px 24px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold;">Get
                                    Started</a>
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

    <!-- Modal HTML -->
    <div id="loginModal" class="modal">
        <div class="login-container">
            <div class="close-btn">&times;</div>
            <h1>Login</h1>
            <div class="divider"></div>
            <p>Welcome KMlers! Login to start your Smart, Agile, Beyond journey at KMI Annual Meeting 2025.</p>
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

    @if (Auth::user() && Auth::user()->intProcessStep == 2)
        <div id="groupCheckModal" class="modal">
            <div class="login-container">
                <div class="close-btn-group">&times;</div>
                <h1>Group Information</h1>
                <div class="divider"></div>

                <!-- Group Name -->
                <div class="group-info">
                    <label for="group_name">Group Name</label>
                    <p id="group_name">{{ $group->txtGroupName }}</p>
                </div>

                <!-- Group Members -->
                <div class="group-info">
                    <label for="group_members">Group Members</label>
                    <ul id="group_members">
                        @foreach ($group->members as $member)
                            <li>{{ $member->txtName }}</li> <!-- Display member's name -->
                        @endforeach
                    </ul>
                </div>

                <!-- Leader -->
                <div class="group-info">
                    <label for="leader_id">Leader</label>
                    @if ($group->leader->intUser_ID == Auth::user()->intUser_ID)
                        <p id="leader_name">{{ $group->leader->txtName }} (You)</p> <!-- Display leader's name -->
                    @elseif($group->leader)
                        <p id="leader_name">{{ $group->leader->txtName }}</p> <!-- Display leader's name -->
                    @else
                        <p id="leader_name" class="no-leader">No Leader</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Javascript Loader --}}
    <script>
        // Get modal and buttons
        const loginModal = document.getElementById("loginModal");
        const groupCheckModal = document.getElementById("groupCheckModal");
        const openModalButton = document.getElementById("openModal");
        const openModalGroupButton = document.getElementById("openModalGroup");
        const closeBtn = document.querySelector(".close-btn");
        const closeBtnGroup = document.querySelector(".close-btn-group");


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
    </script>
@endsection
