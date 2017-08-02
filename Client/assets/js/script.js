(function() {
    var app = angular.module('app', ['ngRoute', 'ui.materialize']);
    app.config(function($routeProvider) {
        $routeProvider
            .when("/", { templateUrl: "assets/pages/signup.html", controller: "loginController" })
            .when("/enseignant", { templateUrl: "assets/pages/enseignant.html", controller: "enseignantController" })
            .when("/get", { templateUrl: "assets/pages/get.html", controller: "getController" })
            .when("/manual", { templateUrl: "assets/pages/manual.html", controller: "manualController" })
            .when("/matiere", { templateUrl: "assets/pages/matiere.html", controller: "matiereController" })
            .when("/groupe", { templateUrl: "assets/pages/groupe.html", controller: "groupeController" })
            .when("/circuit/:id", { templateUrl: "assets/pages/circuit.html", controller: "circuitController" })
            .when("/algo", { templateUrl: "assets/pages/algo.html", controller: "algoController" })
            .otherwise({ redirectTo: "/" })
    })

    app.controller('enseignantController', function($scope, appFactory, $window) {
        $scope.showAdd = false;
        appFactory.getAllEnseignant()
            .then(function(response) {
                console.log(response.data);
                $scope.enseignants = response.data;
            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            });

        $scope.insertEnseignant = function() {
            console.log($scope.nom, $scope.prenom, $scope.email, $scope.phone);
            appFactory.insertEnseignant($scope.nom, $scope.prenom, $scope.email, $scope.phone)
                .then(function(response) {
                    console.log(response.data);
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                })
        }
    })

    app.controller("matiereController", function($scope, $rootScope, appfactory) {

    })

    app.controller("mainController", function($rootScope, $scope, $window) {
        $scope.nav = 1;
        if (localStorage.getItem('connected') == true) {
            $rootScope.sign = true;
        } else {
            $rootScope.sign = false;
        }

        $scope.goBack = function() {
            $window.history.back();
        }
        console.log($rootScope.sign);
    })

    app.controller('circuitController', function($rootScope, $scope, $routeParams, appFactory) {
        appFactory.getCircuit($routeParams.id)
            .then(function(response) {
                $scope.circuit = response.data;
            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            })

        function getAllCircuits() {
            appFactory.getAllCircuits()
                .then(function(response) {
                    $scope.circuits = response.data;
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                })

        }

        getAllCircuits();

        var currentTime = new Date();
        $scope.currentTime = currentTime;
        $scope.month = ['Januar', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $scope.monthShort = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $scope.weekdaysFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $scope.weekdaysLetter = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
        $scope.today = 'Today';
        $scope.clear = 'Clear';
        $scope.close = 'Close';
        var days = 15;
    })

    app.controller('algoController', function($scope, $rootScope, appFactory) {

    })
    app.controller('getController', function($rootScope, $scope, appFactory, $window) {
        //Variable initialization
        $rootScope.nav = 7;
        $scope.SalleCount = 0;
        $scope.filiereCount = 0;
        $scope.stepper = 1;
        $scope.divide = false;
        $scope.error = false;
        $scope.incapacity = false;
        $scope.defaultValue = "Tino";
        $scope.salleID = "";

        $scope.getFiliereByAnnee = function(annee, mention) {
            $scope.stepper++;
            console.log(annee, mention);
            appFactory.getFiliereByAnnee(annee, mention)
                .then(function(response) {
                    $scope.fil = response.data;
                    $scope.filieres = {
                        default: response.data[0].ID,
                        choices: response.data
                    }
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                });
        }

        $scope.incrementStepper = function() {
            $scope.stepper++;
        }

        $scope.decrementStepper = function() {
            $scope.stepper--;
            $scope.error = false;
        }

        $scope.getFiliereCount = function(filiere) {
            var somme = 0;
            console.log(filiere);

            for (var i = 0; i < filiere.length; i++) {
                var fil = filiere[i].split('(');
                var f = fil[1].split(')');
                somme = Number(f[0]) + Number(somme);
            }

            $scope.filiereCount = somme;
            console.log($scope.salleCapacity, $scope.filiereCount);
            checkCapacity();
        }

        function checkCapacity() {
            if ($scope.filiereCount > $scope.salleCapacity) {
                $scope.incapacity = true;
                var groupe = Math.ceil($scope.filiereCount / $scope.salleCapacity);
                $scope.groupe = groupe;
            } else {
                $scope.incapacity = false;
            }
        }

        $scope.getAnnee = function(mention) {
            $scope.stepper++;
            appFactory.getAnnee(mention)
                .then(function(response) {
                    $scope.annee = {
                        default: response.data[0].annee,
                        choices: response.data
                    }
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                });
        }

        function getTimeTable(date) {
            appFactory.getTimeTable(date)
                .then(function(response) {
                    console.log(response);
                    $scope.cours = response.data;
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                });
        }

        $scope.setSalleCapacity = function(cap) {
            console.log(cap);
            var fil = cap.split('(');
            $scope.salleID = fil[0];
            var f = fil[1].split(')');
            $scope.salleCapacity = f[0];
            checkCapacity();
        }

        appFactory.getMentions()
            .then(function(response) {
                $scope.mentions = {
                    default: response.data[0].ID,
                    choices: response.data
                }
            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            });

        appFactory.getAllSalles()
            .then(function(response) {
                $scope.salles = {
                    value: response.data[0].nom,
                    choices: response.data
                }
                $scope.salleID = response.data[0].ID;
                $scope.salleCapacity = response.data[0].capacite;

            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            });

        appFactory.getAllMatieres()
            .then(function(response) {
                $scope.matieres = {
                    value: response.data[0].libelle,
                    choices: response.data
                }

            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            });

        //DATEPICKER
        var currentTime = new Date();
        $scope.currentTime = currentTime;
        $scope.month = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
        $scope.monthShort = ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $scope.weekdaysFull = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $scope.weekdaysLetter = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];
        $scope.today = 'Ce jour';
        $scope.clear = 'Effacer';
        $scope.close = 'Fermer';

        $scope.onStart = function() {
            console.log('onStart');
        };
        $scope.onRender = function() {
            console.log('onRender');
        };
        $scope.onOpen = function() {
            console.log('onOpen');
        };
        $scope.onClose = function() {
            getTimeTable($scope.currentTime);
        };
        $scope.onSet = function(context) {

        };
        $scope.onStop = function() {

        };

        //TIME
        $scope.onOpenTime = function() {
            console.log('Time opened');
        };
        $scope.onCloseTime = function() {
            console.log('Time oclose');
        };
        $scope.onSetTime = function(context) {
            console.log('Time setted');
        };
        $scope.onStopTime = function() {
            console.log('Time stoped');
        };

        //GET SALLES
        appFactory.getAllSalles()
            .then(function(response) {
                console.log(response.data);
                $scope.salles = {
                    value: response.data[0].nom,
                    choices: response.data
                }

            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            })

        //CHECK IF TIME IS AVAILABLE
        $scope.checkIfTimeIsAvailable = function() {
            console.log($scope.heureFin, $scope.heureDebut, $scope.salles.default);
            var heureDebutCheck = new Date();
            var spl = $scope.heureDebut.split(':');
            heureDebutCheck.setHours(spl[0]);
            heureDebutCheck.setMinutes(spl[1]);
            console.log(heureDebutCheck.toISOString());
            appFactory.checkIfTimeIsAvailable($scope.currentTime, $scope.heureDebut, $scope.heureFin, $scope.salleID)
                .then(function(response) {
                    console.log(response);
                    if (response.data.length > 0) {
                        alert("Un cours a déja été fixé pour cette date");
                    }
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                })
        }

        $scope.getSalleCount = function(filiere) {
            console.log(filiere);
            var fil = filiere.split('(');
            $scope.salleID = fil[0];
            var f = fil[1].split(')');
            console.log(f[0]);
            $scope.SalleCount = f[0];
            console.log($scope.SalleCount, $scope.filiereCount)
            if (Number($scope.SalleCount) < Number($scope.filiereCount)) {
                console.log("La salle ne peut contenir cette filière toute entière");
                $scope.error = true;
            } else {
                $scope.error = false;
            }
        }

        $scope.shoutOut = function() {
            console.log($scope.heureFin, $scope.heureDebut, $scope.salleID);
            if ($scope.heureDebut > $scope.heureFin) {
                alert("Erreur. L'heure du début doit être inférieure à celle de la fin");
            } else {

            }
        }
    })

    app.controller('loginController', function($rootScope, $scope, appFactory, $window) {
        $rootScope.nav = 7;

        var credentials = {};

        $scope.login = function() {
            console.log($scope.username, $scope.password);
            appFactory.login($scope.email, $scope.password)
                .then(function(response) {
                    if (response.data[0].login != true) {
                        Materialize.toast("Le nom d'utilisateur et le mot de passe ne correspondent pas.", 3000);
                    } else {
                        if (response.data[0].usertype == "Administrateur") {
                            console.log("Administrateur");
                        } else {
                            console.log("Olon tsotra");
                        }

                        Materialize.toast("Bienvenue " + response.data.username, 2000, "", function() {
                            $('#gotohome').trigger('click');
                        });
                    }
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                })
        }
    })

    app.controller('groupeController', function($rootScope, appFactory, $scope) {
        $rootScope.nav = 3;

        appFactory.getAllFilieres()
            .then(function(response) {
                $scope.filieres = response.data;
            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            });
    })

    app.controller('manualController', function($scope, $rootScope, appFactory, $window) {
        $rootScope.nav = 2;
        $scope.loadCours = function(libelle) {
            console.log(libelle);
            appFactory.getCours(libelle)
                .then(function(response) {
                    $scope.cours = {
                        value: response.data[0].libelle,
                        choices: response.data
                    }
                    console.log(response.data);
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                });
        }

        $scope.getCount = function(count) {
            console.log(count);
        }

        $scope.regions = {
            value: "Vakinakaratra",
            choices: ["Vakinakaratra", "Sofia", "This is materialize", "No, this is Patrick."]
        };

        $scope.categories = {
            value: "Informatique",
            choices: ["Informatique", "Commerce", "Droit", "No, this is Patrick."]
        };

        $scope.worktimes = {
            value: "Plein temps",
            choices: ["Plein temps", "Temps partiel"]
        };

        appFactory.getAllEnseignant()
            .then(function(response) {
                console.log(response.data[0].nom + " " + response.data[0].prenom);
                $scope.enseignants = {
                    value: response.data[0].nom + " " + response.data[0].prenom,
                    choices: response.data
                }
            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            });


        $scope.getFiliereByAnnee = function(annee, mention) {
            console.log(annee, mention);
            /* 
            appFactory.getFiliereByAnnee(annee, mention)
                .then(function(response) {
                    $scope.filieres = {
                        default: response.data[0].nom,
                        choices: response.data
                    }
                }, function(error) {
                    console.log(error);
                    $scope.loaded = true;
                }); */
        }

        appFactory.getAllSalles()
            .then(function(response) {
                console.log(response.data);
                $scope.salles = {
                    value: response.data[0].nom,
                    choices: response.data
                }

            }, function(error) {
                console.log(error);
                $scope.loaded = true;
            });
    })

    /*===========================================================================
                                    FACTORY
    ============================================================================*/
    app.factory("appFactory", function($http) {
        var urlBase = "http://localhost/EmploiAPI/api";
        var dataFactory = {};
        dataFactory.getAllStudents = function() {
            return $http.get(urlBase);
        }

        dataFactory.getAllCircuits = function() {
            var url = urlBase + "/getAllCircuits";
            return $http.get(url);
        }

        dataFactory.getAllVilles = function() {
            var url = urlBase + "/getAllVilles";
            return $http.get(url);
        }

        dataFactory.getAllEnseignant = function() {
            var url = urlBase + "/getAllEnseignant";
            return $http.get(url);
        }

        dataFactory.getTimeTable = function(date) {
            var url = urlBase + "/getTimeTable?date='" + date + "'";
            return $http.get(url);
        }


        dataFactory.getAllSalles = function() {
            var url = urlBase + "/getAllSalles";
            return $http.get(url);
        }

        dataFactory.getFiliereByAnnee = function(annee, mention) {
            var url = urlBase + "/getFiliereByAnnee?annee=" + annee + "&mention=" + mention;
            return $http.get(url);
        }

        dataFactory.getCours = function(libelle) {
            var url = urlBase + "/getCours?libelle=" + libelle;
            return $http.get(url);
        }

        dataFactory.getAllMatieres = function() {
            var url = urlBase + "/getAllMatieres";
            return $http.get(url);
        }

        dataFactory.getMentions = function() {
            var url = urlBase + "/getMentions";
            return $http.get(url);
        }

        dataFactory.getAnnee = function(mention) {
            var url = urlBase + "/getAnnee?mention=" + mention;
            return $http.get(url);
        }

        dataFactory.checkIfTimeIsAvailable = function(date, heureDebut, heureFin, salle) {
            var url = urlBase + "/checkIfTimeIsAvailable?date=" + date + "&heureDebut=" + heureDebut + "&heureFin=" + heureFin + "&salle=" + salle;
            return $http.get(url);
        }

        dataFactory.insertEnseignant = function(nom, prenom, mail, phone) {
            var url = urlBase + "/insertEnseignant?nom=" + nom + "&prenom=" + prenom + "&mail=" + mail + "&phone=" + phone;
            return $http.post(url);
        }

        dataFactory.insertTimeTable = function(matiere, filiere, salle, dateCours, heureDebut, heureFin, description) {
            var url = urlBase + "/insertTimeTable?matiere=" + matiere + "&filiere=" + filiere + "&salle=" + salle + "&dateCours=" + dateCours + "&heureDebut=" + heureDebut + "&heureFin=" + heureFin + "&description=" + description;
            return $http.post(url);
        }

        dataFactory.login = function(username, password) {
            var url = urlBase + "login?username=" + username + "&password=" + password;
            return $http.post(url);
        }

        return dataFactory;
    });
})()