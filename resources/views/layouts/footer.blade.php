
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmn2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmn2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmn2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>   
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmn2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    
    @session('success')
    <script>
        Swal.fire({
        title: "Sukses",
        text: "{{ session('success') }}",
        icon: "success"
        });
    </script>
    @endsession
    @session('error')
    <script>
        Swal.fire({
        title: "Gagal",
        text: "{{ session('error') }}",
        icon: "error"
        });
    </script>
    @endsession

</body>

</html>

</body>

</html>