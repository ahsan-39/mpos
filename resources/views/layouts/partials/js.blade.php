<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/js/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<!-- Bootstrap Select -->
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>

<script>
    $(document).ready(function() {
        const $body = $("body");
        const $sidebar = $(".sidebar");
        const $sidebarToggle = $("#sidebar-toggle");

        $sidebarToggle.click(function(e) {
            e.stopPropagation(); // Prevent the click event from propagating

            // Toggle the "sidebar-collapse" class on the body tag
            $body.toggleClass("sidebar-collapse");
        });

        $(document).click(function(e) {
            // Check if the click occurred outside of the sidebar
            if (!$sidebar.is(e.target) && $sidebar.has(e.target).length === 0) {
                // Add the "sidebar-collapse" class back to the body tag
                $body.addClass("sidebar-collapse");
            }
        });
    });
</script>