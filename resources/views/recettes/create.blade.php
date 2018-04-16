<!-- create.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel 5.6 CRUD Tutorial With Example  </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link href="/css/bootstrap-tagsinput.css" rel="stylesheet">
    <script src="/js/bootstrap-tagsinput.js"></script>
    <script src="/js/jquery.crs.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h2>Nouvelle recette</h2><br/>
      <form method="post" action="{{url('recettes')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="form-group col-md-4">
            <label for="Name">Nom de la recette :</label>
            <input type="text" class="form-control" name="name">

            <div class="form-group">
              <label for="Photographie">Photographie</label>
              <input type="file" name="photo">
            </div>

            <div class="form-group">
              <label for="pays">Pays</label>
              <select type="text" class="crs-country" name="pays" data-region-id="regionselect"></select>
            </div>

            <div class="form-group">
              <label for="country">Région</label>
              <select type="text" id="regionselect" name="region"></select>
            </div>

            <div class="form-group">
              <label for="keyswords">Mots clés</label>
              <input type="text" name="keyswords" data-role="tagsinput">
            </div>
          </div>
          <div class="col-md-4">
                <label>Ingrédients</label>
                <ul id="listIngredients"></ul>
              <div class="form-group">
                <label for="ingredient">Nom de l'ingrédient :</label>
                <input name="ingredient" type="text" id="ingredientContent"/>
                <label for="quantity">Quantité :</label>
                <input name="quantity" type="number" min="0" id="quantityValue"/>
                <select name="mesure" id="mesureValue">
                  <option value=""></option>
                  <option value="g">g</option>
                  <option value="kg">kg</option>
                  <option value="mL">mL</option>
                  <option value="cL">cL</option>
                  <option value="L">L</option>
                </select>
             </div>
              <button type="submit" id="addIngredient" class="btn">Ajouter un ingrédient</button>
            </div>
          <div class="col-md-4">
            <label>Etapes</label>
            <ol id="listStep"></ol>
        <div class="row">
            <div class="form-group col-md-4">
              <textarea name="description" id="etapeContent" rows="4" cols="50"></textarea>
            </div>
        </div>
      <div class="row">
                <div class="form-group col-md-4">
          <button type="submit" id="addEtape" class="btn">Ajouter une étape</button>
       </div>
      </div>
    </div>
  </div>
        <div class="row">
          <div class="col-md-4" id="hiddenInputs"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Valider la recette</button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript" src="/js/recette.js"></script>
  </body>
</html>
