<div class="offcanvas offcanvas-start offcanvas-size-xl" id="PostTest"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Select a post
            exam to attempt
        </h5>
        <button type="button" class="btn-close text-reset"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <div class="live-preview">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0">
                    <thead>
                        <tr>

                            <th scope="col">Title</th>
                            <th scope="col">Description</th>

                            <th scope="col">Attempt</th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($PostExams)
                            @foreach ($PostExams as $data)
                                <tr>

                                    <td>{{ $data->Title }}</td>
                                    <td>{{ $data->VeryBriefDescription }}</td>

                                    <td>

                                        {!! ConfirmBtn(
                                            $data = [
                                                'msg' =>
                                                    'You want to attempt this exam. Once you confirm a timer will start and can not be stopped. Closing this page will not stop the timer as well. Please attempt the exam in the assigned time.',
                                                'route' => route('GoToPostExams', ['id' => $data->id]),
                                                'label' => '<i class="fas ri ms-1 ri-calendar-check-fill"></i> Attempt',
                                                'class' => 'btn btn-danger btn-sm deleteConfirm admin',
                                            ],
                                        ) !!}


                                    </td>
                                </tr>
                            @endforeach

                        @endisset


                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
