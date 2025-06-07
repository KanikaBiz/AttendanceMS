@include('admin.layouts.partials.head')

<body class="hold-transition sidebar-mini">
  <script>
    const onErrorImage = (e) => {
      e.target.src = "{{ errorImageUrl() }}";
    };
  </script>
  <div class="wrapper">

    <!-- Navbar -->
    @include('admin.layouts.partials.top_navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.layouts.partials.left_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('admin.layouts.partials.breadcrumb')
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @yield('content')
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    @include('admin.layouts.partials.control_sidebar')
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('admin.layouts.partials.footer')
  </div>
  <!-- ./wrapper -->

  @include('admin.layouts.partials.script')
</body>

</html>
