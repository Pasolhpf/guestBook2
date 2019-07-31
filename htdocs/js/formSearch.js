$("#searchRun").on("click", function() {
  var searchData = $("#searchData").val().trim();
  var choice = $("#choice").val().trim();

  if(searchData == ""){
    $("#errorSearch").text("Введите запрос для поиска");
    return false;
  } else if(choice == "Поиск по...") {
    $("#errorSearch").text("Выберите поле для поиска");
    return false;
  } else if(choice == "createdAt" && !searchData.match(/^(\d{4})-(\d{1,2})-(\d{1,2})$/)) {
    $("#errorSearch").text("Введите дату в формате ГГГГ-ММ-ДД");
    return false;
  }

  $("#errorSearch").text("");

  $.ajax({
    url: 'ajax/searchTest.php',
    type: 'POST',
    cache: false,
    data: { 'searchData': searchData, 'choice': choice },
    dataType: 'html',
    beforeSend: function() {
      $("#searchRun").prop("disabled", true);
    },
    success: function(data) {
      //alert(data);
      $("#searchRun").prop("disabled", false);
      window.location.href = "http://172.55.0.3/search.php";
    }
  });


});
