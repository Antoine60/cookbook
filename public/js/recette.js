$(document).on('click', '#addRecetteForm', function (e) {
    $("#myModal").on('show.bs.modal', function (event) {
        $.ajax({
            url: "recettes/create", success: function (result) {
                $("#myModal .modal-body").html(result);
                $("#myModal").modal('show');
            }
        })
        ;
    });
});


$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});
$(document).on('click', '#addEtape', function (e) {
    e.preventDefault();
    //TODO AJAX send to ETAPEController
    let etapeContent = $('#etapeContent').val();
    $('#listStep').append('<li>' + etapeContent + '</li>');
    //ajouter input hidden
    $('#hiddenInputs').append('<input type="hidden" name="etapes[]" value=' + etapeContent + '>');
    $('#etapeContent').val("");
});

$(document).on('click', '#addIngredient', function (e) {
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


