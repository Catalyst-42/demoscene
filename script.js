let xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        addAnswer(this.responseText);
    }
}

document.querySelector('.send').addEventListener('click', function () {
    console.log(document.querySelector('.input').value);
    
    xhttp.open("POST", "https://demoscene.herokuapp.com/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");    
    xhttp.send('str=' + document.querySelector('.input').value);
    
    document.querySelector('.input').value = '';
})

function addAnswer (data) {
    let p = document.createElement('p')
    p.innerHTML = data + '<br>'
    document.body.appendChild(p)
}