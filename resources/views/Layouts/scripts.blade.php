<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets/dashboard/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/dashboard/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/demo/chart-pie-demo.js') }}"></script>
{{-- For date in notifications in app.js --}}
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
{{-- For pusher --}}
<script>
    @if(Auth::guard('admin')->check())
        role = "admin";
        adminId = "{{ auth('admin')->user()->id }}";
    @endif
    @if(Auth::guard('web')->check())
        role = "civilian";
        civilianId = "{{ auth('web')->user()->id }}";
    @endif
</script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
