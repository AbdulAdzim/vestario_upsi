<x-layouts.app :title="__('Studio')">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007BFF;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #confirmation {
            background: #e6ffee;
            border-left: 5px solid #28a745;
            padding: 20px;
            margin-top: 25px;
            display: none;
            border-radius: 6px;
        }

        #confirmation.no-booking {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
        }

        .studio-columns {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .studio-column {
            flex: 1;
            min-width: 200px;
        }

        .studio-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .studio-option input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
        }

        .date-range {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .studio-columns {
                flex-direction: column;
            }

            .date-range {
                flex-direction: column;
                align-items: flex-start;
            }

            button {
                font-size: 14px;
            }
        }
    </style>

    <div class="container">
        <h1>Book Studio</h1>

        {{-- ✅ Show success popup if form is submitted --}}
        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <form id="studioForm" action="{{ route('studio.booking.store') }}" method="POST">
            @csrf
            <label>Full Name:</label>
            <input type="text" name="name" id="name" required>

            <label>No Matrics/No Staff:</label>
            <input type="text" name="matrics" id="matrics" required>

            <label>Club/Organization name:</label>
            <input type="text" name="club" id="club" required>

            <label>Reason:</label>
            <input type="text" name="reason" id="reason" required>

            <label>Phone no:</label>
            <input type="tel" name="phone" id="phone" required>

            <div class="date-range">
                <label>Date used</label>
                <input type="date" name="start_date" id="start-date" required>
                <label>until</label>
                <input type="date" name="end_date" id="end-date" required>
            </div>

            <label>Time Slot:</label>
            <select name="time_slot" id="booking-time" required>
                <option value="">Select time</option>
                <option value="09:00-12:00">9:00 AM - 12:00 PM</option>
                <option value="13:00-16:00">1:00 PM - 4:00 PM</option>
                <option value="17:00-20:00">5:00 PM - 8:00 PM</option>
            </select>

            <label>Studio name:</label>
            <div class="studio-columns">
                <div class="studio-column">
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="muzik_utama" onchange="limitCheckboxes(this)"> Muzik Utama</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="muzik2" onchange="limitCheckboxes(this)"> Muzik 2</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="akustik" onchange="limitCheckboxes(this)"> Akustik</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="tradisional" onchange="limitCheckboxes(this)"> Tradisional</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="tari" onchange="limitCheckboxes(this)"> Tari</div>
                </div>
                <div class="studio-column">
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="gamelan" onchange="limitCheckboxes(this)"> Gamelan</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="rakaman" onchange="limitCheckboxes(this)"> Rakaman</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="vokal1" onchange="limitCheckboxes(this)"> Vokal 1</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="vokal2" onchange="limitCheckboxes(this)"> Vokal 2</div>
                    <div class="studio-option"><input type="checkbox" name="studio[]" value="vokal3" onchange="limitCheckboxes(this)"> Vokal 3</div>
                </div>
            </div>

            <button type="submit">Book Now</button>
        </form>

        <button type="button" id="toggleBookingBtn" onclick="toggleBooking()">View My Booking</button>

        <div id="confirmation"></div>
    </div>

    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('start-date').min = today;
        document.getElementById('end-date').min = today;

        document.getElementById('start-date').addEventListener('change', function () {
            const startDate = this.value;
            const endDateInput = document.getElementById('end-date');
            if (endDateInput.value && endDateInput.value < startDate) {
                endDateInput.value = startDate;
            }
            endDateInput.min = startDate;
        });

        document.getElementById('end-date').addEventListener('change', function () {
            const endDate = this.value;
            const startDateInput = document.getElementById('start-date');
            if (startDateInput.value && startDateInput.value > endDate) {
                startDateInput.value = endDate;
            }
        });

        function limitCheckboxes(checkbox) {
            const maxAllowed = 2;
            const checkboxes = document.querySelectorAll('input[name="studio[]"]:checked');
            if (checkboxes.length > maxAllowed) {
                checkbox.checked = false;
                alert(`You can only select up to ${maxAllowed} studios.`);
            }
        }

        // Fixed booking functionality
        let savedBookingData = null;
        let isBookingVisible = false;

        // Save booking data when form is submitted
        document.getElementById('studioForm').addEventListener('submit', function(e) {
            savedBookingData = {
                name: document.getElementById('name').value,
                matrics: document.getElementById('matrics').value,
                club: document.getElementById('club').value,
                reason: document.getElementById('reason').value,
                phone: document.getElementById('phone').value,
                startDate: document.getElementById('start-date').value,
                endDate: document.getElementById('end-date').value,
                timeSlot: document.getElementById('booking-time').value,
                studios: Array.from(document.querySelectorAll('input[name="studio[]"]:checked')).map(cb => cb.value)
            };
        });

        function toggleBooking() {
            const confirmation = document.getElementById('confirmation');
            const toggleBtn = document.getElementById('toggleBookingBtn');

            if (isBookingVisible) {
                // Hide the booking details
                confirmation.style.display = 'none';
                toggleBtn.textContent = "View My Booking";
                isBookingVisible = false;
            } else {
                // Show the booking details
                if (savedBookingData && savedBookingData.name) {
                    // Show saved booking
                    const studiosText = savedBookingData.studios.length > 0 ? 
                        savedBookingData.studios.join(', ') : 'None selected';
                    
                    confirmation.innerHTML = `
                        <h3>Latest Booking Details</h3>
                        <p><b>Name:</b> ${savedBookingData.name}</p>
                        <p><b>Matrics/Staff No:</b> ${savedBookingData.matrics}</p>
                        <p><b>Club:</b> ${savedBookingData.club}</p>
                        <p><b>Reason:</b> ${savedBookingData.reason}</p>
                        <p><b>Phone:</b> ${savedBookingData.phone}</p>
                        <p><b>Date:</b> ${savedBookingData.startDate} until ${savedBookingData.endDate}</p>
                        <p><b>Time Slot:</b> ${savedBookingData.timeSlot}</p>
                        <p><b>Studios Booked:</b> ${studiosText}</p>
                    `;
                    confirmation.className = '';
                } else {
                    // No booking made yet
                    confirmation.innerHTML = `
                        <h3>No Booking Found</h3>
                        <p>You haven't made any booking yet. Please fill out the form above to make a booking.</p>
                    `;
                    confirmation.className = 'no-booking';
                }
                
                confirmation.style.display = 'block';
                toggleBtn.textContent = "Hide My Booking";
                isBookingVisible = true;
            }
        }

        // Handle successful booking from session
        @if (session('success'))
            setTimeout(function() {
                if (!savedBookingData) {
                    savedBookingData = {
                        name: "Booking Submitted Successfully",
                        matrics: "Check your email for confirmation",
                        club: "Last submitted booking",
                        reason: "Booking completed",
                        phone: "",
                        startDate: "",
                        endDate: "",
                        timeSlot: "",
                        studios: []
                    };
                }
            }, 100);
        @endif
    </script>
</x-layouts.app>