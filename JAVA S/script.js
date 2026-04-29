
        const passwordField = document.getElementById('passwordField');
        const toggleIcon = document.getElementById('toggleIcon');

        toggleIcon.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });

// وظيفة البحث عن الأعراض

function searchSymptoms() {
    let input = document.getElementById('searchbar').value.toLowerCase();
    let cards = document.getElementsByClassName('card');

    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].getAttribute('data-title');
        if (title.includes(input)) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}

function showAppointments() {
    document.getElementById('patient-profile').style.display = 'none';
    document.getElementById('appointments-list').style.display = 'block';
}

function showProfile() {
    document.getElementById('appointments-list').style.display = 'none';
    document.getElementById('patient-profile').style.display = 'block';
}
function openEditModal() {
    document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function saveChanges() {
    let nameValue = document.getElementById('newName').value;
    let phoneValue = document.getElementById('newPhone').value;
    let emailValue = document.getElementById('newEmail').value;


    if(nameValue) document.getElementById('patientName').innerText = nameValue;
    if(phoneValue) document.getElementById('patientPhone').innerText = phoneValue;
    if(emailValue) document.getElementById('patientEmail').innerText = emailValue;

    closeEditModal();
}
//مواعيد
function updateTimes() {
    const periodElements = document.getElementsByName('period');
    let selectedPeriod = "";
    
    // معرفة أي خيار تم اختياره (صباحاً/مساءً)
    for(let i = 0; i < periodElements.length; i++) {
        if(periodElements[i].checked) {
            selectedPeriod = periodElements[i].value;
        }
    }

    const timeSelect = document.getElementById('app-time');
    if(!timeSelect) return;
    
    timeSelect.innerHTML = ""; // تنظيف القائمة
    
    let times = (selectedPeriod === "صباحاً") 
        ? ["08:00 صباحاً", "09:30 صباحاً", "11:00 صباحاً"] 
        : ["04:00 مساءً", "05:30 مساءً", "07:15 مساءً"];
    
    times.forEach(t => {
        let opt = document.createElement("option");
        opt.value = t;
        opt.innerHTML = t;
        timeSelect.appendChild(opt);
    });
}

function confirmBooking() {
    const clinic = document.getElementById('clinic-type').value;
    const date = document.getElementById('app-date').value;
    const time = document.getElementById('app-time').value;

    if (!clinic || !date) {
        alert("يرجى اختيار العيادة والتاريخ أولاً");
        return;
    }

    // إخفاء الفورم وإظهار رسالة النجاح
    document.getElementById('booking-form').style.display = 'none';
    document.getElementById('confirmation-msg').style.display = 'block';

    document.getElementById('final-details').innerHTML = 
        `تم حجز موعد في <b>${clinic}</b> <br> بتاريخ <b>${date}</b> <br> الساعة <b>${time}</b>`;
}

// تنفيذ تحديث المواعيد عند فتح الصفحة لأول مرة
window.onload = updateTimes;