<!DOCTYPE html>
<html>
<head>
    <title>Studio Booking</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 20px auto; padding: 20px; }
        input, select, button { width: 100%; padding: 8px; margin: 5px 0 15px; box-sizing: border-box; }
        button { background: #007BFF; color: white; border: none; cursor: pointer; }
        #confirmation { background: #f0fff0; padding: 15px; margin-top: 20px; display: none; }
            .studio-option {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            white-space: nowrap;
        }
        .studio-option input {
            margin: 0 8px 0 0;
            width: 16px;
            height: 16px;
        }
        .studio-columns {
            display: flex;
            gap: 30px;
        }
        .studio-column {
            min-width: 120px;
        }
    </style>
</head>
<body>
    <h1>Book Studio</h1>
    <form action="{{ route('studio.booking.store') }}" method="POST">
        @csrf
        <label>Full Name:</label><br>
        <input type="text" name="name" required><br>

        <label>No Matrics/No Staff:</label><br>
        <input type="text" name="matrics" required><br>

        <label>Club/Organization name:</label><br>
        <input type="text" name="club" required><br>

        <label>Reason:</label><br>
        <input type="text" name="reason" required><br>

        <label>Phone no:</label><br>
        <input type="tel" name="phone" required><br>

        <div style="display: flex; align-items: center; gap: 10px;">
            <label>Date used</label>
            <input type="date" name="start_date" required>
            <label>until</label>
            <input type="date" name="end_date" required>
        </div>

        <label>Time Slot:</label>
        <select name="time_slot" required>
            <option value="">Select time</option>
            <option value="09:00-12:00">9:00 AM - 12:00 PM</option>
            <option value="13:00-16:00">1:00 PM - 4:00 PM</option>
            <option value="17:00-20:00">5:00 PM - 8:00 PM</option>
        </select>
        <br>

        <label>Studio name:</label>
        <div class="studio-columns">
            <!-- Left Column -->
            <div class="studio-column">
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="muzik_utama">
                    <span>Muzik Utama</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="muzik2">
                    <span>Muzik 2</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="akustik">
                    <span>Akustik</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="tradisional">
                    <span>Tradisional</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="tari">
                    <span>Tari</span>
                </div>
            </div>

            <!-- Right Column -->
            <div class="studio-column">
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="gamelan">
                    <span>Gamelan</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="rakaman">
                    <span>Rakaman</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="vokal1">
                    <span>Vokal 1</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="vokal2">
                    <span>Vokal 2</span>
                </div>
                <div class="studio-option">
                    <input type="checkbox" name="studio[]" value="vokal3">
                    <span>Vokal 3</span>
                </div>
            </div>
        </div>
        <br>

        <div style="display: flex; justify-content: center;">
            <button type="submit">Book Now</button>
        </div>
    </form>

    <div style="display: flex; justify-content: center;">
        <button id="toggleBookingBtn" onclick="toggleBooking()">View My Booking</button>
    </div>

    <div id="confirmation"></div>
</body>
<script>
    // Set today's date as minimum for both inputs
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('start-date').min = today;
    document.getElementById('end-date').min = today;

    // Validate start date
    document.getElementById('start-date').addEventListener('change', function () {
        const startDate = this.value;
        const endDateInput = document.getElementById('end-date');

        // Ensure end date is not before start date
        if (endDateInput.value && endDateInput.value < startDate) {
            endDateInput.value = startDate;
        }

        // Update end date's minimum to match start date
        endDateInput.min = startDate;
    });

    // Validate end date
    document.getElementById('end-date').addEventListener('change', function () {
        const endDate = this.value;
        const startDateInput = document.getElementById('start-date');

        // Ensure start date is not after end date
        if (startDateInput.value && startDateInput.value > endDate) {
            startDateInput.value = endDate;
        }
    });

    // ✅ Checkbox limit function (max 2)
    function limitCheckboxes(checkbox) {
        const maxAllowed = 2;
        const checkboxes = document.querySelectorAll('input[name="studio[]"]:checked');

        if (checkboxes.length > maxAllowed) {
            checkbox.checked = false;
            alert(`You can only select up to ${maxAllowed} studios.`);
        }
    }

    let bookingInfo = ''; // Global variable to store booking details
    let isBookingVisible = false; // Track visibility of booking info

    function bookNow() {
        const fullName = document.getElementById('name').value;
        const matrics = document.getElementById('matrics').value;
        const club = document.getElementById('club').value;
        const reason = document.getElementById('reason').value;
        const phone = document.getElementById('phone').value;
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;
        const bookingTime = document.getElementById('booking-time').value;

        const studioCheckboxes = document.querySelectorAll('input[name="studio[]"]:checked');
        const selectedStudios = Array.from(studioCheckboxes).map(cb => cb.value).join(', ');

        if (!fullName || !matrics || !club || !reason || !phone || !startDate || !endDate || !bookingTime || selectedStudios.length === 0) {
            alert('Please fill in all fields and select at least one studio.');
            return;
        }

        bookingInfo = `
            <h3>Booking Details</h3>
            <p><b>Name:</b> ${fullName}</p>
            <p><b>Matrics/Staff No:</b> ${matrics}</p>
            <p><b>Club:</b> ${club}</p>
            <p><b>Reason:</b> ${reason}</p>
            <p><b>Phone:</b> ${phone}</p>
            <p><b>Date:</b> ${startDate} until ${endDate}</p>
            <p><b>Time Slot:</b> ${bookingTime}</p>
            <p><b>Studios Booked:</b> ${selectedStudios}</p>
        `;

        alert("Booking Successful!\n\nClick 'View My Booking' to see the details.");
        document.querySelector('form')?.reset();
    }

    function toggleBooking() {
        const confirmation = document.getElementById('confirmation');
        const toggleBtn = document.getElementById('toggleBookingBtn');

        if (!bookingInfo) {
            confirmation.innerHTML = "<p>No booking has been made yet.</p>";
            confirmation.style.display = 'block';
            isBookingVisible = true;
            toggleBtn.textContent = "Hide My Booking";
            return;
        }

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
</body>
</html>