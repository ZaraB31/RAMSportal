<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>

    <section class="pageBreak frontPage">
        <h1>SITE SPECIFIC <br> RISK ASSESSMENT & METHOD STATEMENT</h1>
        @if($project->company_id === 1)
        <img src="{{ public_path('images/pdf-logo-mega.jpg') }}" alt="">
        @elseif($project->company_id === 2)
        <img style="width:40%" src="{{ public_path('images/A PARRY LOGO PNG SQUARE - BLACK.png') }}" alt="">
        @endif 

        <div>
            <p>{{$project->company->address}}</p>
            <p>Tel: 0{{$project->company->phoneNo}}</p>
            <p>Email: {{$project->user->email}}</p>
        </div>

        <table>
            <tr style="background-color: lightgrey;">
                <th>Date of Issue</th>
                <th>Ref No.</th>
                <th>Authorised By</th>
                <th>Revision No'</th>
            </tr>
            <tr>
                @if($latestAmmendment->version === '1')
                <td>{{date('jS F Y', strtotime($project->approval->created_at))}}</td>
                @else
                <td>{{date('jS F Y', strtotime($latestAmmendment->created_at))}}</td>
                @endif
                <td>{{$project->jobNo}}</td>
                <td>{{$project->approval->user->name}}</td>
                <td>{{$latestAmmendment->version}}</td>
            </tr>
        </table>
    </section>

    <header>
        @if($project->company_id === 1)
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
        @elseif($project->company_id === 2)
        <div>
            <table>
                <tr>
                    <td style="width: 14%" rowspan="2"><img style="width:80%; margin:0;"src="{{ public_path('images/A PARRY LOGO PNG SQUARE - BLACK.png') }}" alt=""></td>
                    <td style="width: 51%">Health and Safety Site Specific Risk Assessment Method Statement</td>
                    <td style="width: 35%">Compiled by: {{$project->company->name}}</td>
                </tr>
                <tr>
                    
                    <td>Authorised by: {{$project->user->name}}</td>
                    <td>Ref no. {{$project->jobNo}}</td>
                </tr>
            </table>
        </div>
        @endif 
    </header>

    <main>
        <table>
            <tr><td style="width:40%;"><b>Location:</b></td><td>{{$project->detail->location}}</td></tr>
            <tr><td style="width:40%;"><b>Project Title:</b></td><td>{{$project->title}}</td></tr>
            <tr><td style="width:40%;"><b>Issue Number:</b></td><td>{{$latestAmmendment->version}}</td></tr>
            <tr><td style="width:40%;"><b>Compiled by:</b></td><td>{{$project->user->name}}</td></tr>
            <tr><td style="width:40%;"><b>Company Position:</b></td><td>{{$project->user->position}}</td></tr>
            <tr><td style="width:40%;"><b>Date Compiled:</b></td><td>{{date('jS F Y', strtotime($project->created_at))}}</td></tr>
            <tr><td style="width:40%;"><b>Date Issued:</b></td><td>{{date('jS F Y', strtotime($project->approval->created_at))}}</td></tr>
        </table>

        <section class="pageBreak">
            <h2 style="margin-top:10px;">Project Details</h2>
            <p><b>Description of work to be undertaken:</b></p>
            <p>{{$project->method->description}}</p>
            <p><b>Please read this document carefully and implement the requirements of this method statement.</b></p>
        </section>
        
        <section class="pageBreak">
            <h2>Project Technical Details</h2>

            <table>
                <tr><td><b>Name of Contractor:</b></td>   <td>{{$project->company->name}}</td></tr>
                <tr><td><b>Address Details:</b></td>   <td>{{$project->company->address}}</td></tr>
                <tr><td><b>Telephone No:</b></td>   <td>0{{$project->company->phoneNo}}</td></tr>
                <tr><td><b>Supervisor Responsible on Site:</b></td>   <td>{{$project->detail->supervisor->name}} - 0{{$project->detail->supervisor->phoneNo}}</td></tr>
                <tr><td><b>Client:</b></td>   <td>{{$project->client->name}}</td></tr>
                <tr><td><b>Principal/Main Contractor:</b></td>   <td>{{$project->company->name}}</td></tr>
                <tr><td><b>Project Manager - Responsible for Safety on Site:</b></td>   <td>{{$project->detail->manager->name}} - 0{{$project->detail->manager->phoneNo}}</td></tr>
                <tr><td><b>Commencing:</b></td>   <td>{{date('jS F Y', strtotime($project->detail->start))}}</td></tr>
                <tr><td><b>Completion:</b></td>   <td>{{date('jS F Y', strtotime($project->detail->end))}}</td></tr>
                <tr><td><b>Number of Employees on Site:</b></td>   <td>{{$operatives}}</td></tr>
            </table>

            <h3>Operatives on Site:</h3>

            @foreach($project->operative as $operative)
            <table class="operativesTable">
                <tr>
                    <td style="width:20%"><img src="../public/ProfilePictures/{{$operative->profilePic}}" alt=""></td>
                    <td>
                        <ul>
                            <li><b>Name: {{$operative->name}}</b></li>
                            <li>Company: {{$operative->company->name}}</li>
                            <li>Position: {{$operative->position}}</li>
                        </ul>
                    </td>
                </tr>
            </table>
            @endforeach
            
        </section>

        <section>
            <h2>Method Statement</h2>

            <table class="methodTable">
                <tr>
                    <th colspan="2">1.0 Sequence of Works</th>
                </tr>
                @foreach($project->method->sequence as $sequence)
                <tr>
                    <td style="width:5%; text-align:center;">{{$sequence->stepNo}}.</td>
                    <td>{{$sequence->description}}</td>
                </tr>
                @endforeach
            </table>

            <table class="methodTable">
                <tr>
                    <th>2.0 Tools and Equipment Required</th>
                </tr>
                
                <tr>
                    <td><ul>@foreach($project->method->tool as $tool)
                        <li>{{$tool->name}}</li>
                    @endforeach</ul></td>
                </tr>
                
            </table>

            <table class="methodTable">
                <tr><th>3.0 PPE Required</th></tr>

                <tr>
                    <td><ul>
                        @foreach($project->method->ppe as $ppe)
                        <li>{{$ppe->name}}</li>
                        @endforeach
                    </ul></td>
                </tr>
            </table>
            
            <table class="methodTable">
                <tr>
                    <th>4.0 Access to the Place of Work</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>All employees, contractors and visitors will attend the site induction carried out by the supervisor responsible for the site.</li>
                            <li>All employees, contractors and visitors will register their presence within the daily site register.</li>
                            <li>All persons will comply with site rules in the wearing of personal protective equipment.</li>
                        </ul>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>5.0 Access Equipment to be Used (Scaffolding, Podium Steps and Step Ladders where Podium Steps cannot be used)</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>All site rules and conditions must be strictly adhered to and any person failing to do so will be subject to Mega Electrical 
                                NW Ltd disciplinary action and may be removed from site.</li>
                            <li><b>All podium steps, step ladders and scaffolding to be correctly tagged for safety.</b></li>
                            <li>Carry out daily examination of podium steps, step ladders and scaffolding for signs of damage or defects before use.</li>
                            <li>Scaffolding to be erected by operatives holding PASMA qualification and signed off when safe.</li>
                            <li>The company supervisor is to be notified of any defects from above checks and that all working areas and means of access 
                                / egress are clear and free from obstruction; on discovery of any obstruction  will ensure the area is made safe immediately.</li>
                        </ul>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>6.0 Materials Handling and Storage</th>
                </tr>
                <tr><td>All materials will be below the recommended guidance for manual handling lifting weight of 25kg.</td></tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>7.0 Power Sources and Isolations Required</th>
                </tr>
                <tr>
                    <td>All works must be carried out by a qualified and competent electrician.</td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>8.0 Training requirements</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            @foreach($project->qualification as $qualification)
                            <li>{{$qualification->name}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>9.0 Supervision and Coordination of Activities</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>The Site Supervisor / Foreman will manage the site activities on a daily basis 
                                and their responsibility is to control the working area and interface the company 
                                activities with the client.</li>
                            <li>Site Emergency procedures must be strictly adhered with and all site rules will apply.</li>
                            <li>The Site Supervisor will have overall responsibilty for the safe coordination of the company scope of works.</li>
                            <li>The Site Supervisor will highlight any unsafe conditions or actions to the Site Manager and will take 
                                the appropriate actions to make conditions safe.</li>
                        </ul>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>10.0 Environmental Considerations - Site environmental considerations must be adhered to at all times</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>All insulation and package materials must be kept from entering the drainage system.</li>
                            <li>These include for general waste, timber, waste plastics and cardboard etc. and any special waste.</li>
                            <li>Noise will be kept to a minimum whilst on site.</li>
                            <li>Foul and abusive language will not be tolerated and operatives found using such language or 
                                gestures will be removed from site immediately.</li>
                            <li>Transitor radios will not be permitted on site.</li>
                            <li>The use of mobile phones must only be used in accordance with site rules.</li>
                            <li>Fires will not be allowed on site and any burning of materials is strictly prohibited.</li>
                        </ul>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>11.0 Protection of the Public</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>As far as reasonably practicable site traffic must be kept to a minimum and local traffic around the site must be treated 
                                with care.</li>
                            <li>Site supervisor shall exchange information with client / occupier to ensure full reciprocal knowledge of existing hazards, 
                                demarcation of areas of responsibility and work hazards.</li>
                            <li>Access equipment will be provided to ensure maximum safety of workers and occupants.</li>
                            <li>Details of existing services will be optained before the start of works.</li>
                            <li>Cones and bi-lingual signage will be installed to isolate working area from members of the public.</li>
                            <li>Work to be co-ordinated to reduce risks to third parties from trip hazards, no materials or tools to be left unattended, 
                                comprehensive signs/barriers to be used.</li>
                            <li>Standby Man / Site Supervisor / Foreman monitioring to include: initial checks to ensure safe systems of work are in place 
                                before work begins, that barriers and signs have not been removed or tampered with and that working areas are left clean 
                                and tidy at the end of each work period.</li>
                        </ul>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>12.0 Waste Disposal Arrangements</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>During the day debris will be collected and disposed in accordance with the company procedures.</li>
                            <li>During each working shift the debris will be removed and deposited into the skips and 
                                WEEErecycling containers provided in the onsite compound.</li>
                        </ul>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>13.0 Fire and Emergency Procedures</th>
                </tr>
                <tr>
                    <td>The fire and emergency plan and procedures given at the site induction will be strictly adhered to during the project 
                        and all site operatives will adhere to the information given.</td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>14.0 Review of Method Statement</th>
                </tr>
                <tr>
                    <td>The Mega Electrical NW Ltd site supervisor responsible for the works will ensure that the work area has been inspected 
                        and is free from risk of injury or that suitable and sufficient measures have been taken to comply with current health 
                        and safety legislation prior to any work being undertaken. This method statement will only  be amended by Mega Electrical 
                        NW Ltd site superviosr and authorised in agreement with Mega Electrical NW Ltd senior management, any such amendments 
                        will be recorded and further instruction given to each operative of the amendments.</td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>15.0 Communication of Risk Assessment and Method Statement</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>All operatives will be instructed of the risk assessment and method statement for their scope of works as part of 
                                the Toolbox Talk procedures prior to commencing work.</li>
                            <li>They must ensure they fully understand the work involved, the hazards and the level of risk they may be exposed to.</li>
                            <li>Following instruction, they each must sign the register attached.</li>
                            <li>Each operative must work to the method statement, any deviation must be authorised by the Mega Electrical NW Ltd 
                                site supervisor.</li>
                        </ul>
                        <b>Any operative not working to the specific method statement will be subject to disciplinary action.</b>
                    </td>
                </tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th colspan="3">16.0 Emergency Contacts</th>
                </tr>
                <tr>
                    <td>Site Project Manager</td>
                    <td>{{$project->detail->manager->name}}</td>
                    <td>0{{$project->detail->manager->phoneNo}}</td>
                </tr>
                <tr>
                    <td>Safety and Environment Advisor</td>
                    <td>Emma Lampka</td>
                    <td>079693000080</td>
                </tr>
                <tr>
                    <td>Off Site Emergency Number</td>
                    <td>{{$project->company->name}}</td>
                    <td>0{{$project->company->phoneNo}}</td>
                </tr>
                <tr>
                    <td>Out of Hours/24hr Emergency Number</td>
                    <td>{{$project->company->name}}</td>
                    <td>0{{$project->detail->emergencyPhone}}</td>
                </tr>
            </table>
        </section>
    </main>
</body>
</html>