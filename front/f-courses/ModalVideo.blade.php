{{-- </div> --}}
<div class="modal fade" id="ModalVideo" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-primary fw-bolder">
                <h5 class="modal-title  text-light" id="">
                    {{ $Course }}
                    Video Resources

                </h5>

            </div>
            <div class="modal-body">

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Resource Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">View Video</th>

                            </tr>
                        </thead>
                        <tbody>
                            @isset($Videos)

                                @foreach ($Videos as $data)
                                    <tr>
                                        <th scope="row">{{ $data->Title }}</th>
                                        <td>{{ $data->VeryBriefDescription }}</td>

                                        <td>
                                            <a class="btn btn-danger  shadow-lg"
                                                data-fslightbox="gallery"
                                                href="{{ asset($data->url) }}">
                                                <i class="ri  ri-video-chat-fill ms-1"
                                                    aria-hidden="true"></i> Play
                                            </a>
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
