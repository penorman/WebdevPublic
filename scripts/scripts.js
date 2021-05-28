$(document).ready(function()
{
    $('.dataList').select2();
    $('.userType').select2({
        minimumResultsForSearch: Infinity
    });
    $('#studentsList').DataTable();
});

function getScores(id)
{
    jQuery.ajax({
        type: "POST",
        url: "quiz.inc.php",
        dataType: 'json',
        data: {functionname: 'getQuizScores', arguments:[id]}})
        .done(function (data) {
            if (!('error' in data)) {
                console.log(data);
                console.log(data.result);
                if (data.result.length > 0){
                    showScores(id, data.result); 
                }
                else alert("No scores to show!");
                               
            }       
        });
};


function showScores(id, scoresArray)
{
    // alert(id + " clicked!");
    
    var table = document.createElement('table');
    table.className = "display";
    table.id = "myTable";
    var thead = document.createElement('thead');
    var tr = document.createElement('tr');
    var headerList = ['User ID', 'Quiz ID', 'Score'];

    for (var i = 0; i < headerList.length; i++){
        var th = document.createElement('th');
        var text = document.createTextNode(headerList[i]);
        th.appendChild(text);
        tr.appendChild(th);
    }
    thead.appendChild(tr);
    table.appendChild(thead);

    var tbody = document.createElement('tbody');
    for (var i = 0; i < scoresArray.length; i++){
        var tr = document.createElement('tr');

        var tdUserID = document.createElement('td');
        var tdUserIDtext = document.createTextNode(scoresArray[i].userID);
        tdUserID.appendChild(tdUserIDtext);
        tr.appendChild(tdUserID);

        var tdResourceID = document.createElement('td');
        var tdResourceIDtext = document.createTextNode(scoresArray[i].resourceID);
        tdResourceID.appendChild(tdResourceIDtext);
        tr.appendChild(tdResourceID);

        var tdScore = document.createElement('td');
        var tdScoretext = document.createTextNode(scoresArray[i].score);
        tdScore.appendChild(tdScoretext);
        tr.appendChild(tdScore);
        
        tbody.appendChild(tr);
    }
    table.appendChild(tbody);

    var box = bootbox.dialog({
        show: false,
        message: table,
        title: "Scores for user: ".concat(id),
        buttons: {
          ok: {
            label: "OK",
            className: "btn-primary",
            callback: function() {
              console.log('OK Button');
            }
          }
      }});

    box.on("shown.bs.modal", function() {
        jQuery.noConflict();
        // document.getElementById('myTable').DataTable();
        jQuery('#myTable').DataTable(); 
    });
     
    box.modal('show'); 
};


function populateLevelQuiz(userLevel)
{
    var select = document.getElementById("quizSelect");
    jQuery.ajax({
        type: "POST",
        url: "quiz.inc.php",
        dataType: 'json',
        data: {functionname: 'getLevelQuizzes', arguments:[userLevel]}})
        .done(function (data) {
            if (!('error' in data)) {
                console.log(data);
                for (var x in data.result) {
                    var element = document.createElement('option');
                    element.value = data.result[x].resourceID;
                    element.selected = "selected";
                    element.innerHTML = data.result[x].resourceName;
                    select.appendChild(element);
                }
            }
            else {
                console.log(data.error);
            }            
        });
};


function populateQuiz()
{
    var select = document.getElementById("quizSelect");
    jQuery.ajax({
        type: "POST",
        url: "quiz.inc.php",
        dataType: 'json',
        data: {functionname: 'getAllQuizzes'},
        success: function (data) {
            if (!('error' in data)) {
                // alert(JSON.stringify(data));
                for (var x in data) {
                    // alert(JSON.stringify(data[x].resourceID));
                    var element = document.createElement('option');
                    element.value = data[x].resourceID;
                    element.selected = "selected";
                    element.innerHTML = data[x].resourcePath;
                    select.appendChild(element);
                }
            }
            else {
                console.log(data.error);
            }            
        }
    });
};


function displayScore(userScore, total)
{
    console.log(userScore);
    console.log(total);
    alert(userScore + ", out of " + total);
};

