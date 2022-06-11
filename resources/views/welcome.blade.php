@extends('layouts.app')
@section('content')
<div class="container">

    <div class="search-area">
        <h1 class="title">Facebook Interest Hacker</h1>
        <h3 class="sub-heading">Search For Hidden Facebook Interest!</h3>

        <form id="searchForm" action="{{route('search.user')}}" method="GET">
            <input type="text" placeholder="Search Keyword" name="keyword" class="keyword-search">
            <input type="hidden" name="language" value="en" class="language_code">
            <div class="lang-wrapper">
                <button id="langChangerBtn" class="lang-btn"><img class="active-flag" src="{{asset('public/assets/images/flag/en_US_24.png')}}"><span class="active-lang">English</span></button>
                <ul class="langDropdown">
                    <li class="langList"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/en_US_24.png')}}"><span data-code="en_US">English</span></li>
                    <li class="langList"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/en_GB_24.png')}}"><span data-code="en_GB">English (United Kingdom)</span></li>
                    <li class="langList"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/fr_FR_24.png')}}"><span data-code="fr_FR">French</span></li>
                    <li class="langList"><img class="dropdown-flag" src="{{asset('public/assets/images/flag/nl_NL_24.png')}}"><span data-code="nl_NL">Dutch</span></li>
                </ul>
            </div>
            <button type="submit" class="search-btn">Search</button>
        </form>

        @if(Auth::check())
        <div class="text-center">
            <p> Recent search:
                <span id="recentSearch">
                    @foreach($recents as $recent)
                    <a href="{{ url('?keyword='.$recent->keyword.'&language='.$recent->lang)}}">{{ $recent->keyword }}</a>
                    @endforeach
                </span>
            </p>
        </div>
        @if(isset($search_data))

        <div class="active-search">
            <div class="dataCopyBox">
            </div>
            <div class="buttonToSelect">
                <button id="copyBtn"><i class="far fa-clone"></i>Copy All</button>
                <button id="clear"><i class="far fa-trash-alt"></i>Clear All</button>
            </div>
            <br />
            <div class="search-results">
                <h3 class="totalResults">
                    Total Results:<span> {{ count($search_data) }}</span>
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
                        @foreach($search_data as $data)
                        <tr>
                            <td><input type="checkbox" id="checkbox" name="checkmark" onclick="toggle(this)" value="{{ $data['name'] }}" class="checked"></td>
                            <td class="name">{{ $data['name'] }}</td>
                            <td class="aud">{{ $data['audience_size_lower_bound'] }}~{{ $data['audience_size_upper_bound'] }}</td>
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
        @endif

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

        <section>
            <div class="second-box">
                <img src="{{asset('public/assets/images/banner.png')}}" alt="">
            </div>

            <div class="first-box">
                <h3>Acqurite target up to 30%</h3>
                <h1>Increase Your Interest Audience!</h1>
                <p>Find related & targetable interests for your Facebook campaigns.</p>
                <p>Find a conveniently arranged table with interests, audience sizes for your interests.</p>
                <p>Quickly select which interest you want to be added to your selection box. </p>
                <p>Copy your selection to the clipboard so you can paste it into your Facebook campaign. </p>
            </div>

        </section>

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
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h1>Custom domains</h1>
                        <p>Reply to tickets using your company’s domain name. Manage multiple email addresses in HelpDesk.</p>
                    </div>
                    <div class="col-md-4">
                        <h1>Custom domains</h1>
                        <p>Reply to tickets using your company’s domain name. Manage multiple email addresses in HelpDesk.</p>
                    </div>
                    <div class="col-md-4">
                        <h1>Custom domains</h1>
                        <p>Reply to tickets using your company’s domain name. Manage multiple email addresses in HelpDesk.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('js')
    <script src="{{ asset('public/assets/main.js') }}"></script>
    @endpush
    @endsection