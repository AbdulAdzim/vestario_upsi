<!DOCTYPE html>
<html>
<head>
    <title>Studio Booking</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 20px auto; padding: 20px; }
        input, select, button { width: 100%; padding: 8px; margin: 5px 0 15px; box-sizing: border-box; }
        button { background: #007BFF; color: white; border: none; cursor: pointer; }
        #confirmation { background: #f0fff0; padding: 15px; margin-top: 20px; display: none; }
    </style>
</head>
<body>
    <h1>Book Studio Time</h1>
    
    <div>
        <label>Date:</label>
        <input type="date" id="booking-date" required>
        
        <label>Time Slot:</label>
        <select id="booking-time" required>
            <option value="">Select time</option>
            <option value="09:00-12:00">9:00 AM - 12:00 PM</option>
            <option value="13:00-16:00">1:00 PM - 4:00 PM</option>
            <option value="17:00-20:00">5:00 PM - 8:00 PM</option>
        </select>
        
        <label>Full Name:</label>
        <input type="text" id="name" required>
        
        <label>Email:</label>
        <input type="email" id="email" required>
        
        <button onclick="bookNow()">Book Now</button>
    </div>
    
    <div id="confirmation"></div>

    <script>
        function bookNow() {
            const date = document.getElementById('booking-date').value;
            const time = document.getElementById('booking-time').value;
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;

            if (!date || !time || !name || !email) {
                alert('Please fill all fields!');
                return;
            }

            const confirmation = document.getElementById('confirmation');
            confirmation.innerHTML = `
                <h3>Booking Confirmed!</h3>
                <p><b>${name}</b>, your studio booking is confirmed.</p>
                <p><b>Date:</b> ${date}</p>
                <p><b>Time:</b> ${time}</p>
                <p>Confirmation sent to ${email}</p>
            `;
            confirmation.style.display = 'block';

            // Clear form
            document.getElementById('booking-date').value = '';
            document.getElementById('booking-time').value = '';
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
        }
    </script>
</body>
</html>