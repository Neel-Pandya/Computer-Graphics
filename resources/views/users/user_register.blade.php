<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/vertical-layout-light/style.css">

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                            @php
                                $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                $gender = array("Male", "Female"); 
                            @endphp

                            <h4 class="text-center">Register</h4>

                            <form class="pt-3" action="{{ route('user.register.validate') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1"
                                        name="username" placeholder="Username" value="{{ old('username') }}">
                                        <span class="text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        name="email" placeholder="Email" value="{{ old('email') }}">
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                        name="country">
                                        <option value="">Country</option>
                                        @foreach ($countries as $country )
                                            <option value="{{ $country }}" @if (old('country') == $country)
                                                selected
                                            @endif>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('country')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="pass"
                                        id="exampleInputPassword1" placeholder="Password" value="{{ old('pass') }}">
                                        <span class="text-danger">
                                            @error('pass')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="pass_confirmation"
                                        id="exampleInputPassword1" placeholder="Confirm password" value="{{ old('pass_confirmation') }}">
                                        <span class="text-danger">
                                            @error('pass_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>

                                <div class="form-group">
                                    <select name="gender" id="" class="form-select form-control">
                                        <option value="">Choose Gender</option>
                                       @foreach ($gender as $gender )
                                           <option value="{{ $gender }}" @if (old('gender') == $gender)
                                               selected
                                           @endif>{{ $gender }}</option>
                                       @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <input type="file" name="profile" id="" class="form-file form-control">
                                    <span class="text-danger">
                                        @error('profile')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="mt-3">
                                    <input type="submit" value="REGISTER" class="btn btn-lg btn-primary col-12">
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{ route('user.login') }}"
                                        class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

</body>