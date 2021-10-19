const reservationForm = document.querySelector('#reservationForm');

reservationForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let errors = 0;
    console.log(e)
    for(let el of e.target){
        // console.log(el.value.length)
        if(el.value.length < 1){
            errors = 1
            console.log('erreur');
        }
    }
    if(errors == 1){
        alert('le formulaire ne peut pas être vide');
    }else{
        e.target.submit();
    }
})