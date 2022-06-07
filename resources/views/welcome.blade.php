@extends('layouts.app')

@section('content')
<div class="container">
    <div class="search-area">
        <h1 class="title">Facebook Interest Hacker</h1>
        <h3 class="sub-heading">Search For Hidden Facebook Interest!</h3>
        @if(Auth::check())
        <form id="searchForm" action="{{route('search.user')}}" method="GET">
            @csrf

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
        <div class="text-center" style="">
            <p> Recent search:<span id="recentSearch">0</span></p>
        </div>

        @if(isset($search_data))
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
                    Total Results:<span class="num-results"> {{ count($search_data['data']) }}</span>
                </h3>

                <table class="content-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="main-checkbox" name="selectAll" onclick="toggle(this)" value="" label="check" class="checked">
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
                            <td><input type="checkbox" id="main-checkbox" name="selectAll" onclick="toggle(this)" value="" label="check" class="checked">
                            </td>
                            <td class="name">{{ $data['name'] }}</td>
                            <td class="aud">{{ $data['audience_size_lower_bound'] }}-{{ $data['audience_size_upper_bound'] }}</td>
                            <td class="aud">{{ $data['description'] ? $data['description']:'null' }}</td>
                            <td>
                                <a href="https://www.facebook.com/search/top/?q={{ $data['name'] }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://www.google.com/search?q={{ $data['name'] }}" target="_blank"><i class="fab fa-google"></i></a>
                            </td>`
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
    
</script>
@endpush
@endsection