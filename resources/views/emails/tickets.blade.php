<div>
    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Date</th>
                <th>Ticket Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{$ticket['event_Name']}}</td>
                <td>{{$ticket['ticket_type']}}</td>
                <td>{{$ticket['event_Location']}}</td>
                <td>{{\Carbon\Carbon::createFromTimestamp($ticket['event_Date'])->format('d-m-Y')}}</td>
                <td>{{$ticket['event_Id'].$ticket['ticket_Id'].$ticket['user_Id']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>



</div>
