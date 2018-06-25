<script src="/js/bootstrap-tagsinput.js"></script>
<script src="/js/jquery.crs.min.js"></script>

<form method="post" action="{{url('recettes')}}" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="row">
        <div class="form-group col-md-4">
            <label for="Name">Nom de la recette :</label>
            <input type="text" class="form-control" name="name" autocomplete="off">

            <div class="form-group">
                <label for="Photographie">Photographie</label>
                <input type="file" name="photo" value="Parcourir">
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
                <label for="repas_type">Type de repas</label>
                <select type="text" id="repas_type" name="repas_type">
                    <option value="Matin">Matin</option>
                    <option value="Midi">Midi</option>
                    <option value="En-Cas">En-Cas</option>
                    <option value="Soir">Soir</option>
                </select>
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
                <br>
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
            <button type="submit" id="addIngredient " class="btn col-md-12">Ajouter un ingrédient</button>
        </div>
        <div class="col-md-4">
            <label>Etapes</label>
            <ol id="listStep"></ol>
            <div class="row">
                <div class="form-group col-md-12">
                    <textarea name="description" id="etapeContent" rows="4" cols="30"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <button type="submit" id="addEtape" class="btn">Ajouter une étape</button>
                </div>
            </div>
        </div>
        <span id="hiddenInputs"></span>
        <div class="col-md-4 col-md-offset-4  form-group">
            <button type="submit" class="btn btn-valider-recette">Valider la recette</button>
        </div>
</form>


