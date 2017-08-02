 /*===========================================================================
                                     FACTORY
     ============================================================================*/
 app.factory("studentFactory", function($http) {

     //var urlBase = "http://192.168.140.74/UCMProject/api/";
     //var urlBase = "http://192.168.8.100/UCMProject/api/";
     var urlBase = "http://localhost/UCMProject/api/";
     //var urlBase = "http://ucm.api/api";
     var dataFactory = {};
     dataFactory.getAllStudents = function() {
         return $http.get(urlBase);
     }

     dataFactory.checkSignin = function(filiere, niveau, numero) {
         url = urlBase + "/checkUserSignin?filiere=" + filiere + "&niveau=" + niveau + "&numero=" + numero;
         return $http.get(url);
     }

     dataFactory.finalSignin = function(id, username, password) {
         url = urlBase + /finalSignin?"id=" + id + "&username=" + username + "&password=" + password;
         console.log(url);
         return $http.post(url);
     }

     dataFactory.connect = function(username, mdp) {
         url = urlBase + "/connect?username=" + username + "&"
         mdp "= mdp;
         return $http.get(url);
     }

     dataFactory.getAllForumSubjects = function() {
         url = urlBase + "/getAllForumSubjects";
         return $http.get(url);
     }

     dataFactory.getAllCommentsFromSubjects = function(subjectID) {
         url = urlBase + "/getAllCommentsFromSubjects?subjectID=" + subjectID;
         return $http.get(url);
     }

     dataFactory.getAllCommentsFromNews = function(subjectID) {
         url = urlBase + "/getAllCommentsFromNews?newsID=" + subjectID;
         return $http.get(url);
     }

     dataFactory.getForumSubjectsByID = function(subjectID) {
         url = urlBase + "/getForumSubjectsByID?subjectID=" + subjectID;
         return $http.get(url);
     }

     dataFactory.getNewsByID = function(newsID) {
         url = urlBase + "/getNewsById?newsID=" + newsID;
         return $http.get(url);
     }

     dataFactory.postForumSubject = function(studentID, title, description) {
         url = urlBase + "/postForumSubject?student=" + studentID + "&title=" + title + "&description=" + description;
         return $http.post(url);
     }

     dataFactory.getNews = function() {
         url = urlBase + "/getAllNews";
         return $http.get(url);
     }

     dataFactory.postCommentsSubject = function(newsID, studentID, comment) {
         url = urlBase + "/postCommentsSubject?newsID=" + newsID + "&studentID=" + studentID + "&comment=" + comment;
         return $http.post(url);
     }

     dataFactory.postCommentsNews = function(newsID, studentID, comment) {
         url = urlBase + "/postCommentsNews?newsID=" + newsID + "&studentID=" + studentID + "&comment=" + comment;
         return $http.post(url);
     }

     dataFactory.getLessonsList = function(niveau) {
         url = urlBase + "/getLessonFiles?niveau=" + niveau;
         return $http.get(url);
     }

     dataFactory.getSubjectsList = function(niveau) {
         url = urlBase + "/getSubjects";
         return $http.get(url);
     }

     return dataFactory;
 });