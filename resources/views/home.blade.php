@extends('layouts.app')

@section('content')    
    <div class="container">
        <div class="search-area">
        <h1 class="title">Facebb ook Interest Hacker</h1>
        <h3 class="sub-heading">Search For Hidden Facebook Interest!</h3>
        
        <form id="searchForm" >
            @csrf
          <input type="text" placeholder="Search Keyword" name="query" class="keyword-search" required>
          <input type="hidden" name="languge" id="language" class="language_code">
          <div class="lang-wrapper">
              <button id="languageBtn" class="lang-btn"><img class="active-flag" src="{{asset('assets/images/flag/en_US_24.png')}}"><span class="active-lang">English</span></button>
              <ul class="lang-dropdown">
                  <li class="language-list"><img class="dropdown-flag" src="{{asset('assets/images/flag/en_US_24.png')}}"><span data-code="en_US">English</span></li>
                  <li class="language-list"><img class="dropdown-flag" src="{{asset('assets/images/flag/en_GB_24.png')}}"><span data-code="en_GB">English (United Kingdom)</span></li>
                  <li class="language-list"><img class="dropdown-flag" src="{{asset('assets/images/flag/fr_FR_24.png')}}"><span data-code="fr_FR">French</span></li>
                  <li class="language-list"><img class="dropdown-flag" src="{{asset('assets/images/flag/nl_NL_24.png')}}"><span data-code="nl_NL">Dutch</span></li>
              </ul>
          </div>
          <button id="searchBTN" class="btn-submit search-btn">Search</button>
         
      </form>
        <div class="text-center" style="">
            <p> Recent search:<span id="recentSearch"></span></p>
        </div>
       

        <p class="error">FB Token Expred!</p>
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
                    Total Results:<span class="num-results"> 0</span>
                </h3>

                <table class="content-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="main-checkbox" name="selectAll" onclick="toggle(this)"
                                    value="" label="check" class="checked">
                            </th>
                            <th class="name">Name</th>
                            <th class="aud">Audience Size</th>
                            <th class="aud">Category</th>
                            <th>Search</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>
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
                <img src="{{asset('assets/images/table.png')}}" alt="">
            </div>
        </section>
    </div>

    @push('js')
    <script src="{{asset('assets/app.js')}}"></script>
    @endpush
@endsection