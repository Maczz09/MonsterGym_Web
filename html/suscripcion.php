<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>
        if (confirm("Debe estar logueado para acceder a esta página. ¿Desea iniciar sesión?")) {
            window.location.href = "../html/login.php"; 
        } else {
            window.history.back(); 
        }
    </script>';
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripciones - MonsterGYm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/suscripcion.css">
    <style>
    .card-plan {
        cursor: pointer;
        transition: transform 0.2s;
    }

    .card-plan:hover {
        transform: scale(1.05);
    }

    .card-plan input {
        display: none;
    }

    .card-plan label {
        width: 100%;
        padding: 20px;
    }

    .card-plan label .title {
        font-size: 1.5em;
        font-weight: bold;
    }

    .card-plan label .price {
        font-size: 1.2em;
    }

    .radio-input-group {
        margin-top: 20px;
    }

    .payment-form {
        margin-top: 20px;
    }

    .form-control {
        margin-bottom: 10px;
    }

    .button {
        display: block;
        position: relative;
        top: 20px;
        right: -300px;

        width: 56px;
        height: 56px;
        margin: 0;
        overflow: hidden;
        outline: none;
        background-color: transparent;
        cursor: pointer;
        border: 0;
    }

    .button:before,
    .button:after {
        content: "";
        position: absolute;
        border-radius: 50%;
        inset: 4px;
    }

    .button:before {
        border: 6px solid #f0eeef;
        transition: opacity 0.4s cubic-bezier(0.77, 0, 0.175, 1) 80ms,
            transform 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) 80ms;
    }

    .button:after {
        border: 4px solid #96daf0;
        transform: scale(1.3);
        transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
            transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        opacity: 0;
    }

    .button:hover:before,
    .button:focus:before {
        opacity: 0;
        transform: scale(0.7);
        transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
            transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .button:hover:after,
    .button:focus:after {
        opacity: 1;
        transform: scale(1);
        transition: opacity 0.4s cubic-bezier(0.77, 0, 0.175, 1) 80ms,
            transform 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) 80ms;
    }

    .button-box {
        display: flex;
        position: absolute;
        top: 0;

        left: 0;
    }

    .button-elem {
        display: block;
        width: 20px;
        height: 20px;
        margin: 17px 17px 0 17px;
        transform: rotate(180deg);
        fill: #f0eeef;
    }

    .button:hover .button-box,
    .button:focus .button-box {
        transition: 0.4s;
        transform: translateX(-56px);
    }

    @media (max-width: 850px) {
        .button {
            right: -50px;
            width: 50px;
            height: 50px;
        }

        .button-elem {
            width: 16px;
            height: 16px;
            margin: 18px 8px 0 17px;
        }

        .button:hover .button-box,
        .button:focus .button-box {
            transform: translateX(-40px);
        }
    }
    </style>
</head>

<body class="bg-custom">
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-white">Suscripciones - MonsterGym</h1>
        <form id="subscription-form" class="card p-4 shadow-sm" action="../php/procesar_suscripcion.php" method="POST">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card text-center card-membresia">
                        <input class="input" type="radio" name="plan" value="muscle" id="muscle"
                            onclick="showPlanOptions('muscle')">
                        <label class="label" for="muscle">
                            <div class="title">MUSCLE</div>
                            <div class="price">
                                <span>S/.</span> 70 <span>/mes</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center card-membresia">
                        <input class="input" type="radio" name="plan" value="monster" id="monster"
                            onclick="showPlanOptions('monster')">
                        <label class="label" for="monster">
                            <div class="title">MONSTER</div>
                            <div class="price">
                                <span>S/.</span> 80 <span>/mes</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center card-membresia">
                        <input class="input" type="radio" name="plan" value="prime" id="prime"
                            onclick="showPlanOptions('prime')">
                        <label class="label" for="prime">
                            <div class="title">PRIME</div>
                            <div class="price">
                                <span>S/.</span> 100 <span>/mes</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div id="muscle-options" class="radio-input-group text-center d-none">
                <input value="1" name="duration" id="muscle-month" type="radio" />
                <label for="muscle-month">Mensual S/.70</label>
                <input value="6" name="duration" id="muscle-six-months" type="radio" />
                <label for="muscle-six-months">Seis meses S/.378</label>
                <input value="12" name="duration" id="muscle-year" type="radio" />
                <label for="muscle-year">Anual S/.840</label>
            </div>
            <div id="monster-options" class="radio-input-group text-center d-none">
                <input value="1" name="duration" id="monster-month" type="radio" />
                <label for="monster-month">Mensual S/.80</label>
                <input value="6" name="duration" id="monster-six-months" type="radio" />
                <label for="monster-six-months">Seis meses S/.432</label>
                <input value="12" name="duration" id="monster-year" type="radio" />
                <label for="monster-year">Anual S/.960</label>
            </div>
            <div id="prime-options" class="radio-input-group text-center d-none">
                <input value="1" name="duration" id="prime-month" type="radio" />
                <label for="prime-month">Mensual S/.100</label>
                <input value="6" name="duration" id="prime-six-months" type="radio" />
                <label for="prime-six-months">Seis meses S/.540</label>
                <input value="12" name="duration" id="prime-year" type="radio" />
                <label for="prime-year">Anual S/.960</label>
            </div>

            <input type="hidden" id="fecha_inicio" name="fecha_inicio">
            <input type="hidden" id="fecha_fin" name="fecha_fin">

            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" onclick="calculateEndDate()">Calcular Fecha de
                    Fin</button>
            </div>
            <div id="end-date" class="text-center mt-3"></div>

            <div class="payment-form text-center mt-4">
                <h3>Información de Pago</h3>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Número de Tarjeta" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombre en la Tarjeta" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Fecha de Expiración (MM/YY)" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="CVV" required>
                </div>
                <button type="submit" class="btn btn-success">Pagar</button>
            </div>
        </form>
    </div>
    <a href="Membresias.php" class="button">
        <div class="button-box">
            <span class="button-elem">
                <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                    </path>
                </svg>
            </span>
            <span class="button-elem">
                <svg viewBox="0 0 46 40">
                    <path
                        d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z">
                    </path>
                </svg>
            </span>
        </div>
    </a>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function showPlanOptions(plan) {
        document.getElementById('muscle-options').classList.add('d-none');
        document.getElementById('monster-options').classList.add('d-none');
        document.getElementById('prime-options').classList.add('d-none');

        document.getElementById(plan + '-options').classList.remove('d-none');
    }

    function calculateEndDate() {
        const plan = document.querySelector('input[name="plan"]:checked');
        const duration = document.querySelector('input[name="duration"]:checked');
        if (!plan || !duration) {
            alert("Por favor, seleccione un plan y una duración.");
            return;
        }

        const today = new Date();
        let endDate = new Date(today);

        if (duration.value == 1) {
            endDate.setMonth(today.getMonth() + 1);
        } else if (duration.value == 6) {
            endDate.setMonth(today.getMonth() + 6);
        } else if (duration.value == 12) {
            endDate.setFullYear(today.getFullYear() + 1);
        }

        document.getElementById('fecha_inicio').value = today.toISOString().split('T')[0];
        document.getElementById('fecha_fin').value = endDate.toISOString().split('T')[0];
        document.getElementById('end-date').innerText =
            `La suscripción terminará el: ${endDate.toLocaleDateString('es-ES')}`;
    }
    </script>
</body>

</html>