@extends('user-layouts.master')

<style>
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
                    <!-- Konten yang sebelumnya ada di modal -->
                    <div class="congratulation-container" id="welcomeContainer">
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
                    <div id="task2Modal" style="display: none;" >
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
        document.addEventListener('DOMContentLoaded', () => {
            const openTask2Modal = document.getElementById('openTask2Modal');
            const task2Modal = document.getElementById('task2Modal');
            const welcomeContainer = document.getElementById('welcomeContainer');

            // Tampilkan Task 2 Modal saat tombol "Vote for Team Leader" diklik
            openTask2Modal.addEventListener('click', () => {
                welcomeContainer.style.display = 'none';
                task2Modal.style.display = 'block';
            });
        });
    </script>
@endsection
