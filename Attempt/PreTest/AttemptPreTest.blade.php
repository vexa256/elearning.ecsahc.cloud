</div>
<div class="modal fade" id="AttemptPreTestExamModalWindow"
    data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="AttemptPracticalExamModalWindowLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen	">
        <div class="modal-content">
            <div class="modal-body">

                {{-- Modal Boay --}}
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 fs-6">
                                <a href="{{ url()->previous() }}"
                                    class="btn-danger btn me-5">Back to Course
                                    List</a>

                                Pre-Test

                                Examination
                                | {{ $Title }} |

                                <span class="text-danger">Exam Submition
                                    Deadline
                                    {{ date('F j, Y, g:i a', strtotime($Duration)) }}
                                    | Answer all the questions , Blank answers
                                    will be set to "Failed"
                                </span>


                            </h6>

                        </div>


                    </div><!-- end card header -->
                    <div class="card-body row">
                        <div class="myid col-12">
                            <form validate method="POST"
                                action="{{ route('SubmitPreExam') }}"
                                class="wizard" id="wizard">
                                @csrf


                                <input required type="hidden" name="PreTestID"
                                    value="{{ $TestID }}">


                                <input required type="hidden" name="CIID"
                                    value="{{ $CID }}">

                                <input required type="hidden" name="UserID"
                                    value="{{ Auth::user()->UserID }}">

                                <input required type="hidden" name="TableName"
                                    value="attempt_Pre-Test_tests">

                                <input required type="hidden" name="TestID"
                                    value="{{ $TestID }}">

                                <input required type="hidden" name="uuid"
                                    value="{{ md5(uniqid() . date('Y-m-d H:I:S')) }}">

                                @isset($PreExams)
                                    @foreach ($PreExams as $data)
                                        <h3>.</h3>
                                        <input required type="hidden"
                                            name="uniqueid[]"
                                            value="{{ md5(uniqid() . uniqid() . date('Y-m-d H:I:S')) }}">

                                        <input required type="hidden"
                                            name="TestType[]"
                                            value="{{ $data->TestType }}">
                                        <input required type="hidden"
                                            name="QtnID[]"
                                            value="{{ $data->QtnID }}">
                                        <input required type="hidden"
                                            name="CID[]"
                                            value="{{ $data->CID }}">

                                        {{-- <input required type="hidden"
                                            name="MID[]"
                                            value="{{ $data->MID }}"> --}}

                                        <input required type="hidden"
                                            name="created_at[]"
                                            value="{{ date('Y-m-d') }}">

                                        <input required type="hidden"
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


                                                        <option value="22277626">
                                                            Select Correct Option
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
