<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>

        <div>
            <h2>Portal E-Learning</h2>
            <span>Akademik Web System</span>
        </div>
    </div>

    <div class="sidebar-section">
        <p class="sidebar-title">Menu Utama</p>

        <div class="sidebar-menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="{{ url('/materi') }}" class="{{ request()->is('materi*') ? 'active' : '' }}">
                <i class="fa-solid fa-book"></i>
                Materi
            </a>
        </div>
    </div>

    <div class="sidebar-section">
        <p class="sidebar-title">Modul Anggota</p>

        <div class="sidebar-menu">
            <a href="{{ url('/siswa') }}" class="{{ request()->is('siswa*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-graduate"></i>
                Siswa
            </a>

            <a href="{{ url('/guru') }}" class="{{ request()->is('guru*') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user"></i>
                Guru
            </a>

            <a href="{{ url('/mata-pelajaran') }}" class="{{ request()->is('mata-pelajaran*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i>
                Mata Pelajaran
            </a>

            <a href="{{ url('/nilai') }}" class="{{ request()->is('nilai*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                Nilai
            </a>
        </div>
    </div>
</aside>