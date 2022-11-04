</div>
</div>
</div>

@include('modals.modals')
@include('f-exams.Modular')
@include('f-exams.Post')
@include('f-exams.Practical')
@include('Progress.Progress')
@include('f-dashboard.Intro')

@isset($PreTestStatus)
    @if ($PreTestStatus == 'PreTest')
        @include('PreTest.AttemptPreTest')
    @endif

@endisset



@isset($Scoreboard)
    @include('f-scoreboards.Scoreboards')
@endisset

@isset($Analysis)
    @include('f-scoreboards.Analysis')
@endisset

@isset($Certify)
    @if ($Certify == 'true')
        @include('f-scoreboards.Certify')
    @endif
@endisset






<!-- JAVASCRIPT -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('js/print.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script type="text/javascript"
    src="{{ asset('assets/js/standalone/selectize.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script> --}}
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}">
</script>

<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/pdfobject.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
{{-- <script
    src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}">
</script> --}}

@include('not.not')


<script src="{{ asset('js/fslightbox.js') }}"></script>
<script src="{{ asset('assets/js/pdfobject.min.js') }}"></script>


<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>



@isset($Editor)
    <script src="{{ asset('js/jquery.steps.js') }}"></script>
    @include('scripts.editor')
@endisset
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js">
</script>
<script src="{{ asset('js/front.js') }}"></script>


</body>


</html>
