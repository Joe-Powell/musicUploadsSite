

// login and register modals

const modal_background = document.querySelector('.modal_background')

modal_background.addEventListener('click', () => {
    modal_background.classList.toggle('activate_display')
    login_modal.classList.remove('activate_display')
    register_modal.classList.remove('activate_display')
})

const login_nav_btn = document.querySelector('.login_nav_btn');
const login_modal = document.querySelector('.login_modal')

login_nav_btn.addEventListener('click', () => {
    modal_background.classList.toggle('activate_display')
    login_modal.classList.toggle('activate_display')
})


const register_nav_btn = document.querySelector('.register_nav_btn');
const register_modal = document.querySelector('.register_modal')

register_nav_btn.addEventListener('click', () => {
    modal_background.classList.toggle('activate_display')
    register_modal.classList.toggle('activate_display')
})



// Click onupload Button

const button_for_upload = document.querySelector('.button_for_upload');
const music_file_upload = document.querySelector('.music_file_upload');

// added if because when not logged in the error comes up for button_for_upload
if(button_for_upload){
    button_for_upload.addEventListener('click', () => {
        music_file_upload.click()
    })
}



// Click on audio player

const audios_with_src = document.querySelectorAll('.audio')
const play = document.querySelectorAll('.fa-play')
const pause = document.querySelectorAll('.fa-pause-circle')
const stop = document.querySelectorAll('.fa-stop')
const main_player = document.querySelector('.main-audio')
const main_audio_div_h3 = document.querySelector('.main-audio-div h3')
const title = document.querySelectorAll('.title')

for(let i =0; i < audios_with_src.length; i++) {
 play[i].addEventListener('click', (e) => {
     
    main_player.src = audios_with_src[i].src;
    main_player.play()

    main_audio_div_h3.innerHTML= title[i].innerHTML;

      
    })

pause[i].addEventListener('click', () => {
    main_player.pause()
})

stop[i].addEventListener('click', () => {
    main_player.pause()
    main_player.currentTime = 0;  // there is no stop() function so had to do this
})


}