function storeScore(userID, userScore, quizID)
{
    console.log(userID, userScore, quizID);
    jQuery.ajax({
        type: "POST",
        url: "quiz.inc.php",
        dataType: 'json',
        data: {functionname: 'storeQuizScore', arguments: [userID, userScore, quizID]}})
        .done(function(insertResult){
            console.log("insertResult: ");
            console.log(insertResult);
            if (insertResult.result == true){
                alert("Quiz score stored: " + userID + userScore + quizID);
            }
            
        });
}


// go through json questions. if json question[i] includes
// truefalse: radios[i].checked
// multiselect: selected[i].value
// fillblank: textInputs[i].value
// then add adjusted score
function checkAnswers(userID, quizID, json)
{
    alert("checkAnswers called");
    var index = 0;
    let total = 0;
    let userScore = 0;
    for (i in json.questions) {
        // check true-false answer
        console.log(json.questions[i]);
        total += json.questions[i].points;
        if (json.questions[i].questionType == "truefalse"){
            var radios = document.getElementsByName("question".concat('', index));
            var answer;
            if (radios[0].checked) answer = true;
            else if (radios[1].checked) answer = false;

            if (answer == json.questions[i].questionAnswer[0]){
                alert("the answer was correct!: ".concat(answer)
                .concat("\nquestion: ").concat(index));
                userScore += json.questions[i].points;
            }
            // alert(answer);
        }

        //check multichoice answer
        else if (json.questions[i].questionType == "multichoice"){
            var checkBoxes = document.getElementsByName("question".concat(index));
            console.log(checkBoxes);
            for (x = 0; x<checkBoxes.length; x++) {
                console.log(checkBoxes[x]);
                if (checkBoxes[x].checked) {
                    console.log(json.questions[i].questionAnswer);
                    if (json.questions[i].questionAnswer.includes(parseInt(checkBoxes[x].value))) {
                        alert(checkBoxes[x].value + " was correct! \nquestion: " + index);
                        // split points by the amount of answers possible
                        userScore += (json.questions[i].points / json.questions[i].questionAnswer.length);
                    }
                }
            }
        }

        // check fill in the blank answer
        else if (json.questions[i].questionType == "fillblank"){
            var lineInputs = document.getElementsByName("question".concat(index));
            console.log("lineInputs: ");
            console.log(lineInputs);

            for (x = 0; x<lineInputs.length; x++){
                let lowerCaseAnswer = lineInputs[x].value.toLowerCase();
                if (json.questions[i].questionAnswer.includes(lowerCaseAnswer)){
                    alert("answer was correct!: " + lowerCaseAnswer + "\nQuestion:" + index);
                    // split points by the amount of answers possible
                    console.log("question score: " + json.questions[i].points);
                    console.log("questionAnswer length: " + json.questions[i].questionAnswer.length);
                    userScore += (json.questions[i].points / json.questions[i].questionAnswer.length);
                }
            }
        }
        index++;
    }
    displayScore(userScore, total);
    console.log("quizID: " + quizID);
    storeScore(userID, userScore, quizID);
};


function limitCheckBoxes(selectionLimit, id, name)
{
    limit = selectionLimit;
    console.log(id + " " + name);
    console.log("selection limit: " + limit);
    string = "input[name=" + name + "]:checked";
    console.log("checked string: " + string);
    if ($(string).length > limit) {
        document.getElementById(id).checked = false;
    }
};


