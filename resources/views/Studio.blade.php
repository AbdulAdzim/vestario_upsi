<x-layouts.app :title="__('Studio')">
    <style>
<<<<<<< HEAD
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
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
    padding: 10px 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
  }

  button {
    width: 100%;
    padding: 12px;
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
    min-width: 140px;
  }

  .studio-option {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 14px;
  }

  .studio-option input {
    margin-right: 10px;
    width: 16px;
    height: 16px;
  }

  .date-range {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
  }

  .date-range label {
    margin: 0;
  }

  @media (max-width: 600px) {
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

<div class="studio-booking-form">
  <h1>Book Studio</h1>
  <div>
    <label>Full Name:</label>
    <input type="text" id="name" required>

    <label>No Matrics/No Staff:</label>
    <input type="text" id="matrics" required>

    <label>Club/Organization name:</label>
    <input type="text" id="club" required>

    <label>Reason:</label>
    <input type="text" id="reason" required>

    <label>Phone no:</label>
    <input type="tel" id="phone" required>

    <div class="date-range">
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

    <label>Studio name:</label>
    <div class="studio-columns">
      <div class="studio-column">
        <div class="studio-option"><input type="checkbox" name="studio-name" value="muzik_utama"> Muzik Utama</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="muzik2"> Muzik 2</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="akustik"> Akustik</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="tradisional"> Tradisional</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="tari"> Tari</div>
      </div>
      <div class="studio-column">
        <div class="studio-option"><input type="checkbox" name="studio-name" value="gamelan"> Gamelan</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="rakaman"> Rakaman</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="vokal1"> Vokal 1</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="vokal2"> Vokal 2</div>
        <div class="studio-option"><input type="checkbox" name="studio-name" value="vokal3"> Vokal 3</div>
      </div>
    </div>

    <div style="display: flex; justify-content: center;">
      <button onclick="bookNow()">Book Now</button>
    </div>
    <div style="display: flex; justify-content: center;">
      <button onclick="showBooking()">View My Booking</button>
    </div>
  </div>

  <div id="confirmation"></div>
</div>
=======
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
>>>>>>> e0601fde41001ccc0ddf28d3353d44f0b3b7f5b6

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
<<<<<<< HEAD
  let bookingInfo = '';
=======
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
>>>>>>> e0601fde41001ccc0ddf28d3353d44f0b3b7f5b6

  function bookNow() {
    const fullName = document.getElementById('name').value;
    const matrics = document.getElementById('matrics').value;
    const club = document.getElementById('club').value;
    const reason = document.getElementById('reason').value;
    const phone = document.getElementById('phone').value;
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;
    const bookingTime = document.getElementById('booking-time').value;

<<<<<<< HEAD
    const studioCheckboxes = document.querySelectorAll('input[name="studio-name"]:checked');
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
  }

  function showBooking() {
    const confirmation = document.getElementById('confirmation');
    if (bookingInfo) {
      confirmation.innerHTML = bookingInfo;
      confirmation.style.display = 'block';
    } else {
      confirmation.innerHTML = "<p>No booking has been made yet.</p>";
      confirmation.style.display = 'block';
=======
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
>>>>>>> e0601fde41001ccc0ddf28d3353d44f0b3b7f5b6
    }
  }
</script>
<<<<<<< HEAD

</x-layouts.app>

=======
</body>
</html>
>>>>>>> e0601fde41001ccc0ddf28d3353d44f0b3b7f5b6
