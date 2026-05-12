/*-- تنسيقات صفحة حجز  الموعد --*/
const doctorsByClinic = {
        "السمعيات": ["د. سارة الأحمد"],
        "الأسنان": ["د. نورة السعد"],
        "طب عام": ["د. ريم القحطاني"],
        "الأطفال": [ "د.سلمان علي"],
        "الجلدية": ["د. عمر فاروق"],
        "العظام": ["د.عبد الله الحربي"],
        "القلب": ["د. عبدالله مصلح"],
        "نساء وولادة": ["د. منى السالم"],
        "العلاج الطبيعي": ["د. هند التركي"],
        "الباطنية": ["د. فيصل الحربي"],
        "الصحة النفسية": ["د. جواهر سليمان"],
    };

    function updateDoctors() {
        const clinicSelect = document.getElementById('clinic-type');
        const doctorSelect = document.getElementById('doctor-select');
        const selected = clinicSelect.value;

        doctorSelect.innerHTML = '<option value="" disabled selected>اختر الطبيب المناسب</option>';

        if (doctorsByClinic[selected]) {
            doctorsByClinic[selected].forEach(doc => {
                let opt = document.createElement('option');
                opt.value = doc;
                opt.textContent = doc;
                doctorSelect.appendChild(opt);
            });
        }
    }

    function updateTimes() {
        const periodInput = document.querySelector('input[name="period"]:checked');
        const timeSelect = document.getElementById('app-time');
        if (!timeSelect || !periodInput) return;

        timeSelect.innerHTML = '<option value="" disabled selected>اختر الوقت</option>';
        let times = (periodInput.value === "صباحاً") ? 
            ["08:00 صباحاً", "09:30 صباحاً", "10:45 صباحاً", "11:30 صباحاً"] : 
            ["04:00 مساءً", "05:15 مساءً", "06:30 مساءً", "07:45 مساءً", "08:30 مساءً"];

        times.forEach(t => {
            let opt = document.createElement('option');
            opt.value = t;
            opt.textContent = t;
            timeSelect.appendChild(opt);
        });
    }

    function confirmBooking(event) {
        event.preventDefault(); // يمنع تحديث الصفحة

        // 1. إرسال البيانات لملف الـ PHP (أضفته لك هنا جوا الدالة)
        fetch('save_appointment.php', {
            method: 'POST',
            body: new FormData(document.getElementById('booking-form'))
        })
        .then(response => response.text())
        .then(data => {
            console.log("تم حفظ البيانات في القاعدة:", data);
        })
        .catch(error => {
            console.error("خطأ في الاتصال:", error);
        });

        // 2. إخفاء الفورم وإظهار الرسالة الزرقاء (كودك الأصلي)
        document.getElementById('booking-form').style.display = 'none';
        document.getElementById('confirmation-msg').style.display = 'block';
        
        const clinic = document.getElementById('clinic-type').value;
        const doctor = document.getElementById('doctor-select').value;
        const date = document.getElementById('app-date').value;
        const time = document.getElementById('app-time').value;
        
        document.getElementById('final-details').innerHTML = `
            <strong>العيادة:</strong> ${clinic} <br>
            <strong>الطبيب:</strong> ${doctor} <br>
            <strong>التاريخ:</strong> ${date} <br>
            <strong>الوقت:</strong> ${time}
        `;
    }

    window.onload = updateTimes;
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
 localStorage.setItem("selectedCategory", key);
    // الانتقال لصفحة التفاصيل
    window.location.href = "medical.html";
    const medicalData = {
    "Welcome": {
        title: "الاستقبال",
        tips: "أهلاً بك في MedicaSign. نحن هنا لمساعدتك.",
        img: "welcome.jpeg"
    },
    "duration": {
        title: "مدة التعب",
        tips: "منذ متى تشعر بهذه الأعراض؟",
        img: "duration.jpeg"
    },
    "headache": {
        title: "الصداع",
        tips: "هل الصداع مستمر أم يذهب ويأتي؟",
        img: "headache.jpeg"
    },
    "dizzy": {
        title: "الدوار",
        tips: "حاول الجلوس والراحة حتى يزول الدوار.",
        img: "dizzy.jpeg"
    },
    "questions": {
        title: "الاستفسارات",
        tips: "هل هناك أي استفسار آخر تود طرحه؟",
        img: "questions.jpeg"
    }
};
/*-- نهاية كود بيان --*/

