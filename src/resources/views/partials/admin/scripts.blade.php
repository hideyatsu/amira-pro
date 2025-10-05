<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- jQuery (if needed) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Global JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // CSRF Token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>
