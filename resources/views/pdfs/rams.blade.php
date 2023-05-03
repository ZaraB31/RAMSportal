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
        <img src="{{ public_path('images/pdf-logo-mega.jpg') }}" alt="">

        <div>
            <p>{{$project->company->address}}</p>
            <p>Tel: {{$project->company->phoneNo}}</p>
            <p>Email: {{$project->user->email}}</p>
        </div>
    </section>

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
        <table>
            <tr><td style="width:40%;"><b>Location:</b></td><td>{{$project->detail->location}}</td></tr>
            <tr><td style="width:40%;"><b>Project Title:</b></td><td>{{$project->title}}</td></tr>
            <tr><td style="width:40%;"><b>Issue Number:</b></td><td>01</td></tr>
            <tr><td style="width:40%;"><b>Compiled by:</b></td><td>{{$project->user->name}}</td></tr>
            <tr><td style="width:40%;"><b>Company Position:</b></td><td>{{$project->user->position}}</td></tr>
            <tr><td style="width:40%;"><b>Date Compiled:</b></td><td>{{date('jS F Y', strtotime($project->created_at))}}</td></tr>
            <tr><td style="width:40%;"><b>Date Issued:</b></td><td>approved created at</td></tr>
        </table>

        <section class="pageBreak">
            <h2 style="margin-top:10px;">Project Details</h2>
            <p><b>Description of work to be undertaken:</b></p>
            <p>{{$project->method->description}}</p>
            <p><b>Please read this document carefully and implement the requirements of this method statement.</b></p>
            <p style="color:red"><b>Estates Department to arrange for all isolations to circuits before lights are worked on. 
                Both Estates and Mega electricians to work alongside each other to achieve isolations of the replacement fittings 
                and only to be re-energised when both parties have agreed work has been completed and safe to do so.</b></p>
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

        <section class="pageBreak">
            <h2>Risk Assessment and Method Statement</h2>

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
                            <li>All employees, contractors and visitors will register their presence within the daily site reqister.</li>
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
                                / egress are clear and free from obstruction; on discovery of any obstruction will ensure the area is made safe immediately.</li>
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
                            <li>CSCS accreditation</li>
                            <li>JIB cards</li>
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
                            <li>the Site Supervisor / Foreman will manage the site activities on a daily basis 
                                and their responsibility is to control the working area and interface the company 
                                activities with the client.</li>
                            <li>Site Emergency procedures must be strictly adhered with and all site rules will apply.</li>
                            <li>The Site Supervisor will have overall responsibilty fro the safe coordination of the company scope of works.</li>
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
                        NW Ltd site superviosr and authorised in agreement with Mega ELectrical NW Ltd senior management, any such amendments 
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
                            <li>Each operative must work to the method statement, any deviation must be authorised by mega Electrical NW Ltd 
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
                    <td>{{$project->company->phoneNo}}</td>
                </tr>
                <tr>
                    <td>Out of Hours/24hr Emergency Number</td>
                    <td>{{$project->company->name}}</td>
                    <td>07867512180</td>
                </tr>
            </table>
        </section>

        <section class="hazardRatings">
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

        <section class="hazards pageBreak">
            <table class="hazardsDisplay">
                <tr>
                    <th rowspan="2">Hazard</th>
                    <th rowspan="2">Effect</th>
                    <th rowspan="2">Persons at Risk</th>
                    <th colspan="3">Risk</th>
                    <th rowspan="2">Control Measures</th>
                    <th colspan="3">Residual Risk</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>S</th>
                    <th>L*S</th>
                    <th>L</th>
                    <th>S</th>
                    <th>L*S</th>
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

                    <td>{{$risk->control}}</td>
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

        <section class="pageBreak">
            <h2>Site Emergency Procedures</h2>

            <table class="methodTable">
                <tr>
                    <th>Reporting of an Injury or Dangerous Occurrence</th>
                </tr>
                <tr><td>In the event of an injury or dangerous occurrence (as defined in the Reporting of Injuries 
                        and Dangerous Occurrences Regulations 1995), the <b>Site Manager</b> will report the incident immediately 
                        to the <b>Managing Director</b> who will, if appropriate, consult with the <b>Company’s Health and Safety Officer.</b></td></tr>
                <tr><td>Upon receiving a detailed appraisal of the incident, the appropriate members of staff, as detailed above, will be responsible for the following:</td></tr>
                <tr><td>Reporting, by telephone, the details of the incident to the appropriate enforcing authority.  This will be followed within ten 
                    days with a full written report of the incident using form F2508 (or F2508A in the case of a reportable disease).  Copies of the 
                    relevant forms are retained by the Managing Director and the Health and Safety Officer.</td></tr>
                <tr><td>Ensuring that the following details are entered in the Company Accident Book:
                <ul style="list-style:decimal;">
                    <li>Date of the incident</li>
                    <li>Time of the incident</li>
                    <li>Location of the incident</li>
                    <li>Personal details of those involved</li>
                    <li>A brief description of the nature of the incident</li>
                </ul></td></tr>
                <tr><td><b>Note:</b> Every incident shall be thoroughly investigated by the Health and Safety Officer so that the cause of the incident can be 
                established and preventative means recurrence can be planned and implemented.</td></tr>
            </table>

            <table class="methodTable">
                <tr>
                    <th>Fire Control Procedures</th>
                </tr>
                <tr>
                    <tr><td>Fire protection measures and procedures will apply where relevant to the work being undertaken and will be reviewed and updated as the works proceed.  
                        The following will be used as a checklist guide to ensuring that all fire risk areas are addressed:
                    <ul style="list-style:decimal;">
                        <li>The control of operations using heating/burning appliances</li>
                        <li>The construction, siting and equipping of site buildings, i.e. site offices, welfare facilities, flammable stores, equipment stores etc.</li>
                        <li>Areas where smoking and the use of naked flames are forbidden.</li>
                        <li>The system for storage and disposal of flammable and combustible waste, and avoidance of build-up of such waste in areas of operations, especially hot/burning operations.</li>
                        <li>Storage of flammable materials.</li>
                        <li>Availability of water supplies for fire brigade appliances and on site firefighting equipment.</li>
                        <li>The provision of adequate firefighting appliances situated according to the fire risk involved.</li>
                        <li>Evacuation procedures in the event of fire, including the liaising of site operatives in such procedures.</li>
                    </ul>
                    </td></tr>
                    <tr><td>No employees or sub-contractors to A. Parry Construction will carry out operations using heating/burning equipment without first obtaining permission 
                        from the Site Manager, who will ensure that the necessary precautions are taken, and that the workplace and surroundings are safe on completion 
                        of activities and particularly at the end of the working day.</td></tr>
                    <tr><td><b>Action in the event of a fire</b></td></tr>
                    <tr><td>If a fire is discovered on site, the first priority is the overall safety of site personnel. The fire alarm must be sounded, and all staff not required as part of a fire 
                        control team must be evacuated to the safe assembly area where they can be accounted for.</td></tr>
                    <tr><td>An attempt to fight a fire must only be made if:
                        <ul style="list-style:decimal;">
                            <li>if it is safe to do so</li>
                            <li>the correct firefighting equipment is available</li>
                            <li>a safe means of escape is available</li>
                        </ul>
                    </td></tr>
                    <tr><td>An emergency assembly point shall be established and details posted in the site office.  All site operatives shall be made aware of the emergency procedure and assembly point during induction training</td></tr>
                    <tr><td>The First Aider for this project will be <b style="color:red;">Site Supervisor</b> and a mobile telephone shall be made available to the site personnel throughout the project for emergency communications.  Powder fire extinguishers 
                        shall be available in the office/storage units and details of the nearest hospital shall be posted in the site office and in the RAMS.</td></tr>
                    <tr><td>The Client shall be informed, as soon as practical, of all accidents which occur on or near the site, and a written report shall be submitted within three days.</td></tr>
                </tr>
            </table>
        </section>

        <section>
            <h2>Risk Assessment and Method Statement Register</h2>
            <p style="color:red;">I confirm that I have read and understood these risk assessments, method statements and emergency procedures and commit to working safely and abide by all the company and client requirements.</p>
            <table class="methodTable register">
                <tr>
                    <th style="width: 20%">Date</th>
                    <th>Name</th>
                    <th>Signature</th>
                </tr>
                @for($i=0; $i<$operatives+2; $i++)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endfor
            </table>
        </section>
    </main>
</body>
</html>