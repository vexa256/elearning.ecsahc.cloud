</div>
<div class="modal fade" id="CourseProgress" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="CourseProgressLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen	">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CourseProgressLabel">
                    This is your course exam progress,
                    Please pass all tests to certify. The certify button will
                    become active once all tests are passed
                </h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-dark text-light">
                                    Total Post Tests</th>
                                <th scope="col" class="bg-warning text-dark">
                                    Post Test
                                    Attempted</th>
                                <th scope="col"
                                    class="bg-primary text-light">
                                    Total Practical Tests</th>
                                <th scope="col"
                                    class="bg-secondary text-light"> Practical
                                    Tests Attempted
                                </th>
                                <th scope="col" class="bg-danger text-light">
                                    Total
                                    Modular Tests</th>
                                <th scope="col"
                                    class="bg-primary text-light"> Modular
                                    Tests Attempted
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @isset($CourseProgress)
                                {{-- @foreach ($Videos as $data) --}}
                                <tr>
                                    <th scope="row">{{ $PostTests }} </th>
                                    <th scope="row">{{ $PostTestsAttempted }}
                                    </th>
                                    <th scope="row">{{ $PracticalTests }} </th>
                                    <th scope="row">
                                        {{ $PracticalTestsAttempted }} </th>
                                    <th scope="row">{{ $ModularTests }} </th>

                                    <th scope="row">{{ $ModularTestsAttempted }}
                                    </th>

                                </tr>
                                {{-- @endforeach --}}
                            @endisset


                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </div>

        </div>
    </div>
</div>
