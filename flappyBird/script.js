let move_speed = 3;
let gravity = 0.5;
let bird = document.querySelector('.bird');
let img = document.getElementById('bird-1');
let bird_dy = 0;

let bird_props = bird.getBoundingClientRect();
let score_val = document.querySelector('.score_val');
let message = document.querySelector('.message');
let score_title = document.querySelector('.score_title');
let game_state = 'Start';

img.style.display = 'none';
message.classList.add('messageStyle');

document.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && game_state !== 'Play') {
        document.querySelectorAll('.pipe_sprite').forEach((e) => {
            e.remove();
        });
        img.style.display = 'block';
        bird.style.top = '40vh';
        bird_dy = 0; // Reset bird's vertical speed
        game_state = 'Play';
        message.innerHTML = '';
        score_title.innerHTML = 'Score : ';
        score_val.innerHTML = '0';
        message.classList.remove('messageStyle');
        play();
    } else if ((e.key === 'ArrowUp' || e.key === ' ') && game_state === 'Play') {
        jump();
    }
});

function jump() {
    bird_dy = -7.6; // Adjust as needed for desired jump height
    img.src = 'Bird-2.png';
    setTimeout(() => {
        img.src = 'Bird.png';
    }, 200); // Adjust delay as needed for the animation duration
}


function play() {
    function move() {
        if (game_state !== 'Play') return;

        let pipe_sprite = document.querySelectorAll('.pipe_sprite');
        pipe_sprite.forEach((element) => {
            let pipe_sprite_props = element.getBoundingClientRect();
            bird_props = bird.getBoundingClientRect();

            if (pipe_sprite_props.right <= 0) {
                element.remove();
            } else {
                if (
                    bird_props.left < pipe_sprite_props.left + pipe_sprite_props.width &&
                    bird_props.left + bird_props.width > pipe_sprite_props.left &&
                    bird_props.top < pipe_sprite_props.top + pipe_sprite_props.height &&
                    bird_props.top + bird_props.height > pipe_sprite_props.top
                ) {
                    endGame();
                    return;
                } else {
                    if (
                        pipe_sprite_props.right < bird_props.left &&
                        pipe_sprite_props.right + move_speed >= bird_props.left &&
                        element.increase_score === '1'
                    ) {
                        score_val.innerHTML = +score_val.innerHTML + 1;
                    }
                    element.style.left = pipe_sprite_props.left - move_speed + 'px';
                }
            }
        });
        requestAnimationFrame(move);
    }
    requestAnimationFrame(move);

    function apply_gravity() {
        if (game_state !== 'Play') return;
        bird_dy = bird_dy + gravity;
        if (bird_dy > 10) bird_dy = 10; // Limiting the downward speed

        if (bird_props.top <= 0 || bird_props.bottom >= window.innerHeight) {
            endGame();
            return;
        }

        bird.style.top = bird_props.top + bird_dy + 'px';
        bird_props = bird.getBoundingClientRect();
        requestAnimationFrame(apply_gravity);
    }
    requestAnimationFrame(apply_gravity);

    let pipe_separation = 0;

    function create_pipe() {
        if (game_state !== 'Play') return;

        if (pipe_separation > 115) {
            pipe_separation = 0;

            let pipe_posi = Math.floor(Math.random() * 43) + 8;
            let pipe_sprite_inv = document.createElement('div');
            pipe_sprite_inv.className = 'pipe_sprite';
            pipe_sprite_inv.style.top = pipe_posi - 70 + 'vh';
            pipe_sprite_inv.style.left = '100vw';

            document.body.appendChild(pipe_sprite_inv);
            let pipe_sprite = document.createElement('div');
            pipe_sprite.className = 'pipe_sprite';
            pipe_sprite.style.top = pipe_posi + 35 + 'vh'; // Changed to pipe_gap
            pipe_sprite.style.left = '100vw';
            pipe_sprite.increase_score = '1';

            document.body.appendChild(pipe_sprite);
        }
        pipe_separation++;
        requestAnimationFrame(create_pipe);
    }
    requestAnimationFrame(create_pipe);
}

function endGame() {
    game_state = 'End';
    message.innerHTML = 'Game Over'.fontcolor('red') + '<br>Press Enter To Restart';
    message.classList.add('messageStyle');
    img.style.display = 'none';
}

// Continuously update bird_props
function updateBirdProps() {
    bird_props = bird.getBoundingClientRect();
    requestAnimationFrame(updateBirdProps);
}
updateBirdProps();
