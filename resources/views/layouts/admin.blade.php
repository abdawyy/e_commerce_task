<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    <style>
     
    </style>
</head>

<body>

    <!-- Mobile Navbar -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <button class="btn btn-outline-light" id="menu-toggle">☰</button>
            <span class="navbar-brand mb-0 h1">Admin Panel</span>
        </div>
    </nav>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white p-3" id="sidebar">
            <!-- Sidebar Header -->
            <div>
                <h4 class="p-3 border-bottom">Admin Panel</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Menu</h5>
                    <button class="btn btn-sm btn-outline-light d-md-none" id="close-sidebar">&times;</button>
                </div>
            </div>

            <!-- Admin Section -->
            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#adminMenu"
                role="button" aria-expanded="false" aria-controls="adminMenu">
                Admin <span class="bi bi-chevron-down"></span>
            </a>
            <div class="collapse submenu ps-3" id="adminMenu">
                <a href="{{ route('admin.index') }}" class="d-block text-white">Index</a>
                <a href="{{ route('admin.create') }}" class="d-block text-white">Create</a>
            </div>

            <!-- Product Section -->
            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#productMenu"
                role="button" aria-expanded="false" aria-controls="productMenu">
                Product <span class="bi bi-chevron-down"></span>
            </a>
            <div class="collapse submenu ps-3" id="productMenu">
                <a href="{{ route('products.index') }}" class="d-block text-white">Index</a>
                <a href="{{ route('products.create') }}" class="d-block text-white">Create</a>
            </div>

            <!-- categories Section -->
            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#categoriesMenu" role="button" aria-expanded="false" aria-controls="categoriesMenu">
                categories <span class="bi bi-chevron-down"></span>
            </a>
            <div class="collapse submenu ps-3" id="categoriesMenu">
                <a href="{{ route('categories.index') }}" class="d-block text-white">Index</a>
                <a href="{{ route('categories.create') }}" class="d-block text-white">Create</a>
            </div>

            <!-- Guest Users Section -->
            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#guestMenu"
                role="button" aria-expanded="false" aria-controls="guestMenu">
                Guest Users <span class="bi bi-chevron-down"></span>
            </a>
            <div class="collapse submenu ps-3" id="guestMenu">
                <a href="{{ route('guests.index') }}" class="d-block text-white">Index</a>
            </div>

            <!-- Orders Section -->
            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#orderMenu"
                role="button" aria-expanded="false" aria-controls="orderMenu">
                Orders <span class="bi bi-chevron-down"></span>
            </a>
            <div class="collapse submenu ps-3" id="orderMenu">
                <a href="{{ route('orders.index') }}" class="d-block text-white">Index</a>
            </div>

            <!-- Product Logs Section -->
            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#logsMenu"
                role="button" aria-expanded="false" aria-controls="logsMenu">
                Product Logs <span class="bi bi-chevron-down"></span>
            </a>
            <div class="collapse submenu ps-3" id="logsMenu">
                <a href="{{ route('product-logs.index') }}" class="d-block text-white">Index</a>
            </div>
        </div>

        <!-- Overlay for mobile -->
        <div id="overlay"></div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            const overlay = document.getElementById('overlay');

            // Open sidebar
            menuToggle.addEventListener('click', () => {
                sidebar.style.transform = 'translateX(0)';
                overlay.style.display = 'block';
            });

            // Close sidebar (button)
            closeSidebar.addEventListener('click', () => {
                sidebar.style.transform = 'translateX(-100%)';
                overlay.style.display = 'none';
            });

            // Close sidebar (overlay)
            overlay.addEventListener('click', () => {
                sidebar.style.transform = 'translateX(-100%)';
                overlay.style.display = 'none';
            });
        });
    </script>

</body>

</html>