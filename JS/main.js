

// login and register modals

const modal_background = document.querySelector('.modal_background')
const login_nav_btn = document.querySelectorAll('.login_nav_btn');
const register_nav_btn = document.querySelectorAll('.register_nav_btn');
const login_modal = document.querySelector('.login_modal')
const register_modal = document.querySelector('.register_modal')

modal_background.addEventListener('click', () => {
    modal_background.classList.remove('activate_display')
    login_modal.classList.remove('activate_display')
    register_modal.classList.remove('activate_display')
})

for(let i =0; i < login_nav_btn.length; i++) {



login_nav_btn[i].addEventListener('click', () => {
    modal_background.classList.toggle('activate_display')
    login_modal.classList.toggle('activate_display')
})


register_nav_btn[i].addEventListener('click', () => {
    modal_background.classList.toggle('activate_display')
    register_modal.classList.toggle('activate_display')
})

}





// Click onupload Button

const button_for_upload = document.querySelector('.button_for_upload');
const music_file_upload = document.querySelector('.music_file_upload');
const input_and_publish_btn = document.querySelector('.input_and_publish_btn')

// added if because when not logged in the error comes up for button_for_upload
if(button_for_upload){
    button_for_upload.addEventListener('click', () => {
        music_file_upload.click()
        input_and_publish_btn.style.display = 'inline-block';
    })
}






// Click on delete button
const delete_btns = document.querySelectorAll('.delete-btn');
const delete_forms = document.querySelectorAll('.delete_form')
const delete_form_cancel =  document.querySelectorAll('.delete_form .cancel_delete')
for(let i =0; i < delete_btns.length; i++) {

delete_btns[i].addEventListener('click', () => {
    console.log('clicked')
    delete_forms[i].classList.toggle('activate_display')
})

delete_form_cancel[i].addEventListener('click', () => {
    delete_forms[i].classList.toggle('activate_display')
})


}




// Click on edit button
const edit_btns = document.querySelectorAll('.edit-btn');
const edit_forms = document.querySelectorAll('.edit_form')
const cancel_update = document.querySelectorAll('.cancel_update')
for(let i =0; i < edit_btns.length; i++) {

edit_btns[i].addEventListener('click', () => {
    console.log('clicked')
    edit_forms[i].classList.toggle('activate_display')
})

cancel_update[i].addEventListener('click', () => {
   edit_forms[i].classList.toggle('activate_display') 
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
const containProgressBar = document.querySelectorAll('.containProgressBar')
const progress = document.querySelectorAll('.progress')

for(let i =0; i < audios_with_src.length; i++) {

         //  For progress bar
         main_player.addEventListener('timeupdate', (e) => {
           // console.log((e.target.currentTime  / main_player.duration) *100)
            const percentage = (e.target.currentTime  / main_player.duration) *100;
            progress[i].style.width = `${percentage}%`;

        })

        containProgressBar[i].onclick = (e) => {
            console.log(e)
            
            const clickedOffsetX = e.offsetX;
            const width = e.target.offsetWidth;
            const duration =audios_with_src[i].duration;
            console.log('e.offesetX' ,clickedOffsetX)
            console.log('width ' ,width)      
            console.log('duration ',duration);

            console.log((clickedOffsetX/ width) * duration)
           main_player.currentTime =  (clickedOffsetX/ width) * duration;       // divide the clickedX by the entire width then * 100

        }
  

 play[i].addEventListener('click', (e) => {
     
    main_player.src = audios_with_src[i].src;
    main_player.play()

   
    
    
    })

pause[i].addEventListener('click', () => {
    
    if (main_player.paused) {
        main_player.play();
    }
    else {
        main_player.pause();
    }
  
})


stop[i].addEventListener('click', () => {
    main_player.pause()
    main_player.currentTime = 0;  // there is no stop() function so had to do this
})


}




// When click on the Hamburger menu

const Hamburger_menu_bars = document.querySelector('.nav .fa-bars')
const nav_mobile_ul = document.querySelector('.nav_mobile ul')
const main_page = document.querySelector('.main_page')

Hamburger_menu_bars.addEventListener('click', () => {
    nav_mobile_ul.classList.toggle('activate_submenu')
    main_page.classList.toggle('activate_add_padding')
})




