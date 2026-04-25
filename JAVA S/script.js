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