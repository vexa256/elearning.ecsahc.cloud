{{-- </div> --}}
<div class="modal fade" id="ModalPres" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-primary fw-bolder">
                <h5 class="modal-title  text-light" id="">
                    {{ $Course }}
                    Presentation Resources

                </h5>

            </div>
            <div class="modal-body">

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Resource Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">View Presentation</th>

                            </tr>
                        </thead>
                        <tbody>
                            @isset($Pres)

                                @foreach ($Pres as $data)
                                    <tr>
                                        <th scope="row">{{ $data->Title }}</th>
                                        <td>{{ $data->VeryBriefDescription }}</td>

                                        <td>
                                            <a data-doc="  {{ $data->Course }} ({{ $data->VeryBriefDescription }})"
                                                data-source="{{ asset($data->url) }}"
                                                data-bs-toggle="modal"
                                                href="#FPdfJS"
                                                class="d-block PdfViewer btn-lg  text-light fw-bolder btn btn-success ms-3 p-1 px-2"><i
                                                    class="   ri-questionnaire-fill text-light fw-bolder align-bottom me-1"></i>
                                                View Presentation</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset


                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


@include('f-pdf.PDFJS')
