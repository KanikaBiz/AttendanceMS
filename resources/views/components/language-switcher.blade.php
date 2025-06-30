{{-- <div class="nav-item">
    <select onchange="changeLanguage(this.value)" class="form-control form-control-sm" style="width: auto;">
        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}><span> <img class="flag-icon" src="{{ assetUrl() }}images/flags/en.png" alt=""> </span>English</option>
        <option value="kh" {{ app()->getLocale() == 'kh' ? 'selected' : '' }}><span> <img class="flag-icon" src="{{ assetUrl() }}images/flags/kh.png" alt=""> </span>ខ្មែរ</option>
    </select>
</div>

<script>
function changeLanguage(locale) {
    window.location = '{{ url('/change-language') }}/' + locale;
}
</script> --}}


<div class="custom-language-dropdown">
    <div class="selected-language" onclick="toggleDropdown()">
        <img src="/images/flags/kh.png" alt="">
        <span>ខ្មែរ</span>
        <i class="fas fa-chevron-down"></i>
    </div>
    <div class="language-options" id="languageOptions">
        <div class="language-option" onclick="selectLanguage('en', 'English', '/images/flags/en.png')">
            <img src="/images/flags/en.png" alt="">
            <span>English</span>
        </div>
        <div class="language-option" onclick="selectLanguage('kh', 'ខ្មែរ', '/images/flags/kh.png')">
            <img src="/images/flags/kh.png" alt="">
            <span>ខ្មែរ</span>
        </div>
    </div>
</div>

<style>
.custom-language-dropdown {
    position: relative;
    display: inline-block;
    min-width: 150px;
}

.selected-language {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    background: white;
    cursor: pointer;
    font-size: 14px;
}

.selected-language img {
    width: 20px;
    height: 15px;
    margin-right: 8px;
}

.selected-language i {
    margin-left: auto;
    font-size: 12px;
}

.language-options {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ced4da;
    border-radius: 4px;
    margin-top: 4px;
    display: none;
    z-index: 1000;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.language-options.show {
    display: block;
}

.language-option {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    cursor: pointer;
    transition: background 0.2s;
}

.language-option:hover {
    background: #f8f9fa;
}

.language-option img {
    width: 20px;
    height: 15px;
    margin-right: 8px;
}
</style>

<script>
function changeLanguage(locale) {
    window.location = '{{ url('/change-language') }}/' + locale;
}
</script>
