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