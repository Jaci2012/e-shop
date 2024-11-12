<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Multi-étapes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" />
    <link href="{{ asset('dash/assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <style>
        .step { display: none; }
        .step.active { display: block; }
        .input-group { margin-bottom: 1.5rem; }
        .form-control { padding: 12px 15px; border: 1px solid #ccc; border-radius: 4px; width: 100%; }
        .btn-nav { margin-top: 20px; }
        .btn-nav button { padding: 10px 15px; }
        .btn-primary, .btn-secondary, .btn-success { padding: 10px 20px; border: none; border-radius: 4px; color: #fff; cursor: pointer; }
        .btn-primary { background-color: #007bff; }
        .btn-secondary { background-color: #6c757d; }
        .btn-success { background-color: #28a745; }
        .toggle-password { cursor: pointer; }
    </style>
</head>
<body class="bg-gray-200">
    <div class="container my-auto">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header text-center">
                        <h4 class="text-primary">Inscription</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register.store') }}" id="registrationForm">
                            @csrf
                            <!-- Étape 1: Sélection du rôle -->
                            <div class="step active" data-step="1">
                                <h5>Vous êtes ?</h5>
                                <div class="input-group">
                                    <select class="form-control" name="role_id" required>
                                        <option value="">--Sélectionnez--</option>
                                        @foreach($roles as $role)
                                            @if ($role->role !== 'Administrateur')
                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="btn-nav">
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
                                </div>
                                <p>Vous avez de compte ? <a href="{{ route('login') }}">Connectez-vous</a></p>
                            </div>

                            <!-- Étape 2: Informations personnelles -->
                            <div class="step" data-step="2">
                                <h5>Informations personnelles</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Nom">
                                </div>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="adresse" value="{{ old('adresse') }}" required placeholder="Adresse">
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="numero" value="{{ old('numero') }}" required placeholder="Numero">
                                </div>
                                <div class="btn-nav">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
                                </div>
                            </div>

                            <!-- Étape 3: Mot de passe -->
                            <div class="step" data-step="3">
                                <h5>Définir un mot de passe</h5>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required placeholder="Mot de passe">
                                    <button type="button" class="toggle-password" id="togglePassword">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirmer le mot de passe">
                                    <button type="button" class="toggle-password" id="toggleConfirmPassword">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <div class="btn-nav">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                                    <button type="submit" class="btn btn-success">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll('.step');

        function showStep(step) {
            steps.forEach((el, index) => {
                el.classList.toggle('active', index === step);
            });
        }

        function nextStep() {
            const currentForm = steps[currentStep].querySelectorAll("input[required], select[required]");
            let allValid = true;
            currentForm.forEach((field) => {
                if (!field.value.trim()) {
                    allValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            if (allValid && currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        // Initialiser la première étape
        showStep(currentStep);

        // Fonction pour afficher/masquer le mot de passe
        document.getElementById("togglePassword").addEventListener("click", function () {
            togglePasswordVisibility("password", this);
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
            togglePasswordVisibility("password_confirmation", this);
        });

        function togglePasswordVisibility(passwordFieldId, toggleButton) {
            const passwordField = document.getElementById(passwordFieldId);
            const isPasswordVisible = passwordField.type === "password";
            passwordField.type = isPasswordVisible ? "text" : "password";
            toggleButton.innerHTML = isPasswordVisible ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>';
        }
    </script>
</body>
</html>
