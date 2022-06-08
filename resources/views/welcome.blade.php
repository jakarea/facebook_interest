@extends('layouts.app')
@section('content')
<div class="container">
    <div class="search-area">
        <h1 class="title">Facebook Interest Hacker</h1>
        <h3 class="sub-heading">Search For Hidden Facebook Interest!</h3>
        @if(Auth::check())
        <form id="searchForm" action="{{route('search.user')}}" method="GET">
            <input type="text" placeholder="Search Keyword" name="keyword" class="keyword-search" required>
            <input type="hidden" name="language" value="en" class="language_code">
            <div class="lang-wrapper">
                <button id="languageBtn" class="lang-btn"><img class="active-flag" src="{{asset('public/assets/images/flag/en_US_24.png')}}"><span class="active-lang">English</span></button>
                <ul class="lang-dropdown">
                    <li class="language-list"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/en_US_24.png')}}"><span data-code="en_US">English</span></li>
                    <li class="language-list"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/en_GB_24.png')}}"><span data-code="en_GB">English (United Kingdom)</span></li>
                    <li class="language-list"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/fr_FR_24.png')}}"><span data-code="fr_FR">French</span></li>
                    <li class="language-list"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/nl_NL_24.png')}}"><span data-code="nl_NL">Dutch</span></li>
                </ul>
            </div>
            <button type="submit" class="search-btn">Search</button>

        </form>


        @if(isset($search_data))
        <div class="text-center" style="">
            <p> Recent search:<span id="recentSearch"> {{ $search_data['data'][0]['name'] }}</span></p>
        </div>
        <div class="active-search">
            <div class="main-selection-box">
            </div>
            <div class="selection-btn">
                <button id="copyBtn"><i class="far fa-clone"></i>Copy All</button>
                <button id="clear"><i class="far fa-trash-alt"></i>Clear All</button>
            </div>
            <br />
            <div class="search-results">
                <h3 class="totalResults">
                    Total Results:<span> {{ count($search_data['data']) }}</span>
                </h3>

                <table class="content-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="main-checkbox" name="selectAll" onclick="toggleAll()" value="" label="check">
                            </th>
                            <th class="name">Name</th>
                            <th class="aud">Audience Size</th>
                            <th class="aud">Category</th>
                            <th>Search</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($search_data['data'] as $data)
                        <tr>

                            <td><input type="checkbox" id="checkbox" name="checkmark" onclick="toggle(this)" value="{{ $data['name'] }}" class="checked"></td>
                            <td class="name">{{ $data['name'] }}</td>
                            <td class="aud">{{ $data['audience_size_lower_bound'] }}-{{ $data['audience_size_upper_bound'] }}</td>
                            <td class="aud">
                                @if(isset($data['topic']))

                                {{ $data['topic'] }}

                                @endif
                            </td>
                            <td>
                                <a href="https://www.facebook.com/search/top/?q={{ $data['name'] }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://www.google.com/search?q={{ $data['name'] }}" target="_blank"><i class="fab fa-google"></i></a>
                            </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        @endif


        @else
        <div style="text-align: center; color: white;background-color: #7c3aed; width: 50%; margin:0 auto; border-radius: 5px;">
            <a href="{{ $login_url }}" class="fab fa-facebook registerbtn"> Login with facebook </a>
        </div>

        @endif
        <p class="error">FB Token Expred!</p>
    </div>
    <div class="loader">
        <div class="regot regot1"></div>
        <div class="regot regot2"></div>
        <div class="regot regot3"></div>
        <div class="regot regot4"></div>
    </div>
    <section>
        <div class="first-box">
            <h1>Increase Your Interest Audience!</h1>
            <p>Find related & targetable interests for your Facebook campaigns.</p>
            <p>Find a conveniently arranged table with interests, audience sizes for your interests.</p>
            <p>Quickly select which interest you want to be added to your selection box. </p>
            <p>Copy your selection to the clipboard so you can paste it into your Facebook campaign. </p>
        </div>

        <div class="second-box">
            <img src="{{asset('public/assets/images/table.png')}}" alt="">
        </div>
    </section>
</div>
@push('js')

<script>
    //Trigger with language change
    const languageBtn = document.querySelector('#languageBtn');
    const langDropdown = document.querySelector('.lang-dropdown');
    const langList = document.querySelectorAll('.language-list');

    languageBtn.addEventListener('click', function(event) {
        event.preventDefault()
        langDropdown.classList.toggle('toggle-dropdown')
    })

    for (i = 0; i < langList.length; i++) {
        langList[i].addEventListener('click', function() {

            const selectedLanguge = this.children[1].innerHTML;
            const langCode = this.children[1].getAttribute("data-code");

            document.querySelector('.active-lang').innerHTML = selectedLanguge;
            document.querySelector('.language_code').value = langCode;
            document.querySelector('.active-flag').setAttribute("src", "public/assets/images/flag/" + langCode + "_24.png");
            langDropdown.classList.remove('toggle-dropdown');

        });
    }

    // select single checkbox and insert data into main selection box
    const mainIntrestBox = document.querySelector('.main-selection-box');
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
        mainIntrestBox.innerHTML = keywords
    }


    //select all checkbox at a time and insert into main selection box

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

    //clear all selected checkbox
    let clearBtn = document.querySelector('#clear')
    clearBtn.addEventListener('click', function() {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false
        }
        mainCheckbox.checked = false
        keyList = []
        appendDatatoMainBox(keyList.join(", "));
        flag = false
    })

    // Copy Selection
    const btnCopy = document.getElementById('copyBtn');
    btnCopy.addEventListener('click', function(copyAll) {
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

        setTimeout(function() {
            mainIntrestBox.removeChild(copiedAlert)
        }, 2000);

    })
</script>
@endpush
@endsection