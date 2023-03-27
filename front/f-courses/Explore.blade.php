<div class="row">
    <div class="col-md-12">
        <div style="background-color: white !important; padding-top: 1rem !important;"
            class="card-body bg-light pt-3 bg-light shadow-lg table-responsive">
            <div class="card-title bg-light"
                style="background-color: white !important;">
                <h4>
                    View all modules attached to the selected course
                </h4>
            </div>
            {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = ' Document Notes ', $Icon = 'ri  ri-sticky-note-2-fill') }} --}}
            <table style="background-color: white !important;"
                class=" card-body mytable bg-light table table-sm table-bordered  border gy-1 gs-1">
                <thead>
                    <tr
                        class="fw-bold  text-gray-800 border-bottom border-gray-200">
                        <th>Module </th>
                        <th>Description</th>
                        <th>Module Description</th>
                        <th>View Resources</th>

                    </tr>
                </thead>
                <tbody>
                    @isset($Modules)
                        @foreach ($Modules as $data)
                            <tr>

                                <td>{{ $data->Module }}</td>
                                <td>{{ $data->VeryBriefDescription }}</td>

                                <td> <a data-doc="  {{ $data->Course }} ({{ $data->VeryBriefDescription }})"
                                        data-source="{{ asset('assets/data/' . $data->ModulePresentation) }}"
                                        data-bs-toggle="modal" href="#FPdfJS"
                                        class="d-inline-block PdfViewer btn btn-sm btn-success text-light fw-bolder ms-1 py-0 px-1"><i
                                            class="ri-questionnaire-fill text-light fw-bolder align-bottom me-1"></i>
                                        Module Overview</a>
                                </td>

                                <td>
                                    <a href="{{ route('FrontViewNotes', ['id' => $data->CourseID]) }}"
                                        class="d-inline-block btn btn-sm btn-danger text-light fw-bolder ms-1 py-0 px-1"><i
                                            class="ri-cloud-fill text-light fw-bolder align-bottom me-1"></i>
                                        View Resources</a>

                                </td>

                            </tr>
                        @endforeach
                    @endisset

                </tbody>
            </table>
        </div>
    </div>
</div>
