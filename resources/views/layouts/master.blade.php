@include('layouts.includes.header')


<div class="wrapper">

    <!-- Navbar -->
    @include('layouts.includes.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.includes.left-sidebar')
    <!-- /.Main Sidebar Container -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @include('layouts.includes.alert')


                    <div class="row mb-2">
                        <div class="col-sm-6">

                            <h1 class="m-0 font-weight-bold">
                                @yield('title')
                            </h1>

                        </div><!-- /.col -->

                        {{--<div class="col-sm-6">
                            @include('layouts.includes.breadcrumb')
                        </div>--}}
                        <!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content justify-content-center">



                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('layouts.includes.right-sidebar')

</div>

@include('layouts.includes.footer')
