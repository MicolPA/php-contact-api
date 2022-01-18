<!doctype html>
<?php 

  require_once('controller/ContactController.php');
  $contactController = new ContactController();
  $allcontact = $contactController->getAll();

  $colors = ["text-dark", "text-secondary", "text-danger", "text-success"];
  $url = "http://".$_SERVER['HTTP_HOST'];
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Contact API</title>
  </head>
  <body>

    <style>
      .font-24{ font-size: 24px;}
    </style>

    <main class="container">
      <h6 class="display-4 pb-2 mb-2 mt-4 font-24">PHP CONTACT API REST</h6>
      <div class="accordion" id="myAccordeon">
        <div class="accordion-item">
          <h2 class="accordion-header" id="firstCollapse">
            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              <div class="d-flex text-muted pt-3">
                <i class="fas fa-square flex-shrink-0 me-2 text-dark fa-x2 h1"></i>
                <p class="pb-3 mb-0 small lh-sm">
                  <strong class="d-block text-gray-dark">Ver todos los contactos</strong>
                  <span class="badge bg-warning">GET</span> <?= $url ?>/api.php
                </p>
              </div>
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="firstCollapse" data-bs-parent="#myAccordeon">
            <div class="accordion-body">
              <strong>
                <code>
                  [{"id":"4","firstname":"Grisette","lastname":"Padilla","email":"g.padilla@gmail.com","number":"809-556-5556","date":"2022-01-17 08:45:22"}]
                </code>
              </strong>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="secondCollapse">
            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <div class="d-flex text-muted pt-3">
                <i class="fas fa-square flex-shrink-0 me-2 text-warning fa-x2 h1"></i>
                <p class="pb-3 mb-0 small lh-sm">
                  <strong class="d-block text-gray-dark">Crear nuevo contacto</strong>
                  <span class="badge bg-warning">POST</span> <?= $url ?>/api.php
                </p>
              </div>
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="secondCollapse" data-bs-parent="#myAccordeon">
            <div class="accordion-body">
              <p>
                  <code>model.Contact{</code> <br>
                    "firstname": <code>string required</code>, <br>
                    "lastname": <code>string required</code>, <br>
                    "email": <code>string required</code>, <br>
                    "number": <code>string required</code> <br>
                  <code>}</code>
              </p>
              <p class="mb-0">El parámetro "number" puede tener múltiples valores, separados por coma (",").</p>
              <strong>Ejemplo: </strong> <code>"809-234-1223, 809-234-2344, 809-856-9854".</code>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="thirdCollapse">
            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <div class="d-flex text-muted pt-3">
                <i class="fas fa-square flex-shrink-0 me-2 text-danger fa-x2 h1"></i>
                <p class="pb-3 mb-0 small lh-sm">
                  <strong class="d-block text-gray-dark">Eliminar contacto</strong>
                  <span class="badge bg-warning">DELETE </span> <strong>{id} /</strong>  <?= $url ?>/api.php
                </p>
              </div>
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="thirdCollapse" data-bs-parent="#myAccordeon">
            <div class="accordion-body">
              <p>
                  <code> {"id":integer}</code>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Lista de contactos</h6>
        <?php foreach ($allcontact as $contact): ?>
          <?php $i = rand(0, 3); ?>
            <div class="d-flex text-muted pt-3">
              <i class="fas fa-square flex-shrink-0 me-2 <?= $colors[$i] ?> fa-x2 h1"></i>
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                      <strong class="text-gray-dark"><?= "$contact->firstname $contact->lastname" ?> | <?= $contact->email ?></strong>
                    </div>
                    <span class="d-block">
                        <?php $numbers = explode(',', $contact->number) ?>
                        <?php foreach ($numbers as $n): ?>
                            <i class="fas fa-asterisk fa-xs"></i> <?= $n ?>
                        <?php endforeach ?>
                    </span>
                </div>
            </div>
        <?php endforeach ?>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>