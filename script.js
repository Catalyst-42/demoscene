document.querySelector('.send').addEventListener('click', function () {
    console.log(document.querySelector('input').value);
    
    xhttp.open("POST", "http://demoscene.herokuapp.com/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('str='+document.querySelector('input').value);
    
    document.querySelector('input').value = '';
})

let xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        addAnswer(this.responseText);
    }
}

function addAnswer (data) {
    let p = document.createElement('p')
    p.innerHTML = data
    document.body.appendChild(p)
    console.log(data);
}