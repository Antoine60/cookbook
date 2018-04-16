$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});
$('#datepicker').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy'
});
$('#addEtape').on('click', function (e) {
    e.preventDefault();
    //TODO AJAX send to ETAPEController
    let etapeContent = $('#etapeContent').val();
    $('#listStep').append('<li>' + etapeContent + '</li>');
    //ajouter input hidden
    $('#hiddenInputs').append('<input type="hidden" name="etapes[]" value=' + etapeContent + '>');
    $('#etapeContent').val("");
})

$('#addIngredient').on('click', function (e) {
    e.preventDefault();
    //TODO AJAX send to IngredientController
    let nameIngredient = $('#ingredientContent').val();
    let quantityValue = $('#quantityValue').val();
    let mesureValue = $('#mesureValue').val();
    $('#ingredientContent').val("");
    $('#quantityValue').val("");
    $('#mesureValue').val("");
    $('#listIngredients').append('<li>' + quantityValue + mesureValue + ' - ' + nameIngredient + '</li>');

    //ajouter input hidden
    $('#hiddenInputs').append('<input type="hidden" name="ingredients[]" value=' + nameIngredient + '-' + quantityValue + '-' + mesureValue + '>');
})
