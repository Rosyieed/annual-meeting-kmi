<style>
    .responsive-logo {
        max-width: 100%;
        height: auto;
        /* Menjaga aspek rasio gambar */
    }

    .head-top {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo-left img,
    .logo-right img {
        max-width: 185px;
        /* Ukuran maksimum untuk logo */
    }

    @media (max-width: 768px) {

        .logo-left img,
        .logo-right img {
            max-width: 140px;
            /* Ukuran lebih kecil untuk layar medium */
        }
    }

    @media (max-width: 480px) {

        .logo-left img,
        .logo-right img {
            max-width: 100px;
            /* Ukuran lebih kecil untuk layar kecil */
        }
    }

    .logout-btn {
        margin-left: 20px;
    }

    .logout-btn a {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .logout-btn a:hover {
        background-color: #45a049;
    }
</style>

<header class="header">
    <div class="head-top" style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">

        <!-- Logo kiri -->
        <div class="logo-left">
            <a href="#">
                <img src="{{ asset('user-assets/images/logo/logo kmi.png') }}" alt="Logo Kiri" class="responsive-logo">
            </a>
        </div>

        <!-- Logo kanan -->
        <div class="logo-right">
            <a href="#">
                <img src="{{ asset('user-assets/images/logo/Logo.png') }}" alt="Logo Kanan" class="responsive-logo">
            </a>
        </div>

    </div>
</header>
