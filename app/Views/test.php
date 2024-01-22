<?php

echo "Mashud Rana";

//die();
?>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<style>
    .hidden {
        display: none;
    }
</style>

<form id="__vtigerWebForm" name="Leads Retail"
      action="https://crm.ranksitt.net/test_rankscrm/modules/Webforms/capture.php" method="post" accept-charset="utf-8"
      enctype="multipart/form-data">
    <input type="hidden" name="__vtrftk" value="sid:cb21b251800b47e3616346211ab8ff015a9bd1d9,1704273259"><input
            type="hidden" name="publicid" value="f698ed679aebb83b6f39fb1b5b760ed8"><input type="hidden"
                                                                                          name="urlencodeenable"
                                                                                          value="1"><input type="hidden"
                                                                                                           name="name"
                                                                                                           value="Leads Retail">
    <table>
        <tbody>
        <tr>
            <td><label>Last Name*</label></td>
            <td><input type="text" name="lastname" data-label="" value="" required=""></td>
        </tr>
        <tr>
            <td><label>Primary Phone*</label></td>
            <td><input type="text" name="phone" data-label="" value="" required=""></td>
        </tr>
        <tr>
            <td><label>Primary Email</label></td>
            <td><input type="email" name="email" data-label="" value=""></td>
        </tr>
        <tr>
            <td>
                <select name="leadsource" data-label="leadsource" hidden="">
                    <option value="">Select Value</option>
                    <option value="Cold Call">Cold Call</option>
                    <option value="Affiliate Store">Affiliate Store</option>
                    <option value="Self Generated">Self Generated</option>
                    <option value="Banner">Banner</option>
                    <option value="Partner">Partner</option>
                    <option value="Public Relations">Public Relations</option>
                    <option value="Rangs Emart Showroom">Rangs Emart Showroom</option>
                    <option value="Customer Reference">Customer Reference</option>
                    <option value="Door to Door">Door to Door</option>
                    <option value="Web Site" selected="">Web Site</option>
                    <option value="Word of mouth">Word of mouth</option>
                    <option value="Other">Other</option>
                    <option value="Event">Event</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Google Search">Google Search</option>
                    <option value="Influencer">Influencer</option>
                    <option value="Instagram">Instagram</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Email">Primary Email</option>
                    <option value="Employee Reference">Employee Reference</option>
                    <option value="Leaflet">Leaflet</option>
                    <option value="Mobile SMS">Mobile SMS</option>
                    <option value="Sticker">Sticker</option>
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="YouTube">YouTube</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <select name="cf_3482" data-label="label:Lead+Type" required="" hidden="">
                    <option value="">Select Value</option>
                    <option value="Corporate-Internet">Corporate-Internet</option>
                    <option value="Retail-Internet" selected="">Retail-Internet</option>
                    <option value="Data-Connectivity">Data-Connectivity</option>
                    <option value="IP-Telephony">IP-Telephony</option>
                    <option value="IOT-Smart-Home">IOT-Smart-Home</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Road*</label></td>
            <td><input type="text" name="cf_1825" data-label="" value="" required=""></td>
        </tr>
        <tr>
            <td><label>Interested Retail Packages</label></td>
            <td>
                <select name="cf_3434" data-label="label:Interested+Retail+Packages">
                    <option value="">Select Value</option>
                    <option value="5 Mbps @ 500tk">5 Mbps @ 500tk</option>
                    <option value="8Mbps @ 600tk">8Mbps @ 600tk</option>
                    <option value="10Mbps @ 700tk">10Mbps @ 700tk</option>
                    <option value="12Mbps @ 750tk">12Mbps @ 750tk</option>
                    <option value="15Mbps @ 800tk">15Mbps @ 800tk</option>
                    <option value="20Mbps @ 1050tk">20Mbps @ 1050tk</option>
                    <option value="30Mbps @ 1400tk">30Mbps @ 1400tk</option>
                    <option value="25Mbps @ 1260tk">25Mbps @ 1260tk</option>
                    <option value="35Mbps @ 1575tk">35Mbps @ 1575tk</option>
                    <option value="40Mbps@1750tk">40Mbps@1750tk</option>
                    <option value="55Mbps@2250tk">55Mbps@2250tk</option>
                    <option value="65Mbps@2600tk">65Mbps@2600tk</option>
                    <option value="75Mbps@3000tk">75Mbps@3000tk</option>
                    <option value="100Mbps@4000tk">100Mbps@4000tk</option>
                    <option value="200Mbps@6000tk">200Mbps@6000tk</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Retail Coverage District</label></td>
            <td>
                <select id="retailCoverageDistrict" name="cf_3426" data-label="label:Retail+Coverage+District">
                    <option value="">Select Value</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chaittagong">Chaittagong</option>
                    <option value="Thakurgaon">Thakurgaon</option>
                </select>
            </td>
        </tr>
        <tr id="retailCoverageDhakaRow" class="hidden">
            <td><label>Retail Coverage Area Dhaka</label></td>
            <td>
                <select name="cf_3428" data-label="label:Retail+Coverage+Area+Dhaka">
                    <option value="">Select Value</option>
                    <option value="Agargaon">Agargaon</option>
                    <option value="Badda">Badda</option>
                    <option value="Banani">Banani</option>
                    <option value="Dhanmondi">Dhanmondi</option>
                    <option value="ECB">ECB</option>
                    <option value="Gulshan 1">Gulshan 1</option>
                    <option value="Gulshan 2">Gulshan 2</option>
                    <option value="Ibrahimpur">Ibrahimpur</option>
                    <option value="Kachukhet">Kachukhet</option>
                    <option value="Kafrul">Kafrul</option>
                    <option value="Kathalbagan">Kathalbagan</option>
                    <option value="Kazipara">Kazipara</option>
                    <option value="Kolabagan">Kolabagan</option>
                    <option value="Lalmatia">Lalmatia</option>
                    <option value="Mirpur 1">Mirpur 1</option>
                    <option value="Mirpur 2">Mirpur 2</option>
                    <option value="Mirpur 6">Mirpur 6</option>
                    <option value="Mirpur 7">Mirpur 7</option>
                    <option value="Mirpur 10">Mirpur 10</option>
                    <option value="Mirpur 11">Mirpur 11</option>
                    <option value="Mirpur 12">Mirpur 12</option>
                    <option value="Mirpur 14">Mirpur 14</option>
                    <option value="Motijheel">Motijheel</option>
                    <option value="Niketan">Niketan</option>
                    <option value="Shewrapara">Shewrapara</option>
                    <option value="Uttara">Uttara</option>
                </select>
            </td>
        </tr>
        <tr id="retailCoverageChittagongRow" class="hidden">
            <td><label>Retail Coverage Area Chittagong</label></td>
            <td>
                <select name="cf_3430" data-label="label:Retail+Coverage+Area+Chittagong">
                    <option value="">Select Value</option>
                    <option value="Agrabad C/A">Agrabad C/A</option>
                    <option value="Barik Building">Barik Building</option>
                    <option value="Chesbazar">Chesbazar</option>
                    <option value="Choumuhani">Choumuhani</option>
                    <option value="Fays Lake">Fays Lake</option>
                    <option value="Gosaildanga">Gosaildanga</option>
                    <option value="Kadamtoli">Kadamtoli</option>
                    <option value="Madarbari East">Madarbari East</option>
                    <option value="Madarbari West">Madarbari West</option>
                    <option value="Khulsi R/A">Khulsi R/A</option>
                    <option value="Majhirghat">Majhirghat</option>
                    <option value="Mehedibagh">Mehedibagh</option>
                    <option value="Nasirabad">Nasirabad</option>
                    <option value="O.R. Nizam Road">O.R. Nizam Road</option>
                    <option value="Panchlaish">Panchlaish</option>
                    <option value="Pathantoli">Pathantoli</option>
                    <option value="Suganda R/A">Suganda R/A</option>
                </select>
            </td>
        </tr>
        <tr id="retailCoverageThakurgaonRow" class="hidden">
            <td><label>Retail Coverage Area Thakurgaon</label></td>
            <td>
                <select name="cf_3432" data-label="label:Retail+Coverage+Area+Thakurgaon">
                    <option value="">Select Value</option>
                    <option value="Area 1">Area 1</option>
                    <option value="Area 2">Area 2</option>
                    <option value="Area 3">Area 3</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <select name="leadstatus" data-label="leadstatus" hidden="">
                    <option value="">Select Value</option>
                    <option value="New" selected="">New</option>
                    <option value="Survey">Survey</option>
                    <option value="Finalize">Finalize</option>
                    <option value="No Coverage">No Coverage</option>
                    <option value="Con ID Enlisted">Con ID Enlisted</option>
                    <option value="Remarketing">Remarketing</option>
                    <option value="Attempted to Contact">Attempted to Contact</option>
                    <option value="Invalid">Invalid</option>
                    <option value="Hold">Hold</option>
                    <option value="Cold">Cold</option>
                    <option value="Contact in Future">Contact in Future</option>
                    <option value="Contacted">Contacted</option>
                    <option value="Hot">Hot</option>
                    <option value="Lost Lead">Lost Lead</option>
                    <option value="Not Contacted">Not Contacted</option>
                    <option value="Warm">Warm</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="text-align: center;">
                <label for="problem">Math Problem:</label>
                <input type="text" id="problem" readonly>
            </td>
            <td>
                <label for="userAnswer">Your Answer:</label>
                <input type="text" id="userAnswer" required>
            </td>
        </tr>


        </tbody>
    </table>

    <button type="button" onclick="validateMathProblem()">Submit</button>
