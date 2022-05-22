// Facebook API
const form = document.querySelector('#searchForm');
const loader = document.querySelector('.loader');
const contentSection = document.querySelector('section');
const searchContent = document.querySelector('.active-search');
const searchForm = document.getElementById('searchForm2');
let access_token = 'EAA3HC1jMtEoBANB0RQTRm1GvTbSoXA85X6kueaKFZBjEriFtpdPWQiotRLNhROZC8gVZAHq5Tpu4ZCCdDJw3olCl7RVEbWNlhGVgMaX1uBtr9qDNDO7H1NXAmbQ35KnpvMtWKjm3f0Jf1HrMCZCFDA1G5wa2fts5MrSWem3updpuZBMHLgW1BSsjNDYth7G5wZD';


recentSearch = localStorage.getItem('recentSearch')
if(recentSearch === null){
  localStorage.setItem('recentSearch',[].toString())
}else{
  recentSearchs = recentSearch.split(',')
  //document.getElementById('recentSearch').innerHTML = recentSearch
}


 // Custom Language Dropdown
 const langDropdown = document.querySelector('.lang-dropdown');
 document.getElementById('languageBtn').addEventListener('click', function (e) {
     e.preventDefault();
     langDropdown.classList.toggle('active');
 });
 
 //Trigger with language change
 const langList = document.querySelectorAll('.language-list');
 for (i = 0; i < langList.length; i++) {
   langList[i].addEventListener('click', function() {
       const selectedLanguge = this.children[1].innerHTML;
       const langCode = this.children[1].getAttribute("data-code");
       
       document.querySelector('.active-lang').innerHTML = selectedLanguge;
       document.querySelector('.language_code').value = langCode;
       document.querySelector('.active-flag').setAttribute("src", "assets/images/flag/"+langCode+"_24.png");
       langDropdown.classList.remove('active');
   });
 }

form.addEventListener('submit', async function (search) {

  contentSection.style.display = ""
  search.preventDefault();
  const language = $('#language').val() ? $('#language').val() : 'en_US';
  langDropdown.classList.remove('active');
  const searchTerm = form.elements.query.value;
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


  $.ajax({
    url:$('meta[name="base_url"]').attr('content') + '/postinsert',
    method:'POST',
    data:{
            keyword:searchTerm, 
           language:language
         },
    success:function(response){
       if(response.success){
          response.recents.forEach(element => {
            console.log(element.Keyword)
          });
       }else{
           alert("Error")
       }
    },
    error:function(error){
       console.log(error)
    }
 });


  loader.style.display = "block"
  const res = await axios.get(`https://graph.facebook.com/search?type=adinterest&q=[${searchTerm}]&limit=10000&locale=${language}&access_token=${access_token}`)


    // Show Error When API Expires
    .catch(err => {
      const errText = document.querySelector('.error');
      errText.style.display = "block"
    })

  // reset result total num
  const numResults = document.querySelector('.num-results');
  numResults.innerHTML = ` ${0}`;


  // reset result list
  const clearList = document.querySelectorAll('td');
  for (let clear of clearList) {
    clear.remove();
  }
  loader.style.display = "";
  searchContent.style.display = "block";
  //  Results List
  for (let i = 0; i <= 1500; i++) {

    const errText = document.querySelector('.error');
    let name = res.data.data[i].name;
    let topic = res.data.data[i].topic;
    if(topic == null)
        topic = '--'
    let audSize = res.data.data[i].audience_size;
    let path = res.data.data[i].path;
    const tbody = document.querySelector('tbody');
    let tr = document.createElement('tr');
    tr.innerHTML = `<td><input type="checkbox" id="checkbox" name="checkmark" value="${name}" class="checked"></td>
                                <td>${name}</td>
                                <td>${audSize.toLocaleString('en-US')}</td>
                                <td>${topic }</td>
                                <td>
                                  <a href="https://www.facebook.com/search/top/?q=${name.replace(/\s/g, '+')}" target="_blank"><i class="fab fa-facebook"></i></a>
                                  <a href="https://www.google.com/search?q=${name.replace(/\s/g, '+')}" target="_blank"><i class="fab fa-google"></i></a>
                                </td>`
    tbody.appendChild(tr)
    numResults.innerHTML = ` ${i}`
    errText.style.display = "";
  }
})

// select all checkboxes
const mainIntrestBox = document.querySelector('.main-selection-box');
const checkboxes = document.getElementsByClassName('checked');
const mainCheckbox = document.getElementById('main-checkbox');
function toggle(source) {
  mainIntrestBox.innerHTML = '';
  for (let i = 1, n = checkboxes.length; i < n; i++) {
    checkboxes[i].checked = source.checked;
    mainIntrestBox.innerHTML += `<span id="${checkboxes[i].value}">${checkboxes[i].value}, </span>`;
  } if (mainCheckbox.checked === false) {
    mainIntrestBox.innerHTML = '';
  }
}

// Append to selection box

const keyList = document.querySelector('tbody');
const checkedValue = document.getElementsByClassName('checked');
keyList.addEventListener('click', addIntrest);

function addIntrest(e) {
  let check = e.target;
  if (check.checked === true) {

    //  intrestBox.value += `${check.value}, `;
    mainIntrestBox.innerHTML += `<span id="${check.value}">${check.value}, </span>`;

  } else if (check.checked === false) {
    let InterestValue = document.getElementById(check.value);
    InterestValue.remove()

  }
}


//  Clear Selection  
const btnClear = document.getElementById('clear');
btnClear.addEventListener('click', function (clearAll) {
  clearAll.preventDefault()
  mainIntrestBox.innerHTML = '';
  for (let uncheck of checkboxes) {
    uncheck.checked = false;
  }
})

// Copy Selection
const btnCopy = document.getElementById('copyBtn');
btnCopy.addEventListener('click', function (copyAll) {
  copyAll.preventDefault()
  const createInput = document.createElement('input');
  const boxInnerText = mainIntrestBox.innerText;
  createInput.value = boxInnerText;
  document.body.appendChild(createInput);
  createInput.select();
  document.execCommand('copy');
  document.body.removeChild(createInput)
  const copiedAlert = document.createElement('div');
  copiedAlert.classList.add("copied-message");
  copiedAlert.innerHTML = `<i class="fas fa-check"></i>
<p>Selection Copied!</p>`;
  mainIntrestBox.appendChild(copiedAlert)

  setTimeout(function () {
    mainIntrestBox.removeChild(copiedAlert)
  }, 2000);

})