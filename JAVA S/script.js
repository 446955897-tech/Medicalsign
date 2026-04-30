let savedClinic = "";
let savedDate = "";
let savedTime = "";


function updateConfirmationText() {
    let timeDisplay = savedTime;

    timeDisplay = timeDisplay.replace("AM", "صباحاً").replace("PM", "مساءً");

    const introText = "تم حجز موعد في";
    document.getElementById('final-details').innerHTML = 
        `${introText} <b>${savedClinic}</b> <br> بتاريخ <b>${savedDate}</b> <br> الساعة <b>${timeDisplay}</b>`;
}


function updateTimes() {
    const periodInput = document.querySelector('input[name="period"]:checked');
    if (!periodInput) return;
    
    const timeSelect = document.getElementById('app-time');
    if (!timeSelect) return; 
    
    timeSelect.innerHTML = "";
    
    let m = "صباحاً";
    let e = "مساءً";
    
    let times = (periodInput.value === "صباحاً") ? 
        [`08:00 ${m}`, `09:30 ${m}`, `10:45 ${m}`, `11:30 ${m}`] : 
        [`04:00 ${e}`, `05:15 ${e}`, `06:30 ${e}`, `07:45 ${e}`, `08:30 ${e}`];
    
    times.forEach(t => {
        let opt = document.createElement("option");
        opt.value = t; 
        opt.innerHTML = t;
        timeSelect.appendChild(opt);
    });
}


function confirmBooking() {
    const clinicElement = document.getElementById('clinic-type');
    const dateElement = document.getElementById('app-date');
    const timeElement = document.getElementById('app-time');

    if (!clinicElement || !dateElement || !timeElement) return;

    savedClinic = clinicElement.value;
    savedDate = dateElement.value;
    savedTime = timeElement.value;

    if (!savedClinic || !savedDate) {
        showAlert("يرجى اختيار العيادة والتاريخ أولاً"); 
        return;
    }

   
    document.getElementById('booking-form').style.display = 'none';
    document.getElementById('confirmation-msg').style.display = 'block';
    updateConfirmationText();
}


function resetForm() { 
    location.reload(); 
}

window.onload = updateTimes;

function showAlert(msg) {
    const alertBox = document.getElementById('custom-alert');
    const alertMsg = document.getElementById('alert-message');
    if (alertBox && alertMsg) {
        alertMsg.innerText = msg;
        document.getElementById('modal-btn').innerText = "موافق";
        alertBox.style.display = 'flex';
    }
}


function closeAlert() {
    const alertBox = document.getElementById('custom-alert');
    if (alertBox) {
        alertBox.style.display = 'none';
    }
}