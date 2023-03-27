@isset($Courses)
    @foreach ($Courses as $data)
        <div class="card shadow-lg">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('assets/data/' . $data->CourseThumbnail) }}"
                        alt="{{ $data->Course }}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->Course }}</h5>
                        <p class="card-text">{{ $data->VeryBriefDescription }}</p>
                        <p class="card-text">
                            <small class="text-muted">Course Operator:
                                {{ $data->Title }}</small>
                        </p>
                        <a href="{{ route('Explore', ['id' => $data->id]) }}"
                            class="btn btn-primary">
                            @if ($data->role == 'Incomplete')
                                Complete Registration
                            @else
                                Start the course
                            @endif
                        </a>
                        <a data-doc="{{ $data->Course }} ({{ $data->VeryBriefDescription }})"
                            data-source="{{ asset('assets/data/' . $data->CoursePresentation) }}"
                            data-bs-toggle="modal" href="#FPdfJS"
                            class="btn btn-success FPdfJS">
                            About Course
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endisset
