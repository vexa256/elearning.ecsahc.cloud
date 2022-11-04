@if ($Certify == 'true')
    </div>
    <div class="modal fade" id="Cert">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-gray">
                    <h5 class="modal-title"> Print your certificate for the
                        selected course

                    </h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body row">

                    <div class="col-12">
                        <div class="d-flex justify-content-center">

                            <div id="printable" class="shadow-lg"
                                style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878; background-image:url({{ asset('bg.jpg') }});">
                                <div class="shadow-lg"
                                    style="width:750px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">

                                    <div class="row">
                                        <div class="col-6">
                                            <img style="height: 15vh"
                                                class="img-fluid"
                                                src="{{ asset('logo.jpeg') }}"
                                                alt="">


                                        </div>

                                        <div class="col-6">

                                            <img style="height: 15vh"
                                                class="img-fluid"
                                                src="{{ asset('logo2.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <span class="font-italic "
                                        style="font-size:40px; font-weight:bold">Certificate
                                        of
                                        Completion</span>
                                    <br><br>
                                    <span style="font-size:20px"><i>This is to
                                            certify
                                            that</i></span>
                                    <br><br>
                                    <span
                                        style="font-size:30px"><b>{{ $Student }}</b></span><br /><br />
                                    <span style="font-size:20px"><i>has
                                            completed
                                            the
                                            course</i></span>
                                    <br /><br />
                                    <span style="font-size:25px">
                                        <b>{{ $Course }}</b>
                                    </span>
                                    <br /><br />
                                    <span style="font-size:20px">


                                        <div class="row">
                                            <div class="col-6">

                                                <span
                                                    class="text-danger  fw-bolder">
                                                    Date:
                                                    {{ date('F j, Y', strtotime($StudentCertification->created_at)) }},

                                                </span>

                                            </div>

                                            <div class="col-6">
                                                <span
                                                    class="text-danger  fw-bolder">
                                                    Verification Code :
                                                    {{ $StudentCertification->CertCode }}
                                                </span>
                                            </div>
                                        </div>



                                    </span> <br /><br /><br /><br />





                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-info"
                        data-bs-dismiss="modal">Close</button>

                    <button id="PrintCertificate" class="btn btn-dark">Print
                        Certificate</button>


                </div>
            </div>

        </div>
    </div>
    </div>
@endif
