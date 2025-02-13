let button = document.querySelector('#validebut'); 
let startTime;
let timerInterval;
let revealedCards = [];
let matchedPairs = 0;
let gridSize;


function startTimer() {
    timerInterval = setInterval(() => {
        let elapsedTime = new Date() - startTime;
        let minutes = Math.floor((elapsedTime / (1000 * 60)) % 60);
        let seconds = Math.floor((elapsedTime / 1000) % 60);
        let milliseconds = Math.floor((elapsedTime % 1000) / 10);

        document.querySelector('#timer').textContent = 
            `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}:${String(milliseconds).padStart(2, '0')}`;
    }, 10);
}

button.addEventListener('click', function(event) {
    endGame(finalTime, new Date(), difficulty, theme);
});

function endGame() {
    let finalTime = document.querySelector('#timer').textContent;
    

    clearInterval(timerInterval); 
    console.log("Appel de Mascotte()");
    Mascotte(finalTime);
    
}



function checkForMatch() {
    let [card1, card2] = revealedCards;
    

    if (card1.dataset.src === card2.dataset.src) { 
        card1.classList.add('matched');
        card2.classList.add('matched');
        matchedPairs++;
        revealedCards = [];
        
        if (matchedPairs === (gridSize * gridSize) / 2) {
            endGame();
            
           
        }    
    } else {
        setTimeout(() => {
            card1.classList.remove('revealed');
            card2.classList.remove('revealed');

            card1.querySelector('.card-back').classList.remove('hidden');
            card2.querySelector('.card-back').classList.remove('hidden');
            card1.querySelector('.card-front').classList.add('hidden');
            card2.querySelector('.card-front').classList.add('hidden');

            revealedCards = [];
        }, 1000);
    }
}

    let difficulty = document.querySelector('#difficulty-game').value;
    let theme = document.querySelector('#game-pers').value;
    let gridContainer = document.querySelector('.game-grid');

button.addEventListener('click', function(event) {
    let difficulty = document.querySelector('#difficulty-game').value;
    let theme = document.querySelector('#game-pers').value;
    let gridContainer = document.querySelector('.game-grid');

    

    gridContainer.innerHTML = '';
    clearInterval(timerInterval); 
    matchedPairs = 0;
    revealedCards = [];
    startTime = new Date();

    startTimer();

        if (difficulty == "1") {
            gridSize = 4;
            gridContainer.className = "game-grid grid-4x4"; 
        } else if (difficulty == "2") {
            gridSize = 6;
            gridContainer.className = "game-grid grid-6x6"; 
        } else if (difficulty == "3") {
            gridSize = 8;
            gridContainer.className = "game-grid grid-8x8"; 
        }

    let imageIds = Array.from({ length: (gridSize * gridSize) / 2 }, (_, i) => i + 1);
    let cardIds = [...imageIds, ...imageIds];
    shuffle(cardIds);

        cardIds.forEach((id) => {
            let cell = document.createElement('div');
            cell.className = 'case_game';
        
            let backImg = document.createElement('img');
            backImg.src = 'assets/images/theme/default-back.png'; 
            backImg.classList.add('card-back'); 
            cell.appendChild(backImg);
        
            let frontImg = document.createElement('img');
            frontImg.src = `assets/images/theme/theme1/${id}.png`; 
            frontImg.classList.add('card-front', 'hidden'); 
            cell.dataset.src = frontImg.src; 
            cell.appendChild(frontImg);
        
            if (theme === "1") {
                cell.classList.add('theme-orange');
                frontImg.src = `assets/images/theme/theme1/${id}.png`;
            } else if (theme === "2") {
                frontImg.src = `assets/images/theme/theme2/${id}.png`; 
                cell.classList.add('theme-bleu');
            } else if (theme === "3") {
                frontImg.src = `assets/images/theme/theme3/${id}.png`; 
                cell.classList.add('theme-vert');
            }
        
            cell.addEventListener('click', () => revealCard(cell));
        
            gridContainer.appendChild(cell);
        });        
        
    });

function revealCard(card) {
    if (revealedCards.length < 2 && !card.classList.contains('revealed')) {
        card.classList.add('revealed');

        card.querySelector('.card-back').classList.add('hidden'); 
        card.querySelector('.card-front').classList.remove('hidden'); 

        revealedCards.push(card);

        if (revealedCards.length === 2) {
            checkForMatch();
        }
    }
}



