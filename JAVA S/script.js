let savedClinic = "";
let savedDate = "";
let savedTime = "";

function updateTimes() {
    const periodInput = document.querySelector('input[name="period"]:checked');
    const timeSelect = document.getElementById('app-time');
    if (!periodInput || !timeSelect) return;
    
    timeSelect.innerHTML = "";
    let times = (periodInput.value === "صباحاً") ? 
        ["08:00 صباحاً", "09:30 صباحاً", "10:45 صباحاً", "11:30 صباحاً"] : 
        ["04:00 مساءً", "05:15 مساءً", "06:30 مساءً", "07:45 مساءً", "08:30 مساءً"];
    
    times.forEach(t => {
        let opt = document.createElement("option");
        opt.value = t; opt.innerHTML = t;
        timeSelect.appendChild(opt);
    });
}

function confirmBooking() {
    const clinic = document.getElementById('clinic-type').value;
    const date = document.getElementById('app-date').value;
    const time = document.getElementById('app-time').value;

    if (!clinic || !date) {
        showAlert("يرجى اختيار العيادة والتاريخ أولاً"); 
        return;
    }

    document.getElementById('booking-form').style.display = 'none';
    document.getElementById('confirmation-msg').style.display = 'block';
    
        document.getElementById('final-details').innerHTML = 
    `تم حجز موعد في عيادة <br> <b>${clinic}</b> <br> بتاريخ <b>${date}</b> <br> الساعة <b>${time}</b>`;
}

function resetForm() { location.reload(); }
function showAlert(msg) {
    document.getElementById('alert-message').innerText = msg;
    document.getElementById('custom-alert').style.display = 'flex';
}
function closeAlert() { document.getElementById('custom-alert').style.display = 'none'; }

window.onload = updateTimes;