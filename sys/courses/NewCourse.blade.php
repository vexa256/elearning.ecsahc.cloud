<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Let's create a new course and add it to
                    our course inventory



                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form id="NewCourseData" action="{{ route('SaveNewCourse') }}"
                    class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">


                        <div class="mb-3 col-md-6  ">
                            <label id="label" for=""
                                class="required mt-3 form-label">Select
                                Course Operator
                                (Institution)
                            </label>
                            <select required name="IID"
                                class="form-select   form-select-solid"
                                data-control="select2"
                                data-placeholder="Select a option">
                                <option></option>
                                @isset($Institutions)

                                    @foreach ($Institutions as $data)
                                        <option value="{{ $data->IID }}">
                                            {{ $data->Title }}
                                            ({{ $data->VeryBriefDescription }})
                                        </option>
                                    @endforeach
                                @endisset

                            </select>

                        </div>



                        <div class="mt-3  mb-3 col-md-6 ">
                            <label id="label" for=""
                                class=" required form-label">Upload
                                Course
                                Thumbnail (Only SVG, PNG and JPG )</label>

                            <input type="file" required
                                name="CourseThumbnail" class="form-control"
                                id="CourseThumbnail">

                        </div>


                        <div class="mt-3  mb-3 col-md-6 ">
                            <label id="label" for=""
                                class=" required form-label">Course
                                Presentation</label>

                            <input type="file" required
                                name="CoursePresentation" class="form-control"
                                id="CoursePresentation">

                        </div>




                        <input type="hidden" name="created_at"
                            value="{{ date('Y-m-d h:i:s') }}">

                        <input type="hidden" name="TableName" value="courses">

                        @foreach ($Form as $data)
                            @if ($data['type'] == 'string')
                                {{ CreateInputText($data, $placeholder = null, $col = '6') }}
                            @elseif ('smallint' == $data['type'] ||
                                'bigint' === $data['type'] ||
                                'integer' == $data['type'] ||
                                'bigint' == $data['type'])
                                {{ CreateInputInteger($data, $placeholder = null, $col = '4') }}
                            @elseif ($data['type'] == 'date' || $data['type'] == 'datetime')
                                {{ CreateInputDate($data, $placeholder = null, $col = '4') }}
                            @endif
                        @endforeach

                    </div>

                    <div class="row">
                        @foreach ($Form as $data)
                            @if ($data['type'] == 'text')
                                {{ CreateInputEditor($data, $placeholder = null, $col = '12') }}
                            @endif
                        @endforeach

                    </div>

                    <input type="hidden" name="CID"
                        value="{{ md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}">


                    <input type="hidden" name="uuid"
                        value="{{ md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}">




            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    data-bs-dismiss="modal">Close</button>

                <button data-bs-dismiss="model" id="SaveCourseData"
                    type="submit" class="btn btn-dark">Save
                    Changes</button>

                </form>
            </div>

        </div>
    </div>
</div>
