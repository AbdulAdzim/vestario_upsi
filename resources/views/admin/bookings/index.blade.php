<x-layouts.app :title="__('Admin - Booking Requests')">
    <div class="container">
        <h1>Admin - Booking Requests</h1>

        @foreach ($bookings as $booking)
            <div style="border:1px solid #ccc; padding:20px; margin-bottom:20px; border-radius:10px;">
                <p><strong>Name:</strong> {{ $booking->name }}</p>
                <p><strong>Matrics:</strong> {{ $booking->matrics }}</p>
                <p><strong>Club:</strong> {{ $booking->club }}</p>
                <p><strong>Reason:</strong> {{ $booking->reason }}</p>
                <p><strong>Studio(s):</strong> {{ $booking->studio }}</p>
                <p><strong>Date:</strong> {{ $booking->start_date }} to {{ $booking->end_date }}</p>
                <p><strong>Time:</strong> {{ $booking->time_slot }}</p>
                <p><strong>Status:</strong> 
                    @if ($booking->status == 'pending')
                        <span style="color: orange;">Pending</span>
                    @elseif ($booking->status == 'accepted')
                        <span style="color: green;">Accepted</span>
                    @else
                        <span style="color: red;">Rejected</span>
                    @endif
                </p>

                @if ($booking->status === 'pending')
                    <form method="POST" action="{{ route('admin.bookings.accept', $booking->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background-color: green; color: white;">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('admin.bookings.reject', $booking->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background-color: red; color: white;">Reject</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</x-layouts.app>
