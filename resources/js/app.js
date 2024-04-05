import './bootstrap';


const inputDate = document.querySelector("#date_of_match")
if(inputDate){
    inputDate.addEventListener("click", ()=> {
        inputDate.showPicker();
    })
}

document.addEventListener("DOMContentLoaded", ()=> {
    if(inputDate){
        inputDate.value = new Date().toISOString().split('T')[0];
    }
})
