</div>
<div class="modal fade" id="Analysis">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> This is
                    your scoreboard.
                    <span class="text-danger">
                        <small>This will be populated fully when you attempt
                            both
                            tests. This tracks learner knowledge aquisition
                            analysis
                        </small>
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

                <table
                    class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                    <thead>
                        <tr
                            class="fw-bold  text-gray-800 border-bottom border-gray-200">
                            <th class="bg-dark text-white fw-bolder">Test Your
                                Knowlegde Quiz Score</th>
                            <th class="bg-dark text-white fw-bolder">Post
                                Test Score</th>



                        </tr>
                    </thead>
                    <tbody>
                        @isset($Scoreboard)
                            @foreach ($Scoreboard as $data)
                                <tr>

                                    <td class="bg-primary fw-bolder text-light">
                                        {{ $data->PreScores }} %</td>

                                    <td class="bg-primary fw-bolder text-light">
                                        {{ $data->PostScore }} %</td>



                                    </td>

                                </tr>
                            @endforeach
                        @endisset



                    </tbody>
                </table>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    data-bs-dismiss="modal">Close</button>

                {{-- <button type="submit" class="btn btn-dark">Save
                    Changes</button> --}}


            </div>

        </div>
    </div>
</div>
