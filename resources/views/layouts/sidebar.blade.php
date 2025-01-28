<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link text-center">
        <!-- <img src="{{ asset('image/logo.png') }}"
             alt="SalamHaji"
             class="brand-image elevation-3 mr-0"
             style="border-radius: 27%;"> -->
        <span class="brand-text font-weight-light">Salam Haji</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
