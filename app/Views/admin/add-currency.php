<!DOCTYPE html>
<html lang="en">
<?php
$session = session();
if ($session->getFlashdata('success_save')) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $session->getFlashdata('success_save'); ?>
    </div>
<?php
}
if ($session->getFlashdata('error_save')) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $session->getFlashdata('error_save'); ?>
    </div>
<?php
}
?>
<?php echo view('admin/header') ?>

<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">



                    <div class="card">
                        <div class="text-center mt-4">
                            <h1 class="add-user-btn">Add Currency</h1>
                            <!-- <p class="lead">
								Start creating the best possible user experience for you customers.
							</p> -->
                        </div>
                        <div class="card-body card-body-another">
                            <div class="m-sm-3">
                                <form id="add-project-form" method="post" action="<?= base_url() ?>admin/add-currency">
                                    <div class="mb-3">
                                        <!-- <label class="form-label">Search Currency:</label>
                                        <input id="searchInput" class="form-control form-control-lg form-control-lg-1 focus" type="text" placeholder="Search Currency" /> -->
                                        <!-- Country names and Currency -->
                                        <select class=" mt-3 form-select" id="country" name="name">
                                            <option value="">Select Country</option>
                                            <option value="AFN">Afghanistan</option>
                                            <option value="EUR">Aland Islands</option>
                                            <option value="ALL">Albania</option>
                                            <option value="DZD">Algeria</option>
                                            <option value="USD">American Samoa</option>
                                            <option value="EUR">Andorra</option>
                                            <option value="AOA">Angola</option>
                                            <option value="XCD">Anguilla</option>
                                            <option value="AAD">Antarctica</option>
                                            <option value="XCD">Antigua and Barbuda</option>
                                            <option value="ARS">Argentina</option>
                                            <option value="AMD">Armenia</option>
                                            <option value="AWG">Aruba</option>
                                            <option value="AUD">Australia</option>
                                            <option value="EUR">Austria</option>
                                            <option value="AZN">Azerbaijan</option>
                                            <option value="BSD">Bahamas</option>
                                            <option value="BHD">Bahrain</option>
                                            <option value="BDT">Bangladesh</option>
                                            <option value="BBD">Barbados</option>
                                            <option value="BYN">Belarus</option>
                                            <option value="EUR">Belgium</option>
                                            <option value="BZD">Belize</option>
                                            <option value="XOF">Benin</option>
                                            <option value="BMD">Bermuda</option>
                                            <option value="BTN">Bhutan</option>
                                            <option value="BOB">Bolivia</option>
                                            <option value="USD">Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BAM">Bosnia and Herzegovina</option>
                                            <option value="BWP">Botswana</option>
                                            <option value="NOK">Bouvet Island</option>
                                            <option value="BRL">Brazil</option>
                                            <option value="USD">British Indian Ocean Territory</option>
                                            <option value="BND">Brunei Darussalam</option>
                                            <option value="BGN">Bulgaria</option>
                                            <option value="XOF">Burkina Faso</option>
                                            <option value="BIF">Burundi</option>
                                            <option value="KHR">Cambodia</option>
                                            <option value="XAF">Cameroon</option>
                                            <option value="CAD">Canada</option>
                                            <option value="CVE">Cape Verde</option>
                                            <option value="KYD">Cayman Islands</option>
                                            <option value="XAF">Central African Republic</option>
                                            <option value="XAF">Chad</option>
                                            <option value="CLP">Chile</option>
                                            <option value="CNY">China</option>
                                            <option value="AUD">Christmas Island</option>
                                            <option value="AUD">Cocos (Keeling) Islands</option>
                                            <option value="COP">Colombia</option>
                                            <option value="KMF">Comoros</option>
                                            <option value="XAF">Congo</option>
                                            <option value="CDF">Congo, Democratic Republic of the Congo</option>
                                            <option value="NZD">Cook Islands</option>
                                            <option value="CRC">Costa Rica</option>
                                            <option value="XOF">Cote D'Ivoire</option>
                                            <option value="HRK">Croatia</option>
                                            <option value="CUP">Cuba</option>
                                            <option value="ANG">Curacao</option>
                                            <option value="EUR">Cyprus</option>
                                            <option value="CZK">Czech Republic</option>
                                            <option value="DKK">Denmark</option>
                                            <option value="DJF">Djibouti</option>
                                            <option value="XCD">Dominica</option>
                                            <option value="DOP">Dominican Republic</option>
                                            <option value="USD">Ecuador</option>
                                            <option value="EGP">Egypt</option>
                                            <option value="USD">El Salvador</option>
                                            <option value="XAF">Equatorial Guinea</option>
                                            <option value="ERN">Eritrea</option>
                                            <option value="EUR">Estonia</option>
                                            <option value="ETB">Ethiopia</option>
                                            <option value="FKP">Falkland Islands (Malvinas)</option>
                                            <option value="DKK">Faroe Islands</option>
                                            <option value="FJD">Fiji</option>
                                            <option value="EUR">Finland</option>
                                            <option value="EUR">France</option>
                                            <option value="EUR">French Guiana</option>
                                            <option value="XPF">French Polynesia</option>
                                            <option value="EUR">French Southern Territories</option>
                                            <option value="XAF">Gabon</option>
                                            <option value="GMD">Gambia</option>
                                            <option value="GEL">Georgia</option>
                                            <option value="EUR">Germany</option>
                                            <option value="GHS">Ghana</option>
                                            <option value="GIP">Gibraltar</option>
                                            <option value="EUR">Greece</option>
                                            <option value="DKK">Greenland</option>
                                            <option value="XCD">Grenada</option>
                                            <option value="EUR">Guadeloupe</option>
                                            <option value="USD">Guam</option>
                                            <option value="GTQ">Guatemala</option>
                                            <option value="GBP">Guernsey</option>
                                            <option value="GNF">Guinea</option>
                                            <option value="XOF">Guinea-Bissau</option>
                                            <option value="GYD">Guyana</option>
                                            <option value="HTG">Haiti</option>
                                            <option value="AUD">Heard Island and Mcdonald Islands</option>
                                            <option value="EUR">Holy See (Vatican City State)</option>
                                            <option value="HNL">Honduras</option>
                                            <option value="HKD">Hong Kong</option>
                                            <option value="HUF">Hungary</option>
                                            <option value="ISK">Iceland</option>
                                            <option value="INR">India</option>
                                            <option value="IDR">Indonesia</option>
                                            <option value="IRR">Iran, Islamic Republic of</option>
                                            <option value="IQD">Iraq</option>
                                            <option value="EUR">Ireland</option>
                                            <option value="GBP">Isle of Man</option>
                                            <option value="ILS">Israel</option>
                                            <option value="EUR">Italy</option>
                                            <option value="JMD">Jamaica</option>
                                            <option value="JPY">Japan</option>
                                            <option value="GBP">Jersey</option>
                                            <option value="JOD">Jordan</option>
                                            <option value="KZT">Kazakhstan</option>
                                            <option value="KES">Kenya</option>
                                            <option value="AUD">Kiribati</option>
                                            <option value="KPW">Korea, Democratic People's Republic of</option>
                                            <option value="KRW">Korea, Republic of</option>
                                            <option value="EUR">Kosovo</option>
                                            <option value="KWD">Kuwait</option>
                                            <option value="KGS">Kyrgyzstan</option>
                                            <option value="LAK">Lao People's Democratic Republic</option>
                                            <option value="EUR">Latvia</option>
                                            <option value="LBP">Lebanon</option>
                                            <option value="LSL">Lesotho</option>
                                            <option value="LRD">Liberia</option>
                                            <option value="LYD">Libyan Arab Jamahiriya</option>
                                            <option value="CHF">Liechtenstein</option>
                                            <option value="EUR">Lithuania</option>
                                            <option value="EUR">Luxembourg</option>
                                            <option value="MOP">Macao</option>
                                            <option value="MKD">Macedonia, the Former Yugoslav Republic of</option>
                                            <option value="MGA">Madagascar</option>
                                            <option value="MWK">Malawi</option>
                                            <option value="MYR">Malaysia</option>
                                            <option value="MVR">Maldives</option>
                                            <option value="XOF">Mali</option>
                                            <option value="EUR">Malta</option>
                                            <option value="USD">Marshall Islands</option>
                                            <option value="EUR">Martinique</option>
                                            <option value="MRO">Mauritania</option>
                                            <option value="MUR">Mauritius</option>
                                            <option value="EUR">Mayotte</option>
                                            <option value="MXN">Mexico</option>
                                            <option value="USD">Micronesia, Federated States of</option>
                                            <option value="MDL">Moldova, Republic of</option>
                                            <option value="EUR">Monaco</option>
                                            <option value="MNT">Mongolia</option>
                                            <option value="EUR">Montenegro</option>
                                            <option value="XCD">Montserrat</option>
                                            <option value="MAD">Morocco</option>
                                            <option value="MZN">Mozambique</option>
                                            <option value="MMK">Myanmar</option>
                                            <option value="NAD">Namibia</option>
                                            <option value="AUD">Nauru</option>
                                            <option value="NPR">Nepal</option>
                                            <option value="EUR">Netherlands</option>
                                            <option value="ANG">Netherlands Antilles</option>
                                            <option value="XPF">New Caledonia</option>
                                            <option value="NZD">New Zealand</option>
                                            <option value="NIO">Nicaragua</option>
                                            <option value="XOF">Niger</option>
                                            <option value="NGN">Nigeria</option>
                                            <option value="NZD">Niue</option>
                                            <option value="AUD">Norfolk Island</option>
                                            <option value="USD">Northern Mariana Islands</option>
                                            <option value="NOK">Norway</option>
                                            <option value="OMR">Oman</option>
                                            <option value="PKR">Pakistan</option>
                                            <option value="USD">Palau</option>
                                            <option value="ILS">Palestinian Territory, Occupied</option>
                                            <option value="PAB">Panama</option>
                                            <option value="PGK">Papua New Guinea</option>
                                            <option value="PYG">Paraguay</option>
                                            <option value="PEN">Peru</option>
                                            <option value="PHP">Philippines</option>
                                            <option value="NZD">Pitcairn</option>
                                            <option value="PLN">Poland</option>
                                            <option value="EUR">Portugal</option>
                                            <option value="USD">Puerto Rico</option>
                                            <option value="QAR">Qatar</option>
                                            <option value="EUR">Reunion</option>
                                            <option value="RON">Romania</option>
                                            <option value="RUB">Russian Federation</option>
                                            <option value="RWF">Rwanda</option>
                                            <option value="EUR">Saint Barthelemy</option>
                                            <option value="SHP">Saint Helena</option>
                                            <option value="XCD">Saint Kitts and Nevis</option>
                                            <option value="XCD">Saint Lucia</option>
                                            <option value="EUR">Saint Martin</option>
                                            <option value="EUR">Saint Pierre and Miquelon</option>
                                            <option value="XCD">Saint Vincent and the Grenadines</option>
                                            <option value="WST">Samoa</option>
                                            <option value="EUR">San Marino</option>
                                            <option value="STD">Sao Tome and Principe</option>
                                            <option value="SAR">Saudi Arabia</option>
                                            <option value="XOF">Senegal</option>
                                            <option value="RSD">Serbia</option>
                                            <option value="RSD">Serbia and Montenegro</option>
                                            <option value="SCR">Seychelles</option>
                                            <option value="SLL">Sierra Leone</option>
                                            <option value="SGD">Singapore</option>
                                            <option value="ANG">Sint Maarten</option>
                                            <option value="EUR">Slovakia</option>
                                            <option value="EUR">Slovenia</option>
                                            <option value="SBD">Solomon Islands</option>
                                            <option value="SOS">Somalia</option>
                                            <option value="ZAR">South Africa</option>
                                            <option value="GBP">South Georgia and the South Sandwich Islands</option>
                                            <option value="SSP">South Sudan</option>
                                            <option value="EUR">Spain</option>
                                            <option value="LKR">Sri Lanka</option>
                                            <option value="SDG">Sudan</option>
                                            <option value="SRD">Suriname</option>
                                            <option value="NOK">Svalbard and Jan Mayen</option>
                                            <option value="SZL">Swaziland</option>
                                            <option value="SEK">Sweden</option>
                                            <option value="CHF">Switzerland</option>
                                            <option value="SYP">Syrian Arab Republic</option>
                                            <option value="TWD">Taiwan, Province of China</option>
                                            <option value="TJS">Tajikistan</option>
                                            <option value="TZS">Tanzania, United Republic of</option>
                                            <option value="THB">Thailand</option>
                                            <option value="USD">Timor-Leste</option>
                                            <option value="XOF">Togo</option>
                                            <option value="NZD">Tokelau</option>
                                            <option value="TOP">Tonga</option>
                                            <option value="TTD">Trinidad and Tobago</option>
                                            <option value="TND">Tunisia</option>
                                            <option value="TRY">Turkey</option>
                                            <option value="TMT">Turkmenistan</option>
                                            <option value="USD">Turks and Caicos Islands</option>
                                            <option value="AUD">Tuvalu</option>
                                            <option value="UGX">Uganda</option>
                                            <option value="UAH">Ukraine</option>
                                            <option value="AED">United Arab Emirates</option>
                                            <option value="GBP">United Kingdom</option>
                                            <option value="USD">United States</option>
                                            <option value="USD">United States Minor Outlying Islands</option>
                                            <option value="UYU">Uruguay</option>
                                            <option value="UZS">Uzbekistan</option>
                                            <option value="VUV">Vanuatu</option>
                                            <option value="VEF">Venezuela</option>
                                            <option value="VND">Viet Nam</option>
                                            <option value="USD">Virgin Islands, British</option>
                                            <option value="USD">Virgin Islands, U.s.</option>
                                            <option value="XPF">Wallis and Futuna</option>
                                            <option value="MAD">Western Sahara</option>
                                            <option value="YER">Yemen</option>
                                            <option value="ZMW">Zambia</option>
                                            <option value="ZWL">Zimbabwe</option>
                                        </select>
                                    </div>


                                    <div class="right_submit">
                                        <button type="submit" class="btn btn-primary add-user-button">Add Currency</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?= base_url() ?>assests/js/app.js"></script>
<?php echo view('admin/footer') ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    document.getElementById("searchInput").addEventListener("input", function() {
        const filter = this.value.toUpperCase();
        const options = document.getElementById("currency").options;

        for (let i = 0; i < options.length; i++) {
            const txtValue = options[i].text;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                options[i].style.display = "";
            } else {
                options[i].style.display = "none";
            }
        }
    });
</script>

<script>
    jQuery.validator.addMethod('check_phone',
        function(value, element) {
            return this.optional(element) || /^[0-9]{10}$/i.test(value);
        },
        'Enter valid phone number'
    );
    jQuery.validator.addMethod(
        'letters',
        function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
        },
        'Letters only please'
    );
</script>

<script>
    $("#add-project-form").validate({
        rules: {
            name: {
                required: true,
                letters: true,
            }


        }
    });
</script>

</body>

</html>