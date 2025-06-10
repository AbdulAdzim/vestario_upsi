<x-layouts.app :title="__('Studio')">
    <style>
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

<script>
  let bookingInfo = '';

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
    }
  }
</script>

</x-layouts.app>

