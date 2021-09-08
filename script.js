let xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        addAnswer(this.responseText);
    }
}

document.querySelector('.send').addEventListener('click', function () {    
    xhttp.open("POST", "https://demoscene.herokuapp.com/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");    
    xhttp.send('str=' + document.querySelector('.input').value);
    
    document.querySelector('.input').value = '';
})

function addAnswer (data) {

    // let date_ob = new Date()
    // let date = ("0" + date_ob.getDate()).slice(-2)
    // let month = ("0" + (date_ob.getMonth() + 1)).slice(-2)
    // let year = date_ob.getFullYear()
    // let hours = date_ob.getHours()
    // let minutes = date_ob.getMinutes()
    // let seconds = date_ob.getSeconds()

    data = JSON.parse(data)
    console.log(data.length)
    
    for (let i=0; i<data.length; i++) {
        let p = document.createElement('p')
        p.classList.add('comment')
        p.id = data[i]['id']

        // p.innerHTML =  year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds + '<br>' + data
        p.innerHTML =  data[i]['data'] + "<br>" + data[i]['comment']
        document.body.querySelector('.comments').appendChild(p)
    }
}