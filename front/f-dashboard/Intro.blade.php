<div class="modal fade" id="IntroModal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Hello {{ Auth::user()->name }}, Welcome
                    to the ECSA-HC Elearning Platform


                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn-close float-end fs-11"
                            aria-label="Close"></button>
                        <h6 class="card-title mb-0">About the ECSA-HC Elearning
                            Platform<span class="text-secondary"></span></h6>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Who we are
                        </h6>
                        <p class="card-text text-muted mb-0">
                        <p>The East, Central
                            and Southern Africa Health Community (ECSA-HC) is an
                            inter-governmental health organization that fosters
                            and promotes regional cooperation in health among
                            member states. Member states of the ECSA Health
                            Community are Kenya, Lesotho, Malawi, Mauritius,
                            Eswatini, United Republic of Tanzania, Uganda,
                            Zambia and Zimbabwe.</p>

                        <p> ECSA-HC was established in 1974 to foster and
                            strengthen regional cooperation and capacity to
                            address the health needs of the member states.
                            Through partnerships with diverse institutions,
                            ECSA’s activities also spread to other countries in
                            Africa to address common health challenges facing
                            the region. Within our projects, ECSA supports
                            non-member states including Botswana, Burundi,
                            Cameroon, Eritrea, Gabon, Liberia, Mozambique,
                            Namibia, Rwanda, Seychelles, South Sudan, Sudan, and
                            Somalia.</p>

                        <p> The ECSA Health Community works with countries and
                            partners to raise the standard of health for the
                            people of the ECSA region by promoting efficiency
                            and effectiveness of health services through
                            cooperation, collaboration, research, capacity
                            building, policy development and advocacy.</p>
                    </div>
                    <div class="card-footer">

                        <p class="text-muted mb-0">Thanks for enrolling</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    data-bs-dismiss="modal">Close</button>



            </div>

        </div>
    </div>
</div>
