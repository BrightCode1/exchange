//login section
//login and signup slide
document.querySelector('.registerBtn').addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelector('.signup').classList.remove('on');
    document.querySelector('.login').classList.remove('on');
});
document.querySelector('.loginBtn').addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelector('.signup').classList.toggle('on');
    document.querySelector('.login').classList.toggle('on');
})

//login checkbox click event
document.querySelector('.checkbox').addEventListener('click', () => {
    document.querySelector('#check').click();
})



//get list of all country and display in login
getCountry = () => {
    fetch('data/countries.json')
        .then((res) => res.json())
        .then((data) => {
            let output = '<option>Add Your Country</option>';
            data.forEach((user) => {
                output += `<option value='${user.name}'>${user.name}&nbsp;(${user.code})</option>`;
            })
            document.getElementById('country').innerHTML = output;
        })
}
getCountry();


//file click event
const inputFile = document.querySelector("#file");
const fileName = document.querySelector("#filename");


function btnFile() {
    inputFile.click();
}
inputFile.addEventListener('change', function () {
    if (inputFile.value) {
        fileName.innerHTML = inputFile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
        inputFile.innerHTML = "No Files Chosen";
    }
});
