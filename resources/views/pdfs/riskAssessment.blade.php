<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>
    <header>
        <img src="{{ public_path('images/pdf-logo-mega.jpg') }}" alt="">
        <div>
            <table>
                <tr>
                    <td>Health and Safety Site Specific Risk Assessment Method Statement</td>
                    <td>Compiled by: {{$project->company->name}}</td>
                </tr>
                <tr>
                    <td>Authorised by: {{$project->user->name}}</td>
                    <td>Ref no. {{$project->jobNo}}</td>
                </tr>
            </table>
        </div>
    </header>

    <main>

        <section class="hazardRatings">
            <h2>Risk Assessment</h2>
            <table>
                <tr>
                    <td style="width:25%;">
                        <ul>
                            <li>Likelihood *L</li>
                            <li>1 = Improbable</li>
                            <li>2 = Remote</li>
                            <li>3 = Possible</li>
                            <li>4 = Probable</li>
                            <li>5 = Likely</li>
                        </ul>
                    </td>
                    <td style="width:25%;">
                        <ul>
                            <li>Severity *S</li>
                            <li>1 = No Injury</li>
                            <li>2 = Minor Injury</li>
                            <li>3 = 3-day Injury</li>
                            <li>4 = Major Injury</li>
                            <li>5 = Fatality</li>
                        </ul>
                    </td>
                    <td colspan="2">
                        <table style="text-align:center;">
                            <tr><td>5</td><td style="background-color:#08bf1c">5</td><td style="background-color:#F6A21E">10</td><td style="background-color:#F6361E">15</td><td style="background-color:#F6361E">20</td><td style="background-color:#F6361E">25</td></tr>
                            <tr><td>4</td><td  style="background-color:#08bf1c">4</td><td style="background-color:#F6A21E">8</td><td style="background-color:#F6361E">12</td><td style="background-color:#F6361E">16</td><td style="background-color:#F6361E">20</td></tr>
                            <tr><td>3</td><td  style="background-color:#08bf1c">3</td><td  style="background-color:#F6A21E">6</td><td  style="background-color:#F6A21E">9</td><td style="background-color:#F6361E">12</td><td style="background-color:#F6361E">15</td></tr>
                            <tr><td>2</td><td  style="background-color:#08bf1c">2</td><td  style="background-color:#F6A21E">4</td><td  style="background-color:#F6A21E">6</td><td  style="background-color:#F6A21E">8</td><td  style="background-color:#F6A21E">10</td></tr>
                            <tr><td>1</td><td  style="background-color:#08bf1c">1</td><td  style="background-color:#08bf1c">2</td><td style="background-color:#08bf1c">3</td><td style="background-color:#08bf1c">4</td><td style="background-color:#08bf1c">5</td></tr>   
                            <tr><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>  
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width:31%;">Risk = Likelihood x Severity</td>
                    <td style="background-color:#08bf1c; width:23%; text-align:center;">Low</td>
                    <td style="background-color:#F6A21E; width:23%; text-align:center;">Medium</td>
                    <td style="background-color:#F6361E; width:23%; text-align:center;">High</td>
                </tr>
            </table>
        </section>

        <section class="hazards">
            <table class="hazardsDisplay">
                <tr>
                    <th style="width:12%" rowspan="2">Hazard</th>
                    <th style="width:12%" rowspan="2">Effect</th>
                    <th style="width:12%" rowspan="2">Persons at Risk</th>
                    <th colspan="3">Risk</th>
                    <th style="width:44%" rowspan="2">Control Measures</th>
                    <th colspan="3">Residual Risk</th>
                </tr>
                <tr>
                    <th style="width:2.5%">L</th>
                    <th style="width:2.5%">S</th>
                    <th style="width:4%">L*S</th>
                    <th style="width:2.5%">L</th>
                    <th style="width:2.5%">S</th>
                    <th style="width:4%">L*S</th>
                </tr>
                @foreach($project->risk as $risk)
                <tr>
                    <td>{{$risk->hazard}}</td>
                    <td>{{$risk->effect}}</td>
                    <td>{{$risk->person->person}}</td>
                    <td>{{$risk->likelihood}}</td>
                    <td>{{$risk->severity}}</td>

                    @if($before[$risk->id] <= 5)
                        <td style="text-align:center; background-color: #08bf1c;">{{ $before[$risk->id] }}</td>
                    @elseif($before[$risk->id] >= 6 AND $before[$risk->id] <= 10)
                        <td style="text-align:center; background-color: #F6A21E;">{{ $before[$risk->id] }}</td>
                    @elseif($before[$risk->id] >= 11)
                        <td style="text-align:center; background-color: #F6361E;">{{ $before[$risk->id] }}</td>
                    @endif

                    <td style="text-align:left;">{{$risk->control}}</td>
                    <td>{{$risk->residualLikelihood}}</td>
                    <td>{{$risk->residualSeverity}}</td>

                    @if($after[$risk->id] <= 5)
                        <td style="text-align:center; background-color: #08bf1c;">{{ $after[$risk->id] }}</td>
                    @elseif($after[$risk->id] >= 6 AND $after[$risk->id] <= 10)
                        <td style="text-align:center; background-color: #F6A21E;">{{ $after[$risk->id] }}</td>
                    @elseif($after[$risk->id] >= 11)
                        <td style="text-align:center; background-color: #F6361E;">{{ $after[$risk->id] }}</td>
                    @endif
                </tr>
                @endforeach
            </table>
        </section>
    </main>
</body>
</html>