<h3>User Booking Requests</h3>

@if($bookings->isEmpty())
    <p class="text-muted">No bookings yet.</p>
@else
    <div class="table-responsive">
        <table class="table table-bordered mt-3 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Matric No</th>
                    <th>Club</th>
                    <th>Purpose</th>
                    <th>Phone</th>
                    <th>Outfit</th>
                    <th>Size</th>
                    <th>Booking Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->matric_no }}</td>
                    <td>{{ $booking->club }}</td>
                    <td>{{ $booking->purpose }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->outfit->name ?? '-' }}</td>
                    <td>{{ $booking->size }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->return_date }}</td>
                    <td>
                        <span class="badge {{ $booking->status == 'accepted' ? 'bg-success' : ($booking->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            {{ ucfirst($booking->status ?? 'pending') }}
                        </span>
                    </td>
                    <td>
                        @if($booking->status === 'pending')
                            <form action="{{ route('admin.outfit.handle', $booking->id) }}" method="POST">
                                @csrf
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="decision" id="accept-{{ $booking->id }}" value="accepted" required>
                                    <label class="form-check-label" for="accept-{{ $booking->id }}">Accept</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="decision" id="reject-{{ $booking->id }}" value="rejected">
                                    <label class="form-check-label" for="reject-{{ $booking->id }}">Reject</label>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mt-1">Submit</button>
                            </form>
                        @else
                            <em>No action</em>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
