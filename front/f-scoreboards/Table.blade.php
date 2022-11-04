<table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
    <thead>
        <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
            <th class="bg-dark text-white fw-bolder">Modular Tests Score</th>
            <th class="bg-dark text-white fw-bolder">Total Modular Test Qtns</th>
            <th class="bg-primary text-white fw-bolder">Attempted Modular Test
                Qtns</th>

            <th class="bg-danger text-white fw-bolder">Practital Test Score</th>
            <th class="bg-dark text-white fw-bolder">Total Practical Test Qtns
            </th>
            <th class="bg-primary text-white fw-bolder">Attempted Practical Test
                Qtns</th>

            <th class="bg-danger text-white fw-bolder">Post Test Score</th>
            <th class="bg-secondary text-white fw-bolder">Total Post Test Qtns
            </th>
            <th class="bg-success text-white fw-bolder">Attempted Post Test Qtns
            </th>

            <th class="bg-danger fw-bolder text-light"> Print Certificate
            </th>

            <th class="bg-danger fw-bolder text-light"> Try Again
            </th>






        </tr>
    </thead>
    <tbody>
        @isset($Scoreboard)
            @foreach ($Scoreboard as $data)
                <tr>

                    <td class="bg-danger fw-bolder text-light">
                        {{ $data->ModularScore }} %</td>
                    <td class="bg-primary fw-bolder text-light">
                        {{ $data->TotalModular }}</td>
                    <td class="bg-primary fw-bolder text-light">
                        {{ $data->ModAttempted }}</td>
                    <td class="bg-secondary fw-bolder text-light">
                        {{ $data->PracScore }} %</td>
                    <td class="bg-primary fw-bolder text-light">
                        {{ $data->TotalPrac }}</td>
                    <td class="bg-danger fw-bolder text-light">
                        {{ $data->PracAttempted }}</td>
                    <td class="bg-primary fw-bolder text-light">
                        {{ $data->PostScore }} %</td>
                    <td class="bg-dark fw-bolder text-light">
                        {{ $data->TotalPost }}</td>
                    <td class="bg-dark fw-bolder text-light">
                        {{ $data->PostAttempted }}</td>
                    <td>

                        @isset($Certify)
                            @if ($Certify == 'true')
                                <a href="#Cert" data-bs-toggle="modal"
                                    class="btn btn-danger btn-sm shadow-lg">

                                    Certify

                                </a>
                            @endif
                        @endisset


                    </td>

                    <td>

                        @isset($Certify)
                            @if ($Certify != 'true')
                                <a href="#"
                                    class="btn btn-danger btn-sm shadow-lg">

                                    Retry

                                </a>
                            @endif
                        @endisset


                    </td>








                </tr>
            @endforeach
        @endisset



    </tbody>
</table>
