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
    <div>
        <label>Full Name:</label><br>
        <input type="text" id="name" required>
        <br>
        <label>No Matrics/No Staff:</label><br>
        <input type="text" id="matrics" required>
        <br>
        <label>Club/Organization name:</label><br>
        <input type="text" id="club" required>  
        <br>
        <label>Reason:</label><br>
        <input type="text" id="reason" required>
        <br>
        <label>Phone no:</label><br>
        <input type="tel" id="phone" required>
            <div style="display: flex; align-items: center; gap: 10px;">
                <label>Date used</label>
                <input type="date" id="start-date" required>
                <label>until</label>
                <input type="date" id="end-date" required>
            </div>
        <label>Time Slot:</label>
        <select id="booking-time" required>
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
              <input type="checkbox" name="studio-name" value="muzik_utama">
              <span>Muzik Utama</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="muzik2">
              <span>Muzik 2</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="akustik">
              <span>Akustik</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="tradisional">
              <span>Tradisional</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="tari">
              <span>Tari</span>
            </div>
          </div>
          
          <!-- Right Column -->
          <div class="studio-column">
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="gamelan">
              <span>Gamelan</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="rakaman">
              <span>Rakaman</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="vokal1">
              <span>Vokal 1</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="vokal2">
              <span>Vokal 2</span>
            </div>
            <div class="studio-option">
              <input type="checkbox" name="studio-name" value="vokal3">
              <span>Vokal 3</span>
            </div>
          </div>
        </div>
        <br>
        <div style="display: flex; justify-content: center;">
            <button onclick="bookNow()">Book Now</button>
        </div>
        <div style="display: flex; justify-content: center;">
            <button onclick="showBooking()">View My Booking</button>
        </div>
    </div>
    <div id="confirmation"></div>

<script>
    let bookingInfo = ''; // Global variable to store the booking summary

    function bookNow() {
        const fullName = document.getElementById('name').value;
        const matrics = document.getElementById('matrics').value;
        const club = document.getElementById('club').value;
        const reason = document.getElementById('reason').value;
        const phone = document.getElementById('phone').value;
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;
        const bookingTime = document.getElementById('booking-time').value;

        const studioCheckboxes = document.querySelectorAll('input[name="studio-name"]:checked');
        const selectedStudios = Array.from(studioCheckboxes).map(cb => cb.value).join(', ');

        if (!fullName || !matrics || !club || !reason || !phone || !startDate || !endDate || !bookingTime || selectedStudios.length === 0) {
            alert('Please fill in all fields and select at least one studio.');
            return;
        }

        // Store the booking info in a global variable
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

    function showBooking() {
        const confirmation = document.getElementById('confirmation');
        if (bookingInfo) {
            confirmation.innerHTML = bookingInfo;
            confirmation.style.display = 'block';
        } else {
            confirmation.innerHTML = "<p>No booking has been made yet.</p>";
            confirmation.style.display = 'block';
        }
    }
</script>

</body>
</html>