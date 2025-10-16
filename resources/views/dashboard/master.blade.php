<!DOCTYPE html>
<html lang="en">
@include('dashboard.partials.header')

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('dashboard.partials.nav')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('dashboard.partials.sidebar')
            <!-- partial -->
            @yield('content')
            
            <!-- main-panel ends -->
            @include('dashboard.partials.footer')
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('dashboard.partials.scripts')
</body>

</html>
