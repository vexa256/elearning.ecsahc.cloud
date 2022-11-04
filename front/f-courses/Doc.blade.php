<div class="col-md-4 col-sm-6 project-card">
    <div class="card card-height-100">
        <div class="card-body">
            <div class="d-flex flex-column h-100 ">
                <div class="d-flex ">
                    <div class="flex-grow-1">

                        <div class="card-header bg-success shadow-lg">
                            <p class="card-title text-light">


                                Documemt Notes
                            </p>
                        </div>

                    </div>

                </div>
                <div class="d-flex mb-2">
                    <div class="flex-shrink-2 me-3">
                        <div class="avatar-lg mt-2">
                            <span
                                class="avatar-title bg-soft-warning rounded p-2">
                                <img src="{{ asset('img/docs.svg') }}"
                                    alt="" class="img-fluid p-1">
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1 mt-4">
                        <h5 class="mb-1 fs-15"><a
                                href="apps-projects-overview.html"
                                class="text-dark">Document Notes</a>
                        </h5>
                        <p class="text-muted text-truncate-two-lines mb-3">
                            Click view notes to explore the notes format
                            resources
                            attached to this course</p>
                    </div>
                </div>
                <div class="mt-auto">
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Record Count</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div><i
                                    class="ri-list-check align-bottom me-1 text-muted"></i>
                                {{ $Docs->count() }}</div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            aria-valuenow="34" aria-valuemin="0"
                            aria-valuemax="100" style="width: 100%;"></div>
                        <!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>
            </div>

        </div>
        <!-- end card body -->
        <div class="card-footer bg-transparent border-top-dashed py-2">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="avatar-group">

                        <a class="btn btn-danger shadow-lg" href="#ModalDoc"
                            class="avatar-group-item" data-bs-toggle="modal">

                            View Documents


                        </a>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="text-muted">
                        <i class="ri-calendar-event-fill me-1 align-bottom"></i>
                        {{ date('F j, Y') }}
                    </div>
                </div>

            </div>

        </div>
        <!-- end card footer -->
    </div>
    <!-- end card -->
</div>
