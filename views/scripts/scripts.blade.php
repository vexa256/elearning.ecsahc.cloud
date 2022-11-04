<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script
    src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}">
</script>

@include('scripts.editor')
<script src="{{ asset('assets/js/pdfobject.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@include('not.not')
<script src="{{ asset('js/notify.js') }}"></script>




@vite(['compiler/compiler.js'])


<script>
    $(document).ready(function() {



        if ($('textarea.editorme').length > 0) {
            CKEDITOR.config.height = 300;
            setTimeout(function() {
                $('textarea.editorme').ckeditor();
            }, 700);
        }

    });
</script>


</body>
<!--end::Body-->

</html>
