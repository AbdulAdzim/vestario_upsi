<!DOCTYPE html>
<html>
<head>
    <title>Admin Bookings</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .status {
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <h2>Studio Booking Requests</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Matrics/Staff No</th>
                <th>Club/Org</th>
                <th>Reason</th>
                <th>Phone</th>
                <th>Start - End Date</th>
                <th>Time Slot</th>
                <th>Studios</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->matrics }}</td>
                <td>{{ $booking->club }}</td>
                <td>{{ $booking->reason }}</td>
                <td>{{ $booking->phone }}</td>
                <td>{{ $booking->start_date }} - {{ $booking->end_date }}</td>
                <td>{{ $booking->time_slot }}</td>
                <td>{{ $booking->studio }}</td>
                <td class="status">{{ $booking->status }}</td>
                <td>
                    @if($booking->status == 'pending')
                        <a href="{{ route('admin.booking.update', [$booking->id, 'accepted']) }}">Accept</a> |
                        <a href="{{ route('admin.booking.update', [$booking->id, 'rejected']) }}">Reject</a>
                    @else
                        {{ ucfirst($booking->status) }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>