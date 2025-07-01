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

        let bookingInfo = '';
        let isBookingVisible = false;

        function toggleBooking() {
            const name = document.getElementById('name').value;
            const matrics = document.getElementById('matrics').value;
            const club = document.getElementById('club').value;
            const reason = document.getElementById('reason').value;
            const phone = document.getElementById('phone').value;
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const bookingTime = document.getElementById('booking-time').value;
            const studios = Array.from(document.querySelectorAll('input[name="studio[]"]:checked')).map(cb => cb.value).join(', ');

            const confirmation = document.getElementById('confirmation');
            const toggleBtn = document.getElementById('toggleBookingBtn');

            if (!name || !matrics || !club || !reason || !phone || !startDate || !endDate || !bookingTime || !studios) {
                confirmation.innerHTML = "<p>No booking has been made yet.</p>";
                confirmation.style.display = 'block';
                toggleBtn.textContent = "Hide My Booking";
                isBookingVisible = true;
                return;
            }

            bookingInfo = `
                <h3>Booking Details</h3>
                <p><b>Name:</b> ${name}</p>
                <p><b>Matrics/Staff No:</b> ${matrics}</p>
                <p><b>Club:</b> ${club}</p>
                <p><b>Reason:</b> ${reason}</p>
                <p><b>Phone:</b> ${phone}</p>
                <p><b>Date:</b> ${startDate} until ${endDate}</p>
                <p><b>Time Slot:</b> ${bookingTime}</p>
                <p><b>Studios Booked:</b> ${studios}</p>
            `;

            isBookingVisible = !isBookingVisible;

            if (isBookingVisible) {
                confirmation.innerHTML = bookingInfo;
                confirmation.style.display = 'block';
                toggleBtn.textContent = "Hide My Booking";
            } else {
                confirmation.style.display = 'none';
                toggleBtn.textContent = "View My Booking";
            }
        }
    </script>
</x-layouts.app>
