/**
 * 
 * Trigger with language change
 * 
 */
const langChangerBtn = document.querySelector('#langChangerBtn');
const langDropdown = document.querySelector('.langDropdown');
const langList = document.querySelectorAll('.langList');

langChangerBtn.addEventListener('click', function (event) {
    event.preventDefault()
    langDropdown.classList.toggle('toggleDropdown')
})

for (i = 0; i < langList.length; i++) {
    langList[i].addEventListener('click', function () {

        const selectedLanguge = this.children[1].innerHTML;
        const langCode = this.children[1].getAttribute("data-code");

        document.querySelector('.active-lang').innerHTML = selectedLanguge;
        document.querySelector('.language_code').value = langCode;
        document.querySelector('.active-flag').setAttribute("src", "public/assets/images/flag/" + langCode + "_24.png");
        langDropdown.classList.remove('toggleDropdown');

    });
}

/**
 * 
 * select single checkbox and insert data into main selection box
 * 
 */
const dataCopyBox = document.querySelector('.dataCopyBox');
const checkboxes = document.getElementsByClassName('checked');
const mainCheckbox = document.getElementById('main-checkbox');

var keyList = []

function toggle(source) {
    if (!keyList.includes(source.value)) {
        keyList.push(source.value);
    } else {
        var keyIndex = keyList.indexOf(source.value);
        keyList.splice(keyIndex, 1);
    }
    appendDatatoMainBox(keyList.join(", "));
}

function appendDatatoMainBox(keywords) {
    dataCopyBox.innerHTML = keywords
}


/**
 * 
 * select all checkbox at a time and insert into main selection box
 * 
 */
var flag = false
function toggleAll() {
    keyList = []
    if (!flag) {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true
            flag = true
            keyList.push(checkboxes[i].value)
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            var keyIndex = keyList.indexOf(checkboxes[i].value);
            keyList.splice(keyIndex, 1);
            checkboxes[i].checked = false
            flag = false
        }
    }
    appendDatatoMainBox(keyList.join(", "));
}


/**
 * 
 * clear all selected checkbox
 * 
 */
let clearBtn = document.querySelector('#clear')
clearBtn.addEventListener('click', function () {
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false
    }
    mainCheckbox.checked = false
    keyList = []
    appendDatatoMainBox(keyList.join(", "));
    flag = false
})


/**
 * 
 * Copy Selection
 * 
 */
const copyButton = document.getElementById('copyBtn');
copyButton.addEventListener('click', function (copyAll) {
    copyAll.preventDefault()
    const createInput = document.createElement('input');
    const boxInnerText = dataCopyBox.innerText;
    createInput.value = boxInnerText;

    document.body.appendChild(createInput);
    createInput.select();
    document.execCommand('copy');
    document.body.removeChild(createInput)
    const copiedAlert = document.createElement('div');
    copiedAlert.classList.add("copied-message");
    copiedAlert.innerHTML = `<i class="fas fa-check"></i>
<p>Data Copied!</p>`;
    dataCopyBox.appendChild(copiedAlert)

    setTimeout(function () {
        dataCopyBox.removeChild(copiedAlert)
    }, 2000);

})