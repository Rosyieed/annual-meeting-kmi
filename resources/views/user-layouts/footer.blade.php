<footer class="footer">
    {{-- <div class="copy">
        <p>E: alejandroa@gmail.com</p>
        <p>T: +1 (234) 567 80 98</p>
    </div> --}}
    <div class="soc-box" style="color: #f1f1de">
        <div class="follow-label" style="color: #f1f1de">
            &copy; 2025 KMI. All Rights Reserved.
        </div>
        <div class="soc">
            {{-- <a target="_blank" href="https://id.linkedin.com/company/pt-kalbe-morinaga-indonesia">
                <span class="icon fab fa-linkedin-in" style="color: #f1f1de"></span>
            </a> --}}
            <a target="_blank" href="https://www.instagram.com/one.kmi">
                <span class="icon fab fa-instagram" style="color: #f1f1de"></span>
            </a>
            @if(Auth::check())
                <a href="{{ route('home') }}">
                    <span class="icon fas fa-home" style="color: #f1f1de"></span>
                </a>
            @endif
            @if (Auth::check() && Auth::user()->role->txtRole == 'Admin')
                <a href="{{ route('admin.dashboard') }}">
                    <span class="icon fas fa-tachometer-alt" style="color: #f1f1de"></span>
                </a>
            @endif
            @if (Auth::check())
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="icon fas fa-sign-out-alt" style="color: #f1f1de"></span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif
        </div>
    </div>
    <div class="clear"></div>
</footer>