function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}



function Mascotte(finalTime) {
    const dialogues = [
        { text: "pas mal petit!", class: "dialogue", image: "assets/images/Burgerpants_face_3.webp", mascoClass: "mascotte", bullee: "bulle" },
        { text: `Un temps de ${finalTime}`, class: "dialogue2", image: "assets/images/Burgerpants_face_4.webp", mascoClass: "mascotte2", bullee: "bulle2" },
        { text: "VRAIMENT IMPRESSIONANT", class: "dialogue3", image: "assets/images/Burgerpants_face_2.webp", mascoClass: "mascotte3", bullee: "bulle3" },
        { text: "Hesite pas a rejouer hehe", class: "dialogue4", image: "assets/images/Burgerpants_face_22.webp", mascoClass: "mascotte4" , bullee: "bulle4"}
    ];

    const mascotte = document.querySelector('.mascotte');
    const bulle = document.querySelector('.bulle');
    const dialogueText = document.querySelector('.dialogue');
    let dialogueIndex = 0;


    mascotte.style.display = 'block';
    bulle.style.display = 'block';
    dialogueText.style.display = 'block';

 
    updateDialogue();

    mascotte.addEventListener("click", function () {
        dialogueIndex++;
        
        if (dialogueIndex === 3){
            postScore(finalTime, new Date(), difficulty, 1);
          }

        if (dialogueIndex < dialogues.length) {
            updateDialogue();
        } else {
           
            mascotte.classList.add("mascotte-slide-out");
            bulle.classList.add("bulle-slide-out");

          
            setTimeout(() => {
                
                mascotte.style.display = 'none';
                bulle.style.display = 'none';
                dialogueText.style.display = 'none';
                
            }, 1000); 
        }
    });

    function updateDialogue() {
        dialogueText.textContent = dialogues[dialogueIndex].text;
        dialogueText.className = `dialogue ${dialogues[dialogueIndex].class}`;
        mascotte.className = `mascotte ${dialogues[dialogueIndex].mascoClass}`;
        bulle.className = `bulle ${dialogues[dialogueIndex].bullee}`;
        mascotte.src = dialogues[dialogueIndex].image;
        
    }
}


function formatDate(date) {
    let year = date.getFullYear();
    let month = String(date.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
    let day = String(date.getDate()).padStart(2, '0');
    let hours = String(date.getHours()).padStart(2, '0');
    let minutes = String(date.getMinutes()).padStart(2, '0');
    let seconds = String(date.getSeconds()).padStart(2, '0');
    
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

function postScore(temps, date_heure_partie, difficulte, id_jeu) {
    const formattedDate = formatDate(date_heure_partie);
    const postData = {
        temps: temps,
        dateHeure: formattedDate,
        difficulte: difficulte,
        id_jeu: id_jeu
    };
    console.log(postData);
    ajaxPost(postData);
    afficherPopup(temps);
    
}


function ajaxPost(postData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajaxPost.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            console.log("Réponse brute du serveur : ", xhr.responseText); // Affiche la réponse brute
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    console.log(data); // Affiche les données JSON
                } catch (error) {
                    console.error("Erreur de parsing JSON:", error);
                }
            } else {
                console.error("Erreur AJAX. Code de statut:", xhr.status);
            }
        }
    };
    
    xhr.send(JSON.stringify(postData));
}

  function afficherPopup(temps) {
    const overlay = document.createElement('div');
    overlay.id = 'popupOverlay';
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    overlay.style.display = 'flex';
    overlay.style.alignItems = 'center';
    overlay.style.justifyContent = 'center';
    document.body.appendChild(overlay);

    const popup = document.createElement('div');
    popup.style.backgroundColor = '#fff';
    popup.style.padding = '20px';
    popup.style.borderRadius = '8px';
    popup.style.textAlign = 'center';
    popup.innerHTML = `
        
        <button id="rejouerBtn">Rejouer</button>
    `;
    overlay.appendChild(popup);

    document.getElementById('rejouerBtn').addEventListener('click', () => {
        location.reload(); // Recharge la page pour rejouer
    });
}