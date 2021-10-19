const menu__toggler = document.querySelector('.destinations span')
const tog = document.querySelector('.destinations #menu__toggler');
const menu = document.querySelector('.dest__menu')
const toggler = document.querySelector('.dest__toggler');

const deploy_menu = (e) => {
    e.preventDefault();
    toggler.classList.toggle('active');
    menu.classList.toggle('active')

}

const listElements = document.querySelectorAll('.dest__menu li')
for (let el of listElements) {
    el.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('#dest').innerHTML = e.target.innerText;
        menu.classList.toggle('active');
        toggler.classList.toggle('active');
    })
}

menu__toggler.addEventListener('click', deploy_menu);
tog.addEventListener('click', deploy_menu);
