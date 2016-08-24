<script>
    $(document).ready(function () {
        //roles
        $('.arrows').hide();
        $('.fa-caret-down').hide();
        $('.fa-caret-up').show();

        $('.assign-btn').on('click', function () {
            $('.arrows').show();
            $('.fa-caret-down').toggle();
            $('.fa-caret-up').toggle();
            $('.assign-frm').slideToggle();
        })

        //permissions
        $('.arrows-permissions').hide();
        $('.fa-caret-down').hide();
        $('.fa-caret-up').show();

        $('.assign-btn-permissions').on('click', function () {
            $('.arrows-permissions').show();
            $('.fa-caret-down').toggle();
            $('.fa-caret-up').toggle();
            $('.assign-frm-permissions').slideToggle();
        })
    });
</script>