function handleJson(userID, quizID, json)
{
    console.log(json);
    var quizForm = document.getElementById('quizForm');

    // clear form
    while (quizForm.hasChildNodes()) {
        quizForm.removeChild(quizForm.lastChild);
    }

    // populate form with questions
    var index = 0;
    for (i in json.questions){
        console.log(i);
        const questionDiv = document.createElement("div");
        questionDiv.className = "div_question".concat('_', index);
        quizForm.appendChild(questionDiv);

        questionDiv.appendChild(document.createTextNode(json.questions[i].questionText));
        questionDiv.appendChild(document.createElement("br"));
        if (json.questions[i].questionType == "truefalse"){
            // true radio
            var trueInput = document.createElement("input");
            trueInput.type = "radio";
            trueInput.name = "question".concat('', index);
            trueInput.id = trueInput.name.concat("_", "true");
            trueInput.value = true;

            var trueLabel = document.createElement("label");
            trueLabel.for = trueInput.id;
            trueLabel.innerHTML = "True";
            
            questionDiv.appendChild(trueInput);
            questionDiv.appendChild(trueLabel);
            questionDiv.appendChild(document.createElement("br"));

            // false radio
            var falseInput = document.createElement("input");
            falseInput.type = "radio";
            falseInput.name = "question".concat('', index);
            falseInput.id = falseInput.name.concat("_", "false");
            falseInput.value = false;

            var falseLabel = document.createElement("label");
            falseLabel.for = falseInput.id;
            falseLabel.innerHTML = "False";
            
            questionDiv.appendChild(falseInput);
            questionDiv.appendChild(falseLabel);
            questionDiv.appendChild(document.createElement("br"));            
        }
        else if (json.questions[i].questionType == "multichoice") {
            let selectionLimit = json.questions[i].selectionLimit;
            for (x = 0; x<json.questions[i].questionOptions.length; x++){
                let checkBoxInput = document.createElement("input");
                checkBoxInput.type = "checkbox";
                checkBoxInput.name = "question".concat(index);
                checkBoxInput.id = checkBoxInput.name.concat("_", x);
                checkBoxInput.value = json.questions[i].questionOptions[x];
                
                var checkBoxLabel = document.createElement("label");
                checkBoxLabel.for = checkBoxInput.id;
                checkBoxLabel.innerHTML = json.questions[i].questionOptions[x];

                questionDiv.appendChild(checkBoxLabel);
                questionDiv.appendChild(checkBoxInput);
                
                checkBoxInput.onchange = function(){ 
                    alert("changed");
                    console.log(json.questions);
                    limitCheckBoxes(selectionLimit, checkBoxInput.id, checkBoxInput.name);
                };
                if (x % 2 != 0) questionDiv.appendChild(document.createElement("br"));
            }
        }
        else if (json.questions[i].questionType == "fillblank") {
            let noOfInputs = json.questions[i].questionAnswer.length;
            for (x = 0; x < noOfInputs; x++){
                let lineInput = document.createElement("input");
                lineInput.type = "text";
                lineInput.name = "question".concat(index);
                lineInput.id = lineInput.name.concat("_", x);

                var lineLabel = document.createElement("label");
                lineLabel.for = lineInput.id;
                lineLabel.innerHTML = x;
                
                questionDiv.appendChild(lineLabel);
                questionDiv.appendChild(lineInput);
                questionDiv.appendChild(document.createElement("br"));
            }
        }
        
        // var input = document.createElement("input");
        // input.type = "text";
        // input.name = i;
        // quizForm.appendChild(input);
        // quizForm.appendChild(document.createElement("br"));
        index ++;
    }
    var submitButton = document.createElement("button");
    submitButton.type = "button";
    submitButton.id = "submitQuiz";
    submitButton.innerHTML="Submit";
    quizForm.appendChild(submitButton);

    document.getElementById("submitQuiz").onclick = function() {
        checkAnswers(userID, quizID, json);
    }
}

function handleData(userID, quizID, quizFilePath)
{
    // var string;
    // string = quizFilePath.result.resourcePath;
    // var jsonFile;
    // console.log("string in handledata = " + string);
    var myHeaders = new Headers();
    myHeaders.append('pragma', 'no-cache');
    myHeaders.append('cache-control', 'no-cache');

    var myInit = {
        method: 'GET',
        headers: myHeaders
    };
    
    var myRequest = new Request(quizFilePath.result.resourcePath);

    fetch(myRequest, myInit)
        .then(response => response.json())
        .then(json => handleJson(userID, quizID, json));
};

function getQuizFile(userID, callbackFunction)
{
    var e = document.getElementById("quizSelect");
    var quizID = e.options[e.selectedIndex].value;
    var text = e.options[e.selectedIndex].text;
    var string;
    // alert(value);
    // alert(text);
    jQuery.ajax({
        type: "POST",
        url: "quiz.inc.php",
        dataType: 'json',
        data: {functionname: 'getQuizFile', arguments: [quizID]}})
        .done(function(quizFilePath){
            callbackFunction(userID, quizID, quizFilePath);
        });
};

function updateForm(userID)
{
    getQuizFile(userID, handleData);
};