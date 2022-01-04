var input = document.getElementById('input');
var tachecontainer = document.querySelector('#tachecontent');
var bouton = document.querySelector('#bouton');
var supp = document.querySelector('#supp')
var numero_tache = 0;



//creaction d'une tache
function createtache(whereadd){
    let labels = document.createElement('label');
    labels.classList.add(numero_tache)
    labels.innerHTML = input.value


    let checkbox = document.createElement('input');
    checkbox.type ='checkbox'
    checkbox.setAttribute('id',numero_tache)
    numero_tache++
    labels.appendChild(checkbox)
    whereadd.appendChild(labels)

}
//bouton creation de taches
bouton.addEventListener('click', (e)=>{
        e.preventDefault();
        createtache(tachecontainer)
        input.value = ''
    }

)

//Suppression des taches
supp.addEventListener('click',(event)=>{
    event.preventDefault()
    let tachesselect = document.querySelectorAll("input[type='checkbox']:checked" )
    for(let i = 0;i<tachesselect.length;i++ ){
        let cb = tachesselect[i];
        let lbl = cb.parentNode;
        let content = document.getElementById("tachecontent");
        content.removeChild(lbl);
     }
})