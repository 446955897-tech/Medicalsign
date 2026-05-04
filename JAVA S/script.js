/*-- تنسيقات صفحة حجز  الموعد --*/
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
        opt.value = t; 
        opt.innerHTML = t;
        timeSelect.appendChild(opt);
    });
}

function confirmBooking() {
    const clinic = document.getElementById('clinic-type').value;
    const date = document.getElementById('app-date').value;
    const time = document.getElementById('app-time').value;

    if (!clinic || !date || !time) {
        showAlert("يرجى اختيار العيادة، التاريخ، والوقت أولاً"); 
        return;
    }

    document.getElementById('booking-form').style.display = 'none';
    document.getElementById('confirmation-msg').style.display = 'block';
    
    document.getElementById('final-details').innerHTML = 
    `تم حجز موعد في عيادة <br> <b>${clinic}</b> <br> بتاريخ <b>${date}</b> <br> الساعة <b>${time}</b>`;
}

function showAlert(msg) {
    const alertBox = document.getElementById('custom-alert');
    if(alertBox) {
        document.getElementById('alert-message').innerText = msg;
        alertBox.style.display = 'flex';
    }
}

function closeAlert() { 
    document.getElementById('custom-alert').style.display = 'none'; 
}
window.onload = function() {
    updateTimes();
};
/* --نهاية تنسيقات صفحة حجز الموعد --*/


// عرض المواعيد أو الملف الشخصي ليان 



//مواعيد
// تحديث المواعيد بناءً على الفترة
function updateTimes() {
    const periodElements = document.getElementsByName('period');
    let selected = "صباحاً";
    for(let i=0; i<periodElements.length; i++) {
        if(periodElements[i].checked) selected = periodElements[i].value;
    }

    const timeSelect = document.getElementById('app-time');
    if(!timeSelect) return;
    
    timeSelect.innerHTML = "";
    let slots = (selected === "صباحاً") 
        ? ["08:00 صباحاً", "09:30 صباحاً", "11:00 صباحاً"] 
        : ["04:00 مساءً", "05:30 مساءً", "07:15 مساءً"];

    slots.forEach(s => {
        let opt = document.createElement("option");
        opt.value = s; opt.innerHTML = s;

        timeSelect.appendChild(opt);
    });
}



// حفظ البيانات والانتقال لصفحة التأكيد
function goToConfirmation() {

    const clinic = document.getElementById('clinic-type').value;
    const date = document.getElementById('app-date').value;
    const time = document.getElementById('app-time').value;




// عرض البيانات في صفحة التأكيد عند تحميلها
window.onload = function() {
    if(document.getElementById('display-details')) {
        const c = localStorage.getItem('booking_clinic');
        const d = localStorage.getItem('booking_date');
        const t = localStorage.getItem('booking_time');
        document.getElementById('display-details').innerHTML = 
            `تم حجز موعد في <b>${c}</b> <br> بتاريخ <b>${d}</b> <br> الساعة <b>${t}</b>`;
    } else {
        updateTimes(); // تشغيل المواعيد إذا كنا في صفحة الحجز
    }
}

// تنفيذ تحديث المواعيد عند فتح الصفحة لأول مرة
window.onload = updateTimes;
// ==========================================
// كود إعدادات الحساب - بشاير (بداية)
// ==========================================

function saveData() {
    let newPass = document.getElementById("newPassword").value;
    let confirmPass = document.getElementById("confirmPassword").value;
    let message = document.getElementById("successMsg");

    // 1. التحقق من أن الحقول ليست فارغة
    if (newPass === "" || confirmPass === "") {
        alert("يرجى تعبئة جميع الحقول المطلوبة");
        return;
    }

    // 2. التحقق من تطابق كلمة المرور الجديدة مع التأكيد
    if (newPass !== confirmPass) {
        alert("كلمة المرور غير متطابقة");
        return;
    }

    // 3. التحقق من أن طول كلمة المرور لا يقل عن 6 خانات
    if (newPass.length < 6) {
        alert("كلمة المرور يجب أن تكون 6 أحرف على الأقل");
        return;
    }

    // 4. حفظ كلمة المرور في التخزين المحلي (Local Storage)
    localStorage.setItem("password", newPass);

    // 5. إظهار رسالة النجاح للمستخدم
    message.style.display = "block";

    // 6. إخفاء الرسالة تلقائياً بعد 3 ثواني
    setTimeout(() => {
        message.style.display = "none";
    }, 3000);
}

// ==========================================
// كود إعدادات الحساب - بشاير (نهاية)
// ==========================================






/*-- بداية كود بيان --*/
function go(key){
  localStorage.setItem("lang", lang);
  window.location.href = "medical.html?case=" + key;
}

// قراءة اللغة المحفوظة
let lang = localStorage.getItem("lang") || "ar";

// عند فتح الصفحة
window.onload = function(){
  applyLang();
};

function toggleLang(){
  lang = (lang === "ar") ? "en" : "ar";
  localStorage.setItem("lang", lang);
  applyLang();
}

function applyLang(){
  let items = document.querySelectorAll("[data-ar]");
  let btn = document.getElementById("langToggle");

  if(lang === "en"){
    items.forEach(el => el.innerText = el.dataset.en);

    let title = document.getElementById("mainTitle");
    if(title) title.innerText = "Medical Sentences";

    if(btn) btn.innerText = "AR";
    document.documentElement.dir = "ltr";

  } else {
    items.forEach(el => el.innerText = el.dataset.ar);

    let title = document.getElementById("mainTitle");
    if(title) title.innerText = "الجمل الطبية";

    if(btn) btn.innerText = "EN";
    document.documentElement.dir = "rtl";
  }
}
/*-- نهاية كود بيان --*/

/*-- بداية كود جوري --*/

// Tabs
function openTab(tab){
  document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
  document.getElementById(tab).classList.add('active');

  document.querySelectorAll('.tabs button').forEach(btn => btn.classList.remove('active'));

  if(tab === 'register'){
    document.querySelectorAll('.tabs button')[0].classList.add('active');
  } else {
    document.querySelectorAll('.tabs button')[1].classList.add('active');
  }
}

// GPS
function getLocation(){
  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(function(pos){
      let lat = pos.coords.latitude;
      let lon = pos.coords.longitude;

      document.getElementById("map").src =
        "https://maps.google.com/maps?q=" + lat + "," + lon + "&z=15&output=embed";
    });
  } else {
    alert("المتصفح لا يدعم GPS");
  }
}

// Register submit
document.getElementById("form").addEventListener("submit", function(e){
  e.preventDefault();
  document.getElementById("successMsg").style.display = "block";
});

// Doctor Register
document.getElementById("doctorForm").addEventListener("submit", function(e){
  e.preventDefault();
  document.querySelector("#login .success").style.display = "block";
});

/*-- نهاية كود جوري --*/