</form>

<script>
    let correctAnswer;

    function getRandomNumber() {
        return Math.floor(Math.random() * 10) + 1; // Generate a random number between 1 and 10
    }

    function getRandomOperator() {
        var operators = ['+', '-'];
        return operators[Math.floor(Math.random() * operators.length)];
    }

    function generateMathProblem() {
        var num1 = getRandomNumber();
        var num2 = getRandomNumber();
        var operator = getRandomOperator();
        var problemString = num1 + ' ' + operator + ' ' + num2;

        return {
            problemString: problemString,
            correctAnswer: eval(problemString) // Calculate the correct answer
        };
    }

    function setMathProblem() {
        var mathProblem = generateMathProblem();
        document.getElementById('problem').value = mathProblem.problemString;
        return mathProblem.correctAnswer;
    }

    function validateMathProblem() {

        const userAnswer = parseFloat(document.getElementById('userAnswer').value);

        if (userAnswer === correctAnswer) {
            alert('Correct! Well done.');
            document.getElementById('__vtigerWebForm').submit();
        } else {
            alert('Incorrect! The correct answer is ' + correctAnswer + '. Please try again.');
            // prevent form submission
            document.getElementById('__vtigerWebForm').addEventListener('submit', function (e) {
                e.preventDefault();
            });
            correctAnswer = setMathProblem(); // Refresh with a new math problem
        }
    }

    // Initialize with a random math problem
    correctAnswer = setMathProblem();
