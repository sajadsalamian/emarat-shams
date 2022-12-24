
let inputHour = document.getElementsByClassName('inputHour');
for (let hinput of inputHour) {
    for (let i = 0; i < 24; i++) {
        let option = document.createElement('option');
        option.setAttribute('value', i);
        option.innerHTML = i;
        if (i === 7) {
            option.setAttribute('selected', 'selected')
        }
        hinput.appendChild(option);
    }
}

let inputMin = document.getElementsByClassName('inputMinute');
for (let hinput of inputMin) {
    for (let i = 0; i < 59; i = i + 5) {
        let option = document.createElement('option');
        option.setAttribute('value', i);
        option.innerHTML = i;
        hinput.appendChild(option);
    }
}

let todayPersian = new Date().toLocaleDateString('fa-IR-u-nu-latn');
let persianTodayArray = todayPersian.split('/');

let inputDay = document.getElementsByClassName('inputDay');
for (let hinput of inputDay) {
    for (let i = 1; i < 32; i++) {
        let option = document.createElement('option');
        option.setAttribute('value', i);
        option.innerHTML = i;
        if (persianTodayArray[2] == i){
            option.setAttribute('selected', 'selected')
        }
        hinput.appendChild(option);
    }
}

let inputMonth = document.getElementsByClassName('inputMonth');
for (let hinput of inputMonth) {
    for (let i = 1; i < 13; i++) {
        let option = document.createElement('option');
        option.setAttribute('value', i);
        option.innerHTML = i;
        if (persianTodayArray[1] == i){
            option.setAttribute('selected', 'selected')
        }
        hinput.appendChild(option);
    }
}

let inputYear = document.getElementsByClassName('inputYear');
for (let hinput of inputYear) {
    for (let i = 1401; i < 1404; i++) {
        let option = document.createElement('option');
        option.setAttribute('value', i);
        option.innerHTML = i;
        if (persianTodayArray[0] == i){
            option.setAttribute('selected', 'selected')
        }
        hinput.appendChild(option);
    }
}

let textareaValue = '';

let writeText = (ele) => {
    textareaValue = ele.value;
    document.getElementById('textareaValue').innerHTML = textareaValue.replace(/\n\r?/g, '<br />');
}

function calculateTotalLoanAmount(){
    let loanAcceptedAmount = document.getElementById('accepted_amount').value;
    let loanPercentages = document.getElementById('percentages').value;
    if(loanAcceptedAmount === "" || loanAcceptedAmount == null){
        loanAcceptedAmount = 0
    }
    if(loanpercentages === "" || loanpercentages == null){
        loanpercentages = 0
    }
    let loanTotalAmount = parseInt(loanAcceptedAmount) + (parseInt(loanAcceptedAmount) * parseInt(loanpercentages) / 100);
    document.getElementById('return_amount').value = numberWithCommas(loanTotalAmount);
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
