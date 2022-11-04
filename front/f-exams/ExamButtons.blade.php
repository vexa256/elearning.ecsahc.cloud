<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Student Actions Panel</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div id="customerList">
                <div class="row g-4 mb-3">
                    <div class="col-sm-auto">
                        <div>
                            <a data-bs-toggle="offcanvas" href="#offcanvasExample"
                                role="button" aria-controls="offcanvasExample"
                                class="btn shadow-lg btn-primary add-btn"
                                ata-bs-toggle="offcanvas"><i
                                    class=" ri-folder-fill
                                    align-bottom me-1"></i>
                                Modular Tests</a>

                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div>
                            <button type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#PracticalTest" role="button"
                                aria-controls="offcanvasExample"
                                class="btn shadow-lg btn-secondary add-btn"
                                ata-bs-toggle="offcanvas"><i
                                    class=" ri-fire-fill align-bottom me-1"></i>
                                Practical Tests</button>

                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div>
                            <button type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#PostTest" role="button"
                                aria-controls="offcanvasExample"
                                class="btn shadow-lg btn-danger add-btn"
                                ata-bs-toggle="offcanvas"><i
                                    class="  ri-group-line
                                    align-bottom me-1"></i>
                                Post Tests</button>

                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div>
                            <button type="button"
                                class="btn shadow-lg btn-success add-btn"
                                data-bs-toggle="modal" id="create-btn"
                                data-bs-target="#CourseProgress"><i
                                    class="  ri-user-heart-fill
                                    align-bottom me-1"></i>
                                Student Progress</button>

                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div>
                            <a data-bs-target="#Certify" data-bs-toggle="modal"
                                type="button"
                                class="btn shadow-lg btn-primary add-btn "><i
                                    class="   ri-contacts-fill
                                    align-bottom me-1"></i>
                                Score Board</a>

                        </div>
                    </div>

                    <div class="col-sm-auto">
                        <div>
                            <button data-bs-target="#Analysis"
                                data-bs-toggle="modal" type="button"
                                class="btn shadow-lg btn-secondary add-btn "><i
                                    class=" ri-user-voice-fill
                                    align-bottom me-1"></i>
                                Learning Analysis</button>

                        </div>
                    </div>

                </div>


            </div>
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>




{{-- @include('f-exams.Modular') --}}