</script>


<script>
    var retailCoverageDistrict = document.getElementById('retailCoverageDistrict');
    var retailCoverageDhakaRow = document.getElementById('retailCoverageDhakaRow');
    var retailCoverageChittagongRow = document.getElementById('retailCoverageChittagongRow');
    var retailCoverageThakurgaonRow = document.getElementById('retailCoverageThakurgaonRow');

    retailCoverageDistrict.addEventListener('change', function () {

        retailCoverageDhakaRow.classList.add('hidden');
        retailCoverageChittagongRow.classList.add('hidden');
        retailCoverageThakurgaonRow.classList.add('hidden');


        var selectedDistrict = this.value;
        if (selectedDistrict === 'Dhaka') {
            retailCoverageDhakaRow.classList.remove('hidden');
        } else if (selectedDistrict === 'Chaittagong') {
            retailCoverageChittagongRow.classList.remove('hidden');
        } else if (selectedDistrict === 'Thakurgaon') {
            retailCoverageThakurgaonRow.classList.remove('hidden');
        }
    });
</script>


<script type="text/javascript">window.onload = function () {
        var N = navigator.appName, ua = navigator.userAgent, tem;
        var M = ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
        if (M && (tem = ua.match(/version\/([\.\d]+)/i)) != null) M[2] = tem[1];
        M = M ? [M[1], M[2]] : [N, navigator.appVersion, "-?"];
        var browserName = M[0];
        var form = document.getElementById("__vtigerWebForm"), inputs = form.elements;
        form.onsubmit = function () {
            var required = [], att, val;
            for (var i = 0; i < inputs.length; i++) {
                att = inputs[i].getAttribute("required");
                val = inputs[i].value;
                type = inputs[i].type;
                if (type == "email") {
                    if (val != "") {
                        var elemLabel = inputs[i].getAttribute("label");
                        var emailFilter = /^[_/a-zA-Z0-9]+([!"#$%&()*+,./:;<=>?\^_`{|}~-]?[a-zA-Z0-9/_/-])*@[a-zA-Z0-9]+([\_\-\.]?[a-zA-Z0-9]+)*\.([\-\_]?[a-zA-Z0-9])+(\.?[a-zA-Z0-9]+)?$/;
                        var illegalChars = /[\(\)\<\>\,\;\:\"\[\]]/;
                        if (!emailFilter.test(val)) {
                            alert("For " + elemLabel + " field please enter valid email address");
                            return false;
                        } else if (val.match(illegalChars)) {
                            alert(elemLabel + " field contains illegal characters");
                            return false;
                        }
                    }
                }
                if (att != null) {
                    if (val.replace(/^\s+|\s+$/g, "") == "") {
                        required.push(inputs[i].getAttribute("label"));
                    }
                }
            }
            if (required.length > 0) {
                alert("The following fields are required: " + required.join());
                return false;
            }
            var numberTypeInputs = document.querySelectorAll("input[type=number]");
            for (var i = 0; i < numberTypeInputs.length; i++) {
                val = numberTypeInputs[i].value;
                var elemLabel = numberTypeInputs[i].getAttribute("label");
                var elemDataType = numberTypeInputs[i].getAttribute("datatype");
                if (val != "") {
                    if (elemDataType == "double") {
                        var numRegex = /^[+-]?\d+(\.\d+)?$/;
                    } else {
                        var numRegex = /^[+-]?\d+$/;
                    }
                    if (!numRegex.test(val)) {
                        alert("For " + elemLabel + " field please enter valid number");
                        return false;
                    }
                }
            }
            var dateTypeInputs = document.querySelectorAll("input[type=date]");
            for (var i = 0; i < dateTypeInputs.length; i++) {
                dateVal = dateTypeInputs[i].value;
                var elemLabel = dateTypeInputs[i].getAttribute("label");
                if (dateVal != "") {
                    var dateRegex = /^[1-9][0-9]{3}-(0[1-9]|1[0-2]|[1-9]{1})-(0[1-9]|[1-2][0-9]|3[0-1]|[1-9]{1})$/;
                    if (!dateRegex.test(dateVal)) {
                        alert("For " + elemLabel + " field please enter valid date in required format");
                        return false;
                    }
                }
            }
            var inputElems = document.getElementsByTagName("input");
            var totalFileSize = 0;
            for (var i = 0; i < inputElems.length; i++) {
                if (inputElems[i].type.toLowerCase() === "file") {
                    var file = inputElems[i].files[0];
                    if (typeof file !== "undefined") {
                        var totalFileSize = totalFileSize + file.size;
                    }
                }
            }
            if (totalFileSize > 52428800) {
                alert("Maximum allowed file size including all files is 50MB.");
                return false;
            }
        };
    }</script>