</div>
<div class="modal fade" id="AttemptPracticalExamModalWindow"
    data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="AttemptPracticalExamModalWindowLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen	">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title"
                    id="AttemptPracticalExamModalWindowLabel">Practical
                    Examination
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">

                {{-- Modal Boay --}}
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"> Practical Examination
                                | {{ $Title }} |

                                <span class="text-danger">Exam Submition
                                    Deadline
                                    {{ date('F j, Y, g:i a', strtotime($Duration)) }}
                                </span>
                            </h4>

                            <a href="{{ url()->previous() }}"
                                class="btn-danger btn ms-5 float-end"
                                aria-label="Close">Back</a>


                        </div><!-- end card header -->
                        <div class="card-body row">
                            <div class="myid col-12">
                                <form method="POST"
                                    action="{{ route('SubmitPracticalExam') }}"
                                    class="wizard">
                                    @csrf


                                    <input type="hidden" name="ModularTestID"
                                        value="{{ $TestID }}">

                                    <input type="hidden" name="UserID"
                                        value="{{ Auth::user()->UserID }}">

                                    <input type="hidden" name="TableName"
                                        value="attempt_practical_tests">

                                    <input type="hidden" name="TestID"
                                        value="{{ $TestID }}">

                                    <input type="hidden" name="uuid"
                                        value="{{ md5(uniqid() . date('Y-m-d H:I:S')) }}">

                                    @isset($PracExams)
                                        @foreach ($PracExams as $data)
                                            <h3>.</h3>
                                            <input type="hidden" name="uniqueid[]"
                                                value="{{ md5(uniqid() . uniqid() . date('Y-m-d H:I:S')) }}">

                                            <input type="hidden" name="TestType[]"
                                                value="{{ $data->TestType }}">
                                            <input type="hidden" name="QtnID[]"
                                                value="{{ $data->QtnID }}">
                                            <input type="hidden" name="CID[]"
                                                value="{{ $data->CID }}">
                                            <input type="hidden" name="MID[]"
                                                value="{{ $data->MID }}">

                                            <input type="hidden"
                                                name="created_at[]"
                                                value="{{ date('Y-m-d') }}">

                                            <input type="hidden"
                                                name="CorrectAnswerOption[]"
                                                value="{{ $data->CorrectAnswerOption }}">

                                            <section class="row">

                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="">Correct
                                                            Answer
                                                            Option</label>

                                                        <select name="UserAnswer[]"
                                                            id="UserAnswer{{ $data->id }}"
                                                            required
                                                            class="form-control IntOnly">


                                                            <option
                                                                value="22277626">
                                                                Select Correct
                                                                Option
                                                            </option>

                                                            <option value="1">
                                                                1</option>
                                                            <option value="2">
                                                                2</option>
                                                            <option value="3">
                                                                3</option>
                                                            <option value="4">
                                                                4</option>
                                                            <option value="5">
                                                                5</option>

                                                        </select>




                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="gen-info-username-input">Questions</label>
                                                        <textarea class="editorme">

                                                            {{ $data->Question }}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </section>
                                        @endforeach
                                    @endisset
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Boay --}}
            </div>

        </div>
    </div>
</div>
