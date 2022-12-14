<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Let's create a new module
                    and attach it to the course <span class="text-danger">
                        {{ $CourseName }}
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

                <form action="{{ route('MassInsert') }}" class="row"
                    method="POST" enctype="multipart/form-data"> @csrf
                    <div class="row">

                        <div class="mt-3  mb-3 col-md-12 ">
                            <label id="label" for=""
                                class=" required form-label">Module
                                Presentation</label>
                            (Only PDF Allowed)
                            </label>

                            <input type="file" required
                                name="ModulePresentation" class="form-control"
                                id="">

                        </div>


                        <input type="hidden" name="created_at"
                            value="{{ date('Y-m-d h:i:s') }}">

                        <input type="hidden" name="TableName" value="modules">

                        @foreach ($Form as $data)
                            @if ($data['type'] == 'string')
                                {{ CreateInputText($data, $placeholder = null, $col = '12') }}
                            @elseif ('smallint' == $data['type'] ||
                                'bigint' === $data['type'] ||
                                'integer' == $data['type'] ||
                                'bigint' == $data['type'])
                                {{ CreateInputInteger($data, $placeholder = null, $col = '12') }}
                            @elseif ($data['type'] == 'date' || $data['type'] == 'datetime')
                                {{ CreateInputDate($data, $placeholder = null, $col = '12') }}
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

                    <input type="hidden" name="MID"
                        value="{{ md5(\Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))) }}">

                    <input type="hidden" name="CID"
                        value="{{ $CID }}">


                    <input type="hidden" name="uuid"
                        value="{{ md5(\Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))) }}">




            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-dark">Save
                    Changes</button>

                </form>
            </div>

        </div>
    </div>
</div>
