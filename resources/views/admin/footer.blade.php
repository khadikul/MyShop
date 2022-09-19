
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="{{asset('Admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('Admin/js/bootstrap-select.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('Admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('Admin/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('Admin/js/summernote.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('Admin/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('Admin/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('Admin/js/demo/chart-pie-demo.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#productDescription').summernote();
        $('#productShortDes').summernote();
    });

    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('futureImagePreview');
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function pgiOnePreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('gpi1');
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function pgiTwoPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('gpi2');
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function pgiThreePreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('gpi3');
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function pgiFourPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('gpi4');
            preview.src = src;
            preview.style.display = "block";
        }
    }

</script>
</body>

</html>