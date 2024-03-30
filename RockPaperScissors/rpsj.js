const pScore = document.getElementById('playerScore');
const cScore = document.getElementById('computerScore');
const buttons = document.querySelectorAll('.selection button');
const showIcon = document.querySelector('.show i');
const computerShowIcon = document.querySelector('.computer i');

// Storing the scores.
let computerScore = 1;
let playerScore = 1;

const rockIcon = "fas fa-hand-rock";
const paperIcon = "fas fa-hand-paper";
const scissorsIcon = "fas fa-hand-scissors";

const randomClasses = [rockIcon, paperIcon, scissorsIcon];
const text = document.getElementById('demo');
const text2 = document.getElementById('demo2');

const draw = ()=>{
    text.innerHTML = "It's a Draw ! ";
    text.style.color = 'orange';
    text2.innerHTML = text.innerHTML;
    text2.style.color = 'orange';
}

const win = ()=>{
    text.innerHTML = "You Win! ";
    text.style.color = 'rgb(1, 146, 1)';
    text2.innerHTML = text.innerHTML;
    text2.style.color = 'rgb(1, 146, 1)';
}

const lose = ()=>{
    text.innerHTML = "You Lost ! ";
    text.style.color = 'red';
    text2.innerHTML = text.innerHTML;
    text2.style.color = 'red';
}

// Game Functionality.
const game = () =>{
    buttons.forEach(btn =>{
        btn.addEventListener('click',(e)=>{
        // Random rock paper scissor for the computer and clicked ones for the player
           let clickedBtn = e.target.className;
           showIcon.className = clickedBtn;
           let randomNum = Math.floor(Math.random() * randomClasses.length);
           computerShowIcon.className = randomClasses[randomNum];

           // If it's a draw .
           if(showIcon.className === computerShowIcon.className){
               pScore.innerHTML = pScore.innerHTML;
               cScore.innerHTML = cScore.innerHTML;
               draw();
           }

           // if it's not a draw.
           else if(showIcon.className === rockIcon && computerShowIcon.className === scissorsIcon){
               pScore.innerHTML = playerScore;
               playerScore++;
               win();
           }else if(showIcon.className === rockIcon && computerShowIcon.className === paperIcon){
               cScore.innerHTML = computerScore;
               computerScore++;
               lose();
           }else if(showIcon.className === paperIcon && computerShowIcon.className === scissorsIcon){
               cScore.innerHTML = computerScore;
               computerScore++;
               lose();
           }else if(showIcon.className === paperIcon && computerShowIcon.className === rockIcon){
               pScore.innerHTML = playerScore;
               playerScore++;
               win();
           }else if(showIcon.className === scissorsIcon && computerShowIcon.className === rockIcon){
               cScore.innerHTML = computerScore;
               computerScore++;
               lose();
           }else if(showIcon.className === scissorsIcon && computerShowIcon.className === paperIcon){
               pScore.innerHTML = playerScore;
               playerScore++;
               win();
           }
        });
    });
}

// Run the game.
game();


