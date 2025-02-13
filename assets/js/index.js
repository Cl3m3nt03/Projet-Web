

document.addEventListener("DOMContentLoaded", function () {
    const dialogues = [
        { text: "Hey!", class: "dialogue", image: "assets/images/Burgerpants_face_3.webp", mascoClass: "mascotte" },
        { text: "Prêt pour un défi ?", class: "dialogue2", image: "assets/images/Burgerpants_face_4.webp", mascoClass: "mascotte2" },
        { text: "Connecte toi pour jouer !", class: "dialogue3", image: "assets/images/Burgerpants_face_2.webp", mascoClass: "mascotte3" },
        { text: "Bonne chance !", class: "dialogue4", image: "assets/images/Burgerpants_face_22.webp", mascoClass: "mascotte4" }
    ];

    const mascotte = document.querySelector('.mascotte');
    const bulle = document.querySelector('.bulle');
    const dialogueText = document.querySelector('.dialogue');
    let dialogueIndex = 0;

    const hasSeenMascotte = localStorage.getItem('hasSeenMascotte') === 'true';

    if (hasSeenMascotte) {
        
        mascotte.style.display = 'none';
        bulle.style.display = 'none';
        dialogueText.style.display = 'none';
    } else {
  
        updateDialogue();
    }

    mascotte.addEventListener("click", function () {
        dialogueIndex++;

        if (dialogueIndex < dialogues.length) {
            updateDialogue();
        } else {
       
            mascotte.classList.add("mascotte-slide-out");
            bulle.style.display = "none";
            dialogueText.style.display = "none";

           
            localStorage.setItem('hasSeenMascotte', 'true');
        }
    });

    function updateDialogue() {
    
        dialogueText.textContent = dialogues[dialogueIndex].text;

      
        dialogueText.className = `dialogue ${dialogues[dialogueIndex].class}`;
        mascotte.className = `mascotte ${dialogues[dialogueIndex].mascoClass}`;

       
        mascotte.src = dialogues[dialogueIndex].image;
    }

    document.getElementById('resetMascotte').addEventListener('click', function () {
       
        localStorage.removeItem('hasSeenMascotte');
        
        
        location.reload();
    });
});
