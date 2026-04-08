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