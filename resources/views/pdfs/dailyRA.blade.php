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
                <tr><td>The Client shall be informed, as soon as practical, of all accidents which occur on or near the site, and a written report shall be submitted within three days.</td></tr>
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
                </tr>
            </table>
        </section>

        @for($x=0; $x<$days+1; $x++)
        <section>
            <h2 style="margin:0; border-bottom: 1px solid black;">Daily Risk Assessment <span style="font-size: 16px; margin-left: 10px">Date:</span></h2>
            
            <p>This Daily Risk Assessment is not a replacement for the Risk Assessment and Method Statements (RAMS) for the project, but to support the RAMS continue to be effective 
                at controlling risks on the day of activities to support further hazard and risks are eliminated prior to work commencing.</p>
        </section>
        
        <section class="pageBreak dailyRA">
            <table class="methodTable">
                <tr style="text-align:center; font-size:14px;">
                    <th style="text-align:center;">ARE THERE ANY RESIDUAL RISKS FROM THE FOLLOWING HAZARDS?</th>
                    <th style="text-align:center; width:5%;">TICK IF APPLIES</th>
                    <th style="text-align:center;">WHAT CONTROL MEASURES HAVE YOU/ARE YOU GOING TO TAKEN/TAKE?</th>
                    <th style="text-align:center;" colspan="3">RESIDUAL RISK (CIRCLE LEVEL AFTER CONTROL MEASURES TAKEN)</th>
                </tr>
                @foreach($types as $type)
                <tr>
                    <td style="width:30%; padding:5px;">{{$type}}</td>
                    <td></td>
                    <td></td>
                    <td style="width:7%; text-align:center; background-color: #F6361E;">HIGH</td>
                    <td style="width:7%; text-align:center; background-color: #F6A21E;">MID</td>
                    <td style="width:7%; text-align:center; background-color: #08bf1c;">LOW</td>
                </tr>
                @endforeach
                <tr>
                    <td style="background-color:lightgrey; text-align:center;" colspan="6">I confirm that the general safety on this job has been maintained and agree to proceed with the job/task safely</td>
                </tr>
                <tr>
                    <td style="padding:5px" colspan="2">Name:</td>
                    <td style="padding:5px" colspan="4">Signature:</td>
                </tr>
            </table>
        </section>
        @endfor

        <section class="pageBreak">
            <h2>Risk Assessment and Method Statement Register</h2>
            <p>This register is to be signed by all operatives at the start of each working day.</p>
            <p style="color:red;">I confirm that I have read and understood these risk assessments, method statements and emergency procedures and commit to working safely and abide by all the company and client requirements.</p>
            <table class="methodTable register">
                <tr>
                    <th style="width: 20%">Date</th>
                    <th>Name</th>
                    <th>Signature</th>
                </tr>
                @for($x=0; $x<$days+1; $x++)
                    @for($i=0; $i<$operatives+2; $i++)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                @endfor
            </table>
        </section>

        <section>
            <h2>Document Revisions</h2>

            <table class="methodTable">
                <tr>
                    <th style="width:20%">Version No'</th>
                    <th style="width:60%">Comments</th>
                    <th style="width:20%">Date</th>
                </tr>
                @foreach($project->ammendment as $ammendment)
                <tr>
                    <td>{{$ammendment->version}}</td>
                    <td>{{$ammendment->comment}}</td>
                    <td>{{date('jS F Y', strtotime($ammendment->created_at))}}</td>
                </tr>
                @endforeach
            </table>
        </section>
    </main>
</body>
</html>