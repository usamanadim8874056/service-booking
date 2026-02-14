<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright © {{ date('Y') }} <a href="{{ url('') }}" target="_blank">{{ $siteInfo->com_name }}</a></strong>
</footer>
<input type="hidden" class="demo" value="{{ url('/') }}"></input>
<!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('public/assets/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('public/assets/js/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('public/assets/js/bs-custom-file-input.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('public/assets/js/daterangepicker.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/assets/js/adminlte.js') }}"></script>

<!-- jquery-validation -->
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/assets/js/additional-methods.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('public/assets/js/summernote-bs4.min.js') }}"></script>
<!-- SweetAlert -->
<script src="{{ asset('public/assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/assets/js/select2.min.js') }}"></script>
<!-- Main_ajax.js -->
<script src="{{ asset('public/assets/js/main_ajax.js') }}"></script>

<input type="hidden" class="demo" value="{{ url('/') }}"></input>
<script>
    $(function() {

        $('.select2').select2();


        //Money Euro
        $('[data-mask]').inputmask()
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
<script>
    $(function() {
        // Summernote
        $('.textarea').summernote()
    })
</script>
@yield('pageJsScripts')
</body>

</html>
