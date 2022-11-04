</div>
<div class="modal fade" id="Certify">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Hello {{ Auth::user()->name }}, This is
                    your scoreboard
                    <span class="text-danger">
                        <small>This will be populated fully when you attempt all
                            the tests. The certify button only becomes active
                            when all tests are passed</small>
                    </span>

                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                @include('f-scoreboards.Table')

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    data-bs-dismiss="modal">Close</button>

                {{-- <button type="submit" class="btn btn-dark">Save
                    Changes</button> --}}


            </div>

        </div>
    </div>
</div>